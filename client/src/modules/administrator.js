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

$("#webContent").on("change", "#admin-imagen", function () {
    var error = validateFile($(this));
    if (!error) {
        $(this).closest(".fl").addClass("fl-loading");
        var element = $(this);
        var mult = "img";
        var type = "administradores";
        var callback = function (info) {
            $("#admin-imagen").parent().find("img").attr("src", info.link);
            $("#admin-imagen").closest(".fl").addClass("fl-loaded").removeClass("fl-loading");
            var elementSpan = element.parent().find(".img-file span");

            $("#admin-imagen").parent().imagesLoaded().then(function () {
                var elementImage = $("#admin-imagen").parent().find("img");
                var arr = getDominantColor(elementImage);
                $("#admin-imagen").attr("data-color", arr);
            });

            setImageDeleteEvent(elementSpan, "admImg");
        }
        uploadMultimedia(element, mult, type, callback);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado es incorrecto. Solo se permiten imágenes.";
        defaultErrorAlert(title, content);
    }
});


$("#webContent").on("click", "#btnCreateAdmin", function () {
    var error = $(this).mtValidate();
    var contrasena1 = $("#admin-password").val().trim();
    var contrasena2 = $("#admin-passwordCon").val().trim();

    if (error == false) {
        if (contrasena1 != contrasena2) {
            error = true;
            $("#admin-passwordCon").val("");
            $("#admin-password").val("");
            var title = "Contraseñas";
            var content = "Las contraseñas no coinciden.";
            var element = $("#admin-password");
            defaultErrorAlert(title, content, element);

        }
    }
    if (error == false) {
        var data = $(".form-registrar-administrador").find("input").serialize();
        var url = $("#admin-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#admin-imagen").attr("data-color");
        imagen = imagen == undefined ? "" : imagen;
        color = color == undefined ? "" : color;
        data += "&imagen=" + imagen + "&color=" + color + "&comm=dbs";

        loadingPage();
        var link = "registrarAdministradores";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formAdministradores']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else if (info.mensaje == "usuario") {
                var title = "Nombre de usuario";
                var content = info.resultado;
                var element = $("#admin-usuario");
                defaultErrorAlert(title, content, element);
            } else if (info.mensaje == "email") {
                var title = "Correo electrónico";
                var content = info.resultado;
                var element = $("#admin-correo");
                defaultErrorAlert(title, content, element);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnNuevoAdministrador", function () {
    var link = "formRegistrarAdministradores";

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

$("#webContent").on("click", "#btnConsultarAdministrador", function () {
    var seleccionado = false;

    $($('#tblAdministradores').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });

    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblAdministradores").bootstrapTable('getSelections')));
        var link = "formConsultarAdministradores";

        var id = datos[0].Id;

        loadingContent();
        var data = {
            comm: "async",
            id_administrador: id
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

$("#webContent").on("change", "#ckEstadoAdmin", function () {
    if ($(this).prop("checked")) {
        $(this).parent().find("label").text("Activo");
    } else {
        $(this).parent().find("label").text("Inactivo");
    }
})

$("#webContent").on("click", ".btnCancelAdmin", function () {
    $("#menu-pc-sesion li[data-file*='formAdministradores']").trigger("click");
});


$("#webContent").on("click", "#btnEliminarAdministrador", function () {
    var seleccionado = false;

    $($('#tblAdministradores').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {

        function eliminarAdmin() {
            var link = "formEliminarAdministradores";
            var datos = eval(JSON.stringify($("#tblAdministradores").bootstrapTable('getSelections')));

            var nombre_administrador = datos[0].Nombre + " " + datos[0].Ape_paterno + " " + datos[0].Ape_materno;
            var id = datos[0].Id;

            loadingModal();
            var data = {
                comm: "async",
                nombre: nombre_administrador
            };
            var callback = function (data) {
                $(".window-modal").html(data);
                loadedModal();

                $("#btnBajaAdmin").on("click", function () {
                    loadingModal();
                    var link = "eliminarAdministradores";
                    var data = {
                        comm: "dbs",
                        id_administrador: id
                    };
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == true) {
                            closeModal();

                            var datos = eval(JSON.stringify($("#tblAdministradores").bootstrapTable('getSelections')));
                            datos[0].state = false;

                            $('#tblAdministradoresBaja').bootstrapTable('prepend', datos);
                            $('#tblAdministradores').bootstrapTable('remove', {
                                field: 'Id',
                                values: [id]
                            });

                            openMessage("#5cb85c", "#FFF", info.resultado);

                            addClassAdministration($("#tblAdministradores"), "0"); //elementTable, type
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    };
                    requestJson(link, data, callback);
                });
            };
            requestView(link, data, callback);
        }
        openModal(eliminarAdmin);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnModificarAdministrador", function () {
    var seleccionado = false;
    $($('#tblAdministradores').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblAdministradores").bootstrapTable('getSelections')));
        var id = datos[0].Id;

        loadingContent();
        var link = "formModificarAdministradores";
        var data = {
            comm: "async",
            id_administrador: id
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            loadedContent();
            $("#btnUpdateAdmin").data("id_administrador", $("#btnUpdateAdmin").attr("data-administrador")).removeAttr("data-administrador");
            var img = $("#admin-imagen").attr("data-img");
            if (img != "") {
                $("#admin-imagen").removeAttr("data-img");
                $("#admin-imagen").parent().find(".img-file>img").attr("src", img);
                $("#admin-imagen").parent().parent().addClass("fl-loaded");

                var elementSpan = $("#admin-imagen").parent().find(".img-file span");
                setImageDeleteEvent(elementSpan, "admImg");
            }
        }
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }

});

$("#webContent").on("click", "#btnUpdateAdmin", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var data = $(".form-modificar-administrador").find("input, textarea, select").serialize();
        var id = $("#btnUpdateAdmin").data().id_administrador;
        var url = $("#admin-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#admin-imagen").attr("data-color");
        imagen = imagen == undefined ? "" : imagen;
        color = color == undefined ? "" : color;
        data += "&id_administrador=" + id + "&imagen=" + imagen + "&color=" + color + "&comm=dbs";

        loadingPage();
        var link = "modificarAdministradores";
        var callback = function (info) {
            debugger;
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formAdministradores']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else if (info.mensaje == "usuario") {
                var title = "Nombre de usuario";
                var content = info.resultado;
                var element = $("#admin-usuario");
                defaultErrorAlert(title, content, element);
            } else if (info.mensaje == "email") {
                var title = "Correo electrónico";
                var content = info.resultado;
                var element = $("#admin-correo");
                defaultErrorAlert(title, content, element);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});


$("#webContent").on("click", "#btnAdministradorAlta", function () {
    var seleccionado = false;

    $($('#tblAdministradoresBaja').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblAdministradoresBaja").bootstrapTable('getSelections')));
        var id = datos[0].Id;

        var link = "altaAdministradores";
        var data = {
            comm: "dbs",
            id_administrador: id
        };
        loadingPage();
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                var datos = eval(JSON.stringify($("#tblAdministradoresBaja").bootstrapTable('getSelections')));
                datos[0].state = false
                $('#tblAdministradores').bootstrapTable('prepend', datos);
                $('#tblAdministradoresBaja').bootstrapTable('remove', {
                    field: 'Id',
                    values: [id]
                });
                openMessage("#5cb85c", "#FFF", info.resultado);
                addClassAdministration($("#tblAdministradoresBaja"), "1"); //elementTable, type
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

// $("#webContent").on("change", ".form-check input:radio", function () {
//     var radio = $(".form-check input:radio").first().is(":checked");
//     if (radio) {
//         var link = "agregarSelectTipoAdministrador";
//         var data = {
//             comm: "req"
//         };
//         var callback = function (data) {
//             $(".containerSlTipoAdministrador").append(data);
//             $.mtStart();
//         };
//         requestView(link, data, callback);
//     } else {
//         $(".containerSlTipoAdministrador").empty();
//     }
// });