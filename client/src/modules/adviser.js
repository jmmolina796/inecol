import getDominantColor from '../shared/getDominantColor';
import addClassAdministration from '../shared/addClassAdministration';

import {
    validateFile
} from '../validations';

import {
    getUrlImage
} from '../helpers/urls';

import {
    requestJson,
    requestView,
    uploadMultimedia,
} from '../api';

import {
    closeModal,
    openModal,
    loadedModal,
    loadingModal
} from '../shared/modal';

import {
    loadingPage,
    loadedPage,
    loadingContent,
    loadedContent
} from '../shared/contentLoaders';

import {
    openAlert,
    defaultErrorAlert
} from '../shared/alert';

import {
    openMessage
} from '../shared/message';

import {
    setImageDeleteEvent
} from '../eventCreators';


$("#webContent").on("change", "#asesor-imagen", function () {
    var error = validateFile($(this));
    if (!error) {
        $(this).closest(".fl").addClass("fl-loading");
        var element = $(this);
        var mult = "img";
        var type = "asesores";
        var callback = function (info) {
            $("#asesor-imagen").parent().find("img").attr("src", info.link);
            $("#asesor-imagen").closest(".fl").addClass("fl-loaded").removeClass("fl-loading");
            var elementSpan = element.parent().find(".img-file span");

            $("#asesor-imagen").parent().imagesLoaded().then(function () {
                var elementImage = $("#asesor-imagen").parent().find("img");
                var arr = getDominantColor(elementImage);
                $("#asesor-imagen").attr("data-color", arr);
            });

            setImageDeleteEvent(elementSpan, "aseImg");
        }
        uploadMultimedia(element, mult, type, callback);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado es incorrecto. Solo se permiten imágenes.";
        defaultErrorAlert(title, content);
    }
});

$("#webContent").on("click", "#btnNuevoAsesor", function () {
    var link = "formRegistrarAsesores";

    loadingContent();
    var data = {
        comm: "async"
    };
    var callback = function (data) {
        $("#webContent").html(data);
        $.mtStart();
        loadedContent();
    };
    requestView(link, data, callback);

});

$("#webContent").on("click", ".btnCancelAsesor", function () {
    $("#menu-pc-sesion li[data-file*='formAsesores']").trigger("click");
});

$("#webContent").on("click", "#btnCreateAsesor", function () {
    var error = $(this).mtValidate();
    var contrasena1 = $("#asesor-password").val().trim();
    var contrasena2 = $("#asesor-passwordCon").val().trim();

    if (error == false) {
        if (contrasena1 != contrasena2) {
            error = true;
            $("#asesor-passwordCon").val("");
            $("#asesor-password").val("");
            var title = "Contraseñas";
            var content = "Las contraseñas no coinciden.";
            var element = $("#asesor-password");
            defaultErrorAlert(title, content, element);

        }
    }
    if (error == false) {
        var data = $(".form-registrar-asesor").find("input").serialize();
        var url = $("#asesor-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#asesor-imagen").attr("data-color");
        var tipoFuncion = $("#funcAsesor option:selected").val();
        imagen = imagen == undefined ? "" : imagen;
        color = color == undefined ? "" : color;
        data += "&imagen=" + imagen + "&color=" + color + "&tipoFuncion=" + tipoFuncion + "&comm=dbs";

        loadingPage();
        var link = "registrarAsesores";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formAsesores']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else if (info.mensaje == "usuario") {
                var title = "Nombre de usuario";
                var content = info.resultado;
                var element = $("#asesor-usuario");
                defaultErrorAlert(title, content, element);
            } else if (info.mensaje == "email") {
                var title = "Correo electrónico";
                var content = info.resultado;
                var element = $("#asesor-correo");
                defaultErrorAlert(title, content, element);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnConsultarAsesor", function () {
    var seleccionado = false;

    $($('#tblAsesores').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });

    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblAsesores").bootstrapTable('getSelections')));
        var link = "formConsultarAsesores";

        var id = datos[0].Id;

        loadingContent();
        var data = {
            comm: "async",
            id_asesor: id
        };
        
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            loadedContent();
        }
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }

});

$("#webContent").on("click", "#btnModificarAsesor", function () {
    var seleccionado = false;
    $($('#tblAsesores').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblAsesores").bootstrapTable('getSelections')));
        var id = datos[0].Id;

        loadingContent();
        var link = "formModificarAsesores";
        var data = {
            comm: "async",
            id_asesor: id
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            loadedContent();
            $("#btnUpdateAsesor").data("id_asesor", $("#btnUpdateAsesor").attr("data-asesor")).removeAttr("data-asesor");
            var img = $("#asesor-imagen").attr("data-img");
            if (img != "") {
                $("#asesor-imagen").removeAttr("data-img");
                $("#asesor-imagen").parent().find(".img-file>img").attr("src", img);
                $("#asesor-imagen").parent().parent().addClass("fl-loaded");

                var elementSpan = $("#asesor-imagen").parent().find(".img-file span");
                setImageDeleteEvent(elementSpan, "aseImg");
            }
        }
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }

});

$("#webContent").on("click", "#btnUpdateAsesor", function() {
    var error = $(this).mtValidate();
    if (error == false) {
        var data = $(".form-modificar-asesor").find("input, select").serialize();
        var id = $("#btnUpdateAsesor").data().id_asesor;
        var url = $("#asesor-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#asesor-imagen").attr("data-color");
        imagen = imagen == undefined ? "" : imagen;
        color = color == undefined ? "" : color;
        data += "&id_asesor=" + id + "&imagen=" + imagen + "&color=" + color + "&comm=dbs";
        loadingPage();
        var link = "modificarAsesores";
        var callback = function (info) {
            debugger;
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formAsesores']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else if (info.mensaje == "usuario") {
                var title = "Nombre de usuario";
                var content = info.resultado;
                var element = $("#asesor-usuario");
                defaultErrorAlert(title, content, element);
            } else if (info.mensaje == "email") {
                var title = "Correo electrónico";
                var content = info.resultado;
                var element = $("#asesor-correo");
                defaultErrorAlert(title, content, element);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnEliminarAsesor", function () {
    var seleccionado = false;

    $($('#tblAsesores').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {

        function eliminarAsesor() {
            var link = "formEliminarAsesores";
            var datos = eval(JSON.stringify($("#tblAsesores").bootstrapTable('getSelections')));

            var nombre_asesor = datos[0].Nombre + " " + datos[0].Ape_paterno + " " + datos[0].Ape_materno;
            var id = datos[0].Id;

            loadingModal();
            var data = {
                comm: "async",
                nombre: nombre_asesor
            };
            var callback = function (data) {
                $(".window-modal").html(data);
                loadedModal();

                $("#btnBajaAsesor").on("click", function () {
                    loadingModal();
                    var link = "eliminarAsesores";
                    var data = {
                        comm: "dbs",
                        id_asesor: id
                    };
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == true) {
                            closeModal();

                            var datos = eval(JSON.stringify($("#tblAsesores").bootstrapTable('getSelections')));
                            datos[0].state = false;

                            $('#tblAsesoresBaja').bootstrapTable('prepend', datos);
                            $('#tblAsesores').bootstrapTable('remove', {
                                field: 'Id',
                                values: [id]
                            });

                            openMessage("#5cb85c", "#FFF", info.resultado);

                            addClassAdministration($("#tblAsesores"), "0"); //elementTable, type
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    };
                    requestJson(link, data, callback);
                });
            };
            requestView(link, data, callback);
        }
        openModal(eliminarAsesor);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnAsesorAlta", function () {
    var seleccionado = false;

    $($('#tblAsesoresBaja').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblAsesoresBaja").bootstrapTable('getSelections')));
        var id = datos[0].Id;

        var link = "altaAsesores";
        var data = {
            comm: "dbs",
            id_asesor: id
        };
        loadingPage();
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                var datos = eval(JSON.stringify($("#tblAsesoresBaja").bootstrapTable('getSelections')));
                datos[0].state = false
                $('#tblAsesores').bootstrapTable('prepend', datos);
                $('#tblAsesoresBaja').bootstrapTable('remove', {
                    field: 'Id',
                    values: [id]
                });
                openMessage("#5cb85c", "#FFF", info.resultado);
                addClassAdministration($("#tblAsesoresBaja"), "1"); //elementTable, type
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});