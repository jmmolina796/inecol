import velocity from 'velocity-animate';
import getDominantColor from '../shared/getDominantColor';
import addClassAdministration from '../shared/addClassAdministration';
import entidadesMunicipios from '../eventCreators/entidadesMunicipios';
import registroDocentesCorrecto from '../shared/registroDocentesCorrecto';

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

$("#webContent").on("click", "#btnNuevoDocente", function () {
    loadingContent();
    var link = "formRegistrarDocentes";
    var data = {
        comm: "async"
    };
    var callback = function (data) {
        $("#webContent").html(data);
        $.mtStart();
        loadedContent();
        entidadesMunicipios("#slEntidad", "#slMunicipio");
    }
    requestView(link, data, callback);
});

$("#webContent").on("click", ".btnCancelar-agregarEscuela", function () {
    $(".contenedor-buscar-escuela").show();
    $("#containerTablaEscuelaEncontrada").hide();
});

$("#webContent").on("click", ".btnBuscarEscuelas", function () {
    if ($("#docente-escuelas").val().trim() != "") {
        loadingPage();
        var clavect = $("#docente-escuelas").val();
        var link = "consultarEscuelaDocente";
        var data = {
            comm: "async",
            clave: clavect
        };
        var callback = function (data) {
            $("#containerTablaEscuelaEncontrada").html(data);
            loadedPage();
            $.mtStart();
            $(".contenedor-buscar-escuela").hide();
            $('#tblEscuelaDocente').bootstrapTable();
            $("#containerTablaEscuelaEncontrada .fixed-table-header").remove();
            $("#containerTablaEscuelaEncontrada").css("display", "block");
            var tam = $("#wrapper").css("height");
            const $el = $("#containerTablaEscuelaEncontrada");
            velocity($el, "scroll");
        };
        requestView(link, data, callback);
    } else {
        var title = "Clave de la escuela";
        var content = "Debe escribir la clave de la escuela para poder buscarla.";
        var element = $("#docente-escuelas");
        defaultErrorAlert(title, content, element);
    }
});


$("#webContent").on("click", "#btnAgregarEscuela", function () {
    var datosEscuela = [];
    var seleccionado = false;
    $('#tblEscuelaDocente tbody tr.selected td').each(function (index) {
        seleccionado = true;
    });
    var validaEscuelas = "";
    if (seleccionado) {
        var claveBuscada = $('#tblEscuelaDocente tbody tr.selected td').eq(0).text();
        $("#tblEscuelasAgregadasDocente tbody tr").each(function (index) {
            claveEscuelasAgregadas = $(this).find('td').eq(0).text();
            if (claveBuscada == claveEscuelasAgregadas) {
                validaEscuelas = "error";
            }
        });
        if (validaEscuelas != "error") {
            $("#docente-escuelas").val("");
            $(".btnOtraEscuela").show();

            var link = "agregarEscuelasDocente";
            var data = {
                comm: "req",
                clave: claveBuscada
            };
            var callback = function (data) {
                var trNoRecords = $("#tblEscuelasAgregadasDocente tbody .no-records-found");
                if (trNoRecords.length > 0) {
                    trNoRecords.remove();
                }
                $("#containerTablaEscuelasAgregadas").css("display", "block");
                $('#tblEscuelasAgregadasDocente').append(data);
                $('#tblEscuelasAgregadasDocente').bootstrapTable();
                $("#containerTablaEscuelasAgregadas .fixed-table-header").remove();
                $("#containerTablaEscuelaEncontrada").css("display", "none");
            };
            requestView(link, data, callback);
        } else {
            var title = "Escuela agregada";
            var content = "La escuela elegida ya se encuentra agregada.";
            defaultErrorAlert(title, content);
        }
    } else {
        openAlert("Seleccione la escuela", "Debe seleccionar la escuela.", "message");
    }
});


$("#webContent").on("click", ".btnEliminarEscuelaDocente", function () {
    var clave = $(this).parent().parent().find("td").eq(0).text().trim();

    var functionAceptar = eliminarEscuela;
    var functionCancelar = function () {};
    openAlert("¿Eliminar escuela?", "¿Está seguro que desea eliminar la escuela con clave " + clave + "?", "confirm", "Aceptar", "Cancelar", functionCancelar, functionAceptar);

    var element = $(this);

    function eliminarEscuela() {
        element.parent().parent().remove();
        if ($("#tblEscuelasAgregadasDocente tbody tr").length == 0) {
            $("#containerTablaEscuelasAgregadas").css("display", "none");
            $(".contenedor-buscar-escuela").show();
            $("#docente-escuelas").blur();
        }
    }
});




$("#webContent").on("click", ".iconAgregarEscuela", function () {
    var filacopiada = $(this).parent().parent();
    $(this).parent().parent().clone(true).insertAfter('#tblEscuelasAgregadasDocente tbody>tr:last');
})

$("#webContent").on("click", ".btnAceptarDocentes", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var url = $("#docente-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#docente-imagen").attr("data-color");

        var formulario = $(".form-docentes").find("input,select,#ck-doc-pasevic").serializeArray();

        if ($("#tblEscuelasAgregadasDocente tbody tr").length > 0) {
            var clave = "";
            var claveSinGradosOGrupos = "";
            var id_grado = "";
            var id_grado1 = "";
            var id_grado2 = "";
            var id_grupo = "";
            var id_grupo1 = "";
            var id_grupo2 = "";
            var grado1 = "";
            var grado2 = "";
            var grupo1 = "";
            var grupo2 = "";
            var clave1 = "";
            var clave2 = "";
            var datos = [];
            error = false;
            $("#tblEscuelasAgregadasDocente tbody tr").each(function (index) {
                clave = $(this).find('td').eq(0).text().trim();
                id_grado = $(this).find("td").find(".slgrado option:selected").val();
                id_grupo = $(this).find("td").find(".slgrupo option:selected").val();
                if (id_grado == "none" || id_grupo == "none") {
                    error = true;
                    return false;
                } else {
                    datos[index] = [{
                        "clave": clave
                    }, {
                        "id_grado": id_grado
                    }, {
                        "id_grupo": id_grupo
                    }];
                }
            });
            if (error == false) {
                $("#tblEscuelasAgregadasDocente tbody tr").each(function (index1) {
                    if (error) {
                        return false;
                    }
                    clave1 = $(this).find('td').eq(0).text().trim();
                    grado1 = $(this).find("td").find(".slgrado option:selected").text().trim();
                    grupo1 = $(this).find("td").find(".slgrupo option:selected").text().trim();
                    id_grado1 = $(this).find("td").find(".slgrado option:selected").val().trim();
                    id_grupo1 = $(this).find("td").find(".slgrupo option:selected").val().trim();
                    $("#tblEscuelasAgregadasDocente tbody tr").each(function (index2) {
                        clave2 = $(this).find('td').eq(0).text().trim();
                        grado2 = $(this).find("td").find(".slgrado option:selected").text().trim();
                        grupo2 = $(this).find("td").find(".slgrupo option:selected").text().trim();
                        id_grado2 = $(this).find("td").find(".slgrado option:selected").val().trim();
                        id_grupo2 = $(this).find("td").find(".slgrupo option:selected").val().trim();
                        if (index1 != index2) {
                            if (clave1 == clave2) {
                                if (id_grado1 == id_grado2 && id_grupo1 == id_grupo2) {
                                    error = true;
                                    return false;
                                }
                            }
                        }
                    });
                });
                if (error == false) {
                    loadingPage();
                    var data = {
                        "comm": "dbs",
                        "arreglo": datos,
                        "imagen": imagen,
                        "nombre": formulario[0].value,
                        "ape_paterno": formulario[1].value,
                        "ape_materno": formulario[2].value,
                        "mail": formulario[3].value,
                        "password": formulario[4].value,
                        "nombre_usuario": formulario[5].value,
                        "telefono": formulario[6].value,
                        "id_entidad": formulario[7].value,
                        "id_municipio": formulario[8].value,
                        "localidad": formulario[9].value,
                        "color": (color == undefined) ? "" : color
                    };
                    var link = "registrarDocentes";
                    var callback = function (info) {
                        loadedPage();
                        if (info.mensaje == true) {
                            registroDocentesCorrecto(info.resultado);
                        } else if (info.mensaje == false) {
                            openMessage("#F00", "#FFF", info.resultado);
                        } else if (info.mensaje == "usuario") {
                            var title = "Nombre de usuario";
                            var content = info.resultado;
                            var element = $("#docente-nombre_usuario");
                            defaultErrorAlert(title, content, element);
                        } else if (info.mensaje == "email") {
                            var title = "Correo electrónico";
                            var content = info.resultado;
                            var element = $("#docente-mail");
                            defaultErrorAlert(title, content, element);
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    }
                    requestJson(link, data, callback);
                } else {
                    var title = "El grupo y grado se repiten";
                    var content = "Por favor verifique que en la escuela con clave " + clave1 + " no se repita 2 veces el grado " + grado1 + " y el grupo " + grupo1 + ".";
                    defaultErrorAlert(title, content);
                    const $el = $("#containerTablaEscuelasAgregadas");
                    velocity($el, "scroll");
                }
            } else {
                var title = "Seleccione el grupo y el grado";
                var content = "Debe seleccionar el grado y el grupo de la escuela con clave " + clave + ".";
                defaultErrorAlert(title, content);
                const $el = $("#containerTablaEscuelasAgregadas");
                velocity($el, "scroll");
            }
        } else {
            var title = "Ninguna escuela seleccionada";
            var content = "Debe agregar mínimo una escuela con la cual va a participar.";
            var element = $("#docente-escuelas");
            defaultErrorAlert(title, content, element);
        }
    }
});

$("#webContent").on("click", ".btnCancelDocentes", function () {
    $("#menu-pc-sesion li[data-file*='formDocentes']").trigger("click");
});

$("#webContent").on("click", ".btnOtraEscuela", function () {
    $(".btnOtraEscuela").hide();
    $(".contenedor-buscar-escuela").show();
    $("#docente-escuelas").blur();
});

$("#webContent").on("click", "#btnConsultarDocente", function () {
    var seleccionado = false;
    $($('#tblDocentes').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var id_docente = $('#tblDocentes').bootstrapTable('getSelections', 'Id');
        id_docente = id_docente[0].Id;
        loadingContent();
        var link = "formConsultarDocentes";
        var data = {
            comm: "async",
            id_docente: id_docente
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            loadedContent();
            $('#tblEscuelasAgregadasDocente').bootstrapTable();
            $("#containerTablaEscuelasAgregadas .fixed-table-header").remove();
        }
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnEliminarDocente", function () {
    var seleccionado = false;
    $($('#tblDocentes').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        function eliminarDocentes() {
            var link = "formEliminarDocentes";
            var datos = eval(JSON.stringify($("#tblDocentes").bootstrapTable('getSelections')));
            var nombre_docente = datos[0].Nombre + " " + datos[0].Ape_paterno + " " + datos[0].Ape_materno;
            var id = datos[0].Id;
            loadingModal();
            var data = {
                comm: "async",
                nombre: nombre_docente
            };
            var callback = function (data) {
                $(".window-modal").html(data);
                loadedModal();
                $("#btnBajaDocente").on("click", function () {
                    loadingModal();
                    var link = "eliminarDocentes";
                    var data = {
                        comm: "dbs",
                        id_docente: id
                    };
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == true) {
                            closeModal();
                            var datos = eval(JSON.stringify($("#tblDocentes").bootstrapTable('getSelections')));
                            datos[0].state = false;

                            $('#tblDocentesBaja').bootstrapTable('prepend', datos);
                            $('#tblDocentes').bootstrapTable('remove', {
                                field: 'Id',
                                values: [id]
                            });

                            openMessage("#5cb85c", "#FFF", info.resultado);

                            addClassAdministration($("#tblDocentes"), "0"); //elementTable, type
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    };
                    requestJson(link, data, callback);
                });
            };
            requestView(link, data, callback);
        }
        openModal(eliminarDocentes);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});


$("#webContent").on("click", "#btnModificarDocente", function () {
    var seleccionado = false;
    $($('#tblDocentes').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var id_docente = $('#tblDocentes').bootstrapTable('getSelections', 'Id');
        id_docente = id_docente[0].Id;
        loadingContent();
        var link = "formModificarDocentes";
        var data = {
            comm: "async",
            id_docente: id_docente
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            loadedContent();
            entidadesMunicipios("#slEntidad", "#slMunicipio");
            $('#tblEscuelasAgregadasDocente').bootstrapTable();
            $("#containerTablaEscuelasAgregadas .fixed-table-header").remove();
            var img = $("#docente-imagen").attr("data-img");
            if (img != "") {
                $("#docente-imagen").removeAttr("data-img");
                $("#docente-imagen").parent().find(".img-file>img").attr("src", img);
                $("#docente-imagen").parent().parent().addClass("fl-loaded");

                var elementSpan = $("#docente-imagen").parent().find(".img-file span");
                setImageDeleteEvent(elementSpan, "docImg");
            }
        }
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", ".btnModificarDocentes", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var url = $("#docente-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#docente-imagen").attr("data-color");
        var formulario = $(".form-docentes").find("input,select,#ck-doc-pasevic").serializeArray();
        if ($("#tblEscuelasAgregadasDocente tbody tr").length > 0) {
            var clave = "";
            var claveSinGradosOGrupos = "";
            var id_grado = "";
            var id_grado1 = "";
            var id_grado2 = "";
            var id_grupo = "";
            var id_grupo1 = "";
            var id_grupo2 = "";
            var grado1 = "";
            var grado2 = "";
            var grupo1 = "";
            var grupo2 = "";
            var clave1 = "";
            var clave2 = "";
            var datos = [];
            error = false;
            $("#tblEscuelasAgregadasDocente tbody tr").each(function (index) {
                clave = $(this).find('td').eq(0).text().trim();
                id_grado = $(this).find("td").find(".slgrado option:selected").val();
                id_grupo = $(this).find("td").find(".slgrupo option:selected").val();
                if (id_grado == "none" || id_grupo == "none") {
                    error = true;
                    return false;
                } else {
                    datos[index] = [{
                        "clave": clave
                    }, {
                        "id_grado": id_grado
                    }, {
                        "id_grupo": id_grupo
                    }];
                }
            });
            if (error == false) {
                $("#tblEscuelasAgregadasDocente tbody tr").each(function (index1) {
                    if (error) {
                        return false;
                    }
                    clave1 = $(this).find('td').eq(0).text().trim();
                    grado1 = $(this).find("td").find(".slgrado option:selected").text().trim();
                    grupo1 = $(this).find("td").find(".slgrupo option:selected").text().trim();
                    id_grado1 = $(this).find("td").find(".slgrado option:selected").val().trim();
                    id_grupo1 = $(this).find("td").find(".slgrupo option:selected").val().trim();
                    $("#tblEscuelasAgregadasDocente tbody tr").each(function (index2) {
                        clave2 = $(this).find('td').eq(0).text().trim();
                        grado2 = $(this).find("td").find(".slgrado option:selected").text().trim();
                        grupo2 = $(this).find("td").find(".slgrupo option:selected").text().trim();
                        id_grado2 = $(this).find("td").find(".slgrado option:selected").val().trim();
                        id_grupo2 = $(this).find("td").find(".slgrupo option:selected").val().trim();
                        if (index1 != index2) {
                            if (clave1 == clave2) {
                                if (id_grado1 == id_grado2 && id_grupo1 == id_grupo2) {
                                    error = true;
                                    return false;
                                }
                            }
                        }
                    });
                });
                if (error == false) {
                    var data = {
                        "comm": "dbs",
                        "arreglo": datos,
                        "imagen": imagen,
                        "id_docente": formulario[0].value,
                        "nombre": formulario[1].value,
                        "ape_paterno": formulario[2].value,
                        "ape_materno": formulario[3].value,
                        "mail": formulario[4].value,
                        "password": formulario[5].value,
                        "nombre_usuario": formulario[6].value,
                        "telefono": formulario[7].value,
                        "id_entidad": formulario[8].value,
                        "id_municipio": formulario[9].value,
                        "localidad": formulario[10].value,
                        "color": (color == undefined) ? "" : color
                    };
                    loadingPage();
                    var link = "modificarDocentes";
                    var callback = function (info) {
                        loadedPage();
                        if (info.mensaje == true) {
                            $("#menu-pc-sesion li[data-file*='formDocentes']").trigger("click");
                            openMessage("#5cb85c", "#FFF", "Registro modificado correctamente.");
                        } else if (info.mensaje == false) {
                            openMessage("#F00", "#FFF", info.resultado);
                        } else if (info.mensaje == "usuario") {
                            var title = "Nombre de usuario";
                            var content = info.resultado;
                            var element = $("#docente-usuario");
                            defaultErrorAlert(title, content, element);
                        } else if (info.mensaje == "email") {
                            var title = "Correo electrónico";
                            var content = info.resultado;
                            var element = $("#docente-correo");
                            defaultErrorAlert(title, content, element);
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    }
                    requestJson(link, data, callback);
                } else {
                    var title = "El grupo y grado se repiten";
                    var content = "Por favor verifique que en la escuela con clave " + clave1 + " no se repita 2 veces el grado " + grado1 + " y el grupo " + grupo1 + ".";
                    defaultErrorAlert(title, content);
                    const $el = $("#containerTablaEscuelasAgregadas");
                    velocity($el, "scroll");
                }
            } else {
                var title = "Seleccione el grupo y el grado";
                var content = "Debe seleccionar el grado y el grupo de la escuela con clave " + clave + ".";
                defaultErrorAlert(title, content);
                const $el = $("#containerTablaEscuelasAgregadas");
                velocity($el, "scroll");
            }
        } else {
            var title = "Ninguna escuela seleccionada";
            var content = "Debe agregar mínimo una escuela con la cual va a participar.";
            var element = $("#docente-escuelas");
            defaultErrorAlert(title, content, element);
        }
    }
});


$("#webContent").on("change", "#docente-imagen", function () {
    var error = validateFile($(this));
    if (!error) {
        $(this).closest(".fl").addClass("fl-loading");
        var element = $(this);
        var mult = "img";
        var type = "docentes";
        var callback = function (info) {
            $("#docente-imagen").parent().find("img").attr("src", info.link);
            $("#docente-imagen").closest(".fl").addClass("fl-loaded").removeClass("fl-loading");
            var elementSpan = element.parent().find(".img-file span");
            $("#docente-imagen").parent().imagesLoaded().then(function () {
                var elementImage = $("#docente-imagen").parent().find("img");
                var arr = getDominantColor(elementImage);
                $("#docente-imagen").attr("data-color", arr);
            });
            setImageDeleteEvent(elementSpan, "docImg");
        }
        uploadMultimedia(element, mult, type, callback);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado es incorrecto. Solo se permiten imágenes.";
        defaultErrorAlert(title, content);
    }
});

$("#webContent").on("click", "#tblEscuelaDocente tbody tr", function () {
    if ($(this).attr('class') == "selected") {
        $(this).removeClass("selected")
    } else {
        $(this).parent().parent().find('tbody tr').removeClass('selected');
        $(this).addClass("selected");
    }
});

$("#webContent").on("click", "#btnDocenteAlta", function () {
    var seleccionado = false;

    $($('#tblDocentesBaja').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblDocentesBaja").bootstrapTable('getSelections')));
        var id = datos[0].Id;

        var link = "altaDocentes";
        var data = {
            comm: "dbs",
            id_docente: id
        };
        loadingPage();
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                var datos = eval(JSON.stringify($("#tblDocentesBaja").bootstrapTable('getSelections')));
                datos[0].state = false
                $('#tblDocentes').bootstrapTable('prepend', datos);
                $('#tblDocentesBaja').bootstrapTable('remove', {
                    field: 'Id',
                    values: [id]
                });
                openMessage("#5cb85c", "#FFF", info.resultado);
                addClassAdministration($("#tblDocentesBaja"), "1"); //elementTable, type
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        }
        requestJson(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }

});