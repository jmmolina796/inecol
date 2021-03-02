import '../plugins/material-datepicker';
import velocity from 'velocity-animate';
import getDominantColor from '../shared/getDominantColor';
import addClassAdministration from '../shared/addClassAdministration';
import isThereCheckSelected from '../shared/isThereCheckSelected';

import {
    validaFechasConvocatoriasEInicioYFinProyectos,
    validaFechasProyectos,
    validaFechasProyectosConvocatoria,
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

$("#webContent").on("click", "#btnNuevoProyecto", function () {
    loadingContent();
    var link = "formRegistrarProyectos";
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

$("#webContent").on("click", ".btnCancelProyecto", function () {
    $("#menu-pc-sesion li[data-file*='formProyectos']").trigger("click");
});

$("#webContent").on("click", "#btnCreateProyecto", function () {
    var error = $(this).mtValidate();

    if (error == false) {
        error = validaFechasProyectosConvocatoria();
    }

    if (error == false) {
        error = validaFechasProyectos();
    }

    if (error == false) {
        error = validaFechasConvocatoriasEInicioYFinProyectos();
    }

    if (error == false) {
        var seleccionado = isThereCheckSelected("r");
        if (seleccionado == "Si") {
            error = false;
        } else {
            error = true;

            var title = "Seleccione por lo menos un grado";
            var content = "Debe seleccionar por lo menos un grado para cualquiera de los niveles educativos (Preescolar, Primaria o Secundaria).";
            defaultErrorAlert(title, content);
            // $(".seleccionar-grados").first().velocity("scroll");
            velocity($(".seleccionar-grados").first(), "scroll");
        }
    }
    if (error == false) {
        var grados = [];
        $(".seleccionar-grados").find("input:checked").each(function (index) {
            grados[index] = {
                "grado": $(this).attr("id").split("-")[2]
            };
        });
        var formulario = $(".form-registrar-proyectos").find("input, textarea").serializeArray();
        var url = $("#proyecto-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#proyecto-imagen").attr("data-color");
        var alianzas = (($("#slct-alianzas").data().values.length == 0) ? "" : $("#slct-alianzas").data().values);
        loadingPage();

        var data = {
            "comm": "dbs",
            "grados": grados,
            "alianzas": alianzas,
            "imagen": ((imagen == undefined) ? "" : imagen),
            "proyecto-nombre": formulario[0].value,
            "proyecto-fechaInicioInscripcion": formulario[1].value,
            "proyecto-fechaFinInscripcion": formulario[2].value,
            "proyecto-fechaInicio": formulario[3].value,
            "proyecto-fechaFin": formulario[4].value,
            "proyecto-descripcion": formulario[5].value,
            "tipo_proyecto": "N",
            "id_proyecto_renovacion": "-1",
            "color": ((color == undefined) ? "" : color)
        };
        var link = "registrarProyectos";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formProyectos']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else {
                if (info.validaFechas == true) {
                    var title = info.titulo
                    var content = info.resultado;
                    var element = $(info.inputFecha)
                    defaultErrorAlert(title, content, element);
                } else {
                    openMessage("#F00", "#FFF", info.resultado);
                }
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnConsultarProyecto", function () {
    var seleccionado = false;
    $($('#tblProyectos').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var link = "formConsultarProyectos";
        var idProyecto = $('#tblProyectos').bootstrapTable('getSelections', 'Id');
        idProyecto = idProyecto[0].Id;
        loadingContent();
        var data = {
            comm: "async",
            id_proyecto: idProyecto
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

$("#webContent").on("click", "#btnModificarProyecto", function () {
    var seleccionado = false;
    $($('#tblProyectos').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var link = "formModificarProyectos";
        var idProyecto = $('#tblProyectos').bootstrapTable('getSelections', 'Id');
        idProyecto = idProyecto[0].Id;
        loadingContent();
        var data = {
            comm: "async",
            id_proyecto: idProyecto
        };
        var callback = function (data) {

            if (data == "Error") {
                loadedContent();

                var title = "Proyecto inactivo";
                var message = "No se puede modificar el proyecto seleccionado debido a que está inactivo";
                var functionAceptar = recargar;
                openAlert(title, message, "message", "Aceptar", "none", functionAceptar);

                function recargar() {
                    $("#menu-pc-sesion li[data-file*='formProyectos']").trigger("click");
                }
            } else {
                $("#webContent").html(data);
                $.mtStart();
                loadedContent();
                $("#btnUpdateProyecto").data("id_proyecto", $("#btnUpdateProyecto").attr("data-proyecto")).removeAttr("data-proyecto");
                var img = $("#proyecto-imagen").attr("data-img");
                if (img != "") {
                    $("#proyecto-imagen").removeAttr("data-img");
                    $("#proyecto-imagen").parent().find(".img-file>img").attr("src", img);
                    $("#proyecto-imagen").parent().parent().addClass("fl-loaded");

                    var elementSpan = $("#proyecto-imagen").parent().find(".img-file span");
                    setImageDeleteEvent(elementSpan, "proImg");
                }
            }
        };
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});


$("#webContent").on("change", "#proyecto-imagen", function () {
    var error = validateFile($(this));
    if (!error) {
        $(this).closest(".fl").addClass("fl-loading");
        var element = $(this);
        var mult = "img";
        var type = "proyectos";
        var callback = function (info) {
            $("#proyecto-imagen").parent().find("img").attr("src", info.link);
            $("#proyecto-imagen").closest(".fl").addClass("fl-loaded").removeClass("fl-loading");
            var elementSpan = element.parent().find(".img-file span");
            $("#proyecto-imagen").parent().imagesLoaded().then(function () {
                var elementImage = $("#proyecto-imagen").parent().find("img");
                var arr = getDominantColor(elementImage);
                $("#proyecto-imagen").attr("data-color", arr);
            });
            setImageDeleteEvent(elementSpan, "proImg");
        }
        uploadMultimedia(element, mult, type, callback);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado es incorrecto. Solo se permiten imágenes.";
        defaultErrorAlert(title, content);
    }
});


$("#webContent").on("click", "#btnUpdateProyecto", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        error = validaFechasProyectosConvocatoria();
    }

    if (error == false) {
        error = validaFechasProyectos();
    }

    if (error == false) {
        error = validaFechasConvocatoriasEInicioYFinProyectos();
    }

    if (error == false) {
        var seleccionado = isThereCheckSelected("m");
        if (seleccionado == "Si") {
            error = false;
        } else {
            error = true;

            var title = "Seleccione por lo menos un grado";
            var content = "Debe seleccionar por lo menos un grado para cualquiera de los niveles educativos (Preescolar, Primaria o Secundaria).";
            defaultErrorAlert(title, content);
            // $(".seleccionar-grados").first().velocity("scroll");
            velocity($(".seleccionar-grados").first(), "scroll");
        }
    }
    if (error == false) {
        var grados = [];
        $(".seleccionar-grados").find("input:checked").each(function (index) {
            grados[index] = {
                "grado": $(this).attr("id").split("-")[2]
            };
        });

        var formulario = $(".form-modificar-proyectos").find("input, textarea").serializeArray();
        var url = $("#proyecto-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#proyecto-imagen").attr("data-color");
        var idProyecto = $("#btnUpdateProyecto").data().id_proyecto;
        var alianzas = (($("#slct-alianzas").data().values.length == 0) ? "" : $("#slct-alianzas").data().values);
        loadingPage();

        var data = {
            "comm": "dbs",
            "id_proyecto": idProyecto,
            "grados": grados,
            "alianzas": alianzas,
            "imagen": ((imagen == undefined) ? "" : imagen),
            "proyecto-nombre": formulario[0].value,
            "proyecto-fechaInicioInscripcion": formulario[1].value,
            "proyecto-fechaFinInscripcion": formulario[2].value,
            "proyecto-fechaInicio": formulario[3].value,
            "proyecto-fechaFin": formulario[4].value,
            "proyecto-descripcion": formulario[5].value,
            "color": ((color == undefined) ? "" : color)
        };

        var link = "modificarProyectos";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formProyectos']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else {
                if (info.validaFechas == true) {
                    var title = info.titulo
                    var content = info.resultado;
                    var element = $(info.inputFecha)
                    defaultErrorAlert(title, content, element);

                } else {
                    openMessage("#F00", "#FFF", info.resultado);
                }

            }
        }
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnEliminarProyecto", function () {
    var seleccionado = false;
    $($('#tblProyectos').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        function eliminarProyectos() {
            var link = "formEliminarProyectos";
            var datos = eval(JSON.stringify($("#tblProyectos").bootstrapTable('getSelections')));
            var nombre_proyecto = datos[0].Nombre;
            var fecha_creacion = datos[0].Creado_el;
            var id = datos[0].Id;
            loadingModal();
            var data = {
                comm: "async",
                nombre: nombre_proyecto,
                fecha: fecha_creacion
            };
            var callback = function (data) {
                $(".window-modal").html(data);
                loadedModal();
                $("#btnBajaProyecto").on("click", function () {
                    loadingModal();
                    var link = "eliminarProyectos";
                    var data = {
                        comm: "dbs",
                        id_proyecto: id
                    };
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == true) {
                            closeModal();
                            var datos = eval(JSON.stringify($("#tblProyectos").bootstrapTable('getSelections')));
                            datos[0].state = false;

                            $('#tblProyectosBaja').bootstrapTable('prepend', datos);
                            $('#tblProyectos').bootstrapTable('remove', {
                                field: 'Id',
                                values: [id]
                            });
                            openMessage("#5cb85c", "#FFF", info.resultado);
                            addClassAdministration($("#tblProyectos"), "0"); //elementTable, type
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    }
                    requestJson(link, data, callback);
                });
            };
            requestView(link, data, callback);
        }
        openModal(eliminarProyectos);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnProyectoAlta", function () {
    var seleccionado = false;

    $($('#tblProyectosBaja').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblProyectosBaja").bootstrapTable('getSelections')));
        var id = datos[0].Id;
        var link = "altaProyectos";
        var data = {
            comm: "dbs",
            id_proyecto: id
        };
        loadingPage();
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                var datos = eval(JSON.stringify($("#tblProyectosBaja").bootstrapTable('getSelections')));
                datos[0].state = false;

                $('#tblProyectos').bootstrapTable('prepend', datos);
                $('#tblProyectosBaja').bootstrapTable('remove', {
                    field: 'Id',
                    values: [id]
                });

                openMessage("#5cb85c", "#FFF", info.resultado);

                addClassAdministration($("#tblProyectosBaja"), "1"); //elementTable, type
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});