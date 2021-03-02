import velocity from 'velocity-animate';
import getDominantColor from '../shared/getDominantColor';
import addClassAdministration from '../shared/addClassAdministration';
import isThereCheckSelected from '../shared/isThereCheckSelected';

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

$("#webContent").on("click", "#btnNuevoModulo", function () {
    loadingContent();
    var link = "formRegistrarModulos";
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

$("#webContent").on("click", ".btnCancelModulo", function () {
    $("#menu-pc-sesion li[data-file*='formModulos']").trigger("click");
});

$("#webContent").on("click", "#btnCreateModulo", function () {
    var error = $(this).mtValidate();

    if (error == false) {
        var seleccionado = isThereCheckSelected("r2");
        if (seleccionado == "Si") {
            error = false;
        } else {
            error = true;

            var title = "Seleccione por lo menos un grado";
            var content = "Debe seleccionar por lo menos un grado para cualquiera de los niveles educativos (Preescolar, Primaria o Secundaria).";
            defaultErrorAlert(title, content);
            const $el = $(".seleccionar-grados").first();
            velocity($el, "scroll");
        }
    }
    if (error == false) {
        var grados = [];
        $(".seleccionar-grados").find("input:checked").each(function (index) {
            grados[index] = {
                "grado": $(this).attr("id").split("-")[2]
            };
        });
        var formulario = $(".form-registrar-modulos").find("input, textarea").serializeArray();
        var url = $("#modulo-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#modulo-imagen").attr("data-color");
        loadingPage();

        var data = {
            "comm": "dbs",
            "grados": grados,
            "imagen": ((imagen == undefined) ? "" : imagen),
            "modulo-nombre": formulario[0].value,
            "modulo-descripcion": formulario[1].value,
            "color": ((color == undefined) ? "" : color)
        };
        var link = "registrarModulos";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formModulos']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnConsultarModulo", function () {
    var seleccionado = false;
    $($('#tblModulos').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var link = "formConsultarModulos";
        var idModulo = $('#tblModulos').bootstrapTable('getSelections', 'Id');
        idModulo = idModulo[0].Id;
        loadingContent();
        var data = {
            comm: "async",
            id_modulo: idModulo
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            loadedContent();
        };
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});




$("#webContent").on("change", "#modulo-imagen", function () {
    var error = validateFile($(this));
    if (!error) {
        $(this).closest(".fl").addClass("fl-loading");
        var element = $(this);
        var mult = "img";
        var type = "modulos";
        var callback = function (info) {
            $("#modulo-imagen").parent().find("img").attr("src", info.link);
            $("#modulo-imagen").closest(".fl").addClass("fl-loaded").removeClass("fl-loading");
            var elementSpan = element.parent().find(".img-file span");

            $("#modulo-imagen").parent().imagesLoaded().then(function () {
                var elementImage = $("#modulo-imagen").parent().find("img");
                var arr = getDominantColor(elementImage);
                $("#modulo-imagen").attr("data-color", arr);
            });

            setImageDeleteEvent(elementSpan, "modImg");
        }
        uploadMultimedia(element, mult, type, callback);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado es incorrecto. Solo se permiten imágenes.";
        defaultErrorAlert(title, content);
    }
});


$("#webContent").on("click", "#btnModificarModulo", function () {
    var seleccionado = false;
    $($('#tblModulos').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var link = "formModificarModulos";
        var idModulo = $('#tblModulos').bootstrapTable('getSelections', 'Id');
        idModulo = idModulo[0].Id;
        loadingContent();
        var data = {
            comm: "async",
            id_modulo: idModulo
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            loadedContent();
            $("#btnUpdateModulo").data("id_modulo", $("#btnUpdateModulo").attr("data-modulo")).removeAttr("data-modulo");
            var img = $("#modulo-imagen").attr("data-img");
            if (img != "") {
                $("#modulo-imagen").removeAttr("data-img");
                $("#modulo-imagen").parent().find(".img-file>img").attr("src", img);
                $("#modulo-imagen").parent().parent().addClass("fl-loaded");

                var elementSpan = $("#modulo-imagen").parent().find(".img-file span");
                setImageDeleteEvent(elementSpan, "modImg");
            }
        };
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnUpdateModulo", function () {
    var error = $(this).mtValidate();

    if (error == false) {
        var seleccionado = isThereCheckSelected("m2");
        if (seleccionado == "Si") {
            error = false;
        } else {
            error = true;

            var title = "Seleccione por lo menos un grado";
            var content = "Debe seleccionar por lo menos un grado para cualquiera de los niveles educativos (Preescolar, Primaria o Secundaria).";
            defaultErrorAlert(title, content);
            const $el = $(".seleccionar-grados").first();
            velocity($el, "scroll");
        }
    }
    if (error == false) {
        var grados = [];
        $(".seleccionar-grados").find("input:checked").each(function (index) {
            grados[index] = {
                "grado": $(this).attr("id").split("-")[2]
            };
        });

        var formulario = $(".form-modificar-modulos").find("input, textarea").serializeArray();
        var url = $("#modulo-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#modulo-imagen").attr("data-color");
        var idModulo = $("#btnUpdateModulo").data().id_modulo;
        loadingPage();

        var data = {
            "comm": "dbs",
            "id_modulo": idModulo,
            "grados": grados,
            "imagen": ((imagen == undefined) ? "" : imagen),
            "modulo-nombre": formulario[0].value,
            "modulo-descripcion": formulario[1].value,
            "color": ((color == undefined) ? "" : color)
        };

        var link = "modificarModulos";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formModulos']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        }
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnEliminarModulo", function () {
    var seleccionado = false;
    $($('#tblModulos').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        function eliminarModulos() {
            var link = "formEliminarModulos";
            var datos = eval(JSON.stringify($("#tblModulos").bootstrapTable('getSelections')));
            var nombre_modulo = datos[0].Nombre;
            var fecha_creacion = datos[0].Creado_el;
            var id = datos[0].Id;
            loadingModal();
            var data = {
                comm: "async",
                nombre: nombre_modulo,
                fecha: fecha_creacion
            };
            var callback = function (data) {
                $(".window-modal").html(data);
                loadedModal();
                $("#btnBajaModulo").on("click", function () {
                    loadingModal();
                    var link = "eliminarModulos";
                    var data = {
                        comm: "dbs",
                        id_modulo: id
                    };
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == true) {
                            closeModal();
                            var datos = eval(JSON.stringify($("#tblModulos").bootstrapTable('getSelections')));
                            datos[0].state = false;

                            $('#tblModulosBaja').bootstrapTable('prepend', datos);
                            $('#tblModulos').bootstrapTable('remove', {
                                field: 'Id',
                                values: [id]
                            });
                            openMessage("#5cb85c", "#FFF", info.resultado);
                            addClassAdministration($("#tblModulos"), "0"); //elementTable, type
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    }
                    requestJson(link, data, callback);
                });
            };
            requestView(link, data, callback);
        }
        openModal(eliminarModulos);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnModuloAlta", function () {
    var seleccionado = false;

    $($('#tblModulosBaja').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblModulosBaja").bootstrapTable('getSelections')));
        var id = datos[0].Id;
        var link = "altaModulos";
        var data = {
            comm: "dbs",
            id_modulo: id
        };
        loadingPage();
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                var datos = eval(JSON.stringify($("#tblModulosBaja").bootstrapTable('getSelections')));
                datos[0].state = false;

                $('#tblModulos').bootstrapTable('prepend', datos);
                $('#tblModulosBaja').bootstrapTable('remove', {
                    field: 'Id',
                    values: [id]
                });

                openMessage("#5cb85c", "#FFF", info.resultado);

                addClassAdministration($("#tblModulosBaja"), "1"); //elementTable, type
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("keyup", "#btnBuscarNameModulo", function () {
    var $busqueda_nombre_modulo = $("#btnBuscarNameModulo").val().trim();
    var $filtro_modulos = "Nombre";

    if ($busqueda_nombre_modulo.trim() == "") {
        var $filtro_modulos = "Todos";
        var $busqueda_nombre_modulo = "0";
    }
    $("#loader-fltrMrRsltAux").show();
    var link = "seleccionar-modulos_filtro";
    var data = {
        comm: "async",
        "busqueda_nombre_modulo": $busqueda_nombre_modulo,
        "filtro_modulos": $filtro_modulos
    };
    var callback = function (data) {
        $(".contenedorModulos").replaceWith(data);
        $("#loader-fltrMrRsltAux").hide();
    };
    requestView(link, data, callback);
});