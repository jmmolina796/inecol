import '../plugins/material-datepicker';

import { validaFechasCiclosEscolares } from '../validations';

import {
    requestJson,
    requestView,
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
} from '../shared/alert';

import {
    openMessage
} from '../shared/message';

$("#webContent").on("click", "#btnNuevoCiclo", function () {
    if ($("#tblCiclosEscolaresActivos").find("input").length == 0) {
        loadingContent();
        var link = "formRegistrarCiclosEscolares";
        var data = {
            comm: "async"
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            loadedContent();
        }
        requestView(link, data, callback);
    } else {
        openAlert("No se puede realizar el registro", "Para poder registrar un nuevo ciclo escolar no tiene que haber ningún ciclo escolar activo.", "message");
    }
});


$("#webContent").on("click", "#btnConsultarCiclo", function () {
    var seleccionado = false;
    $($('#tblCiclosEscolaresActivos').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });

    if (seleccionado) {
        var link = "formConsultarCiclosEscolares";
        var id_ciclo = $('#tblCiclosEscolaresActivos').bootstrapTable('getSelections', 'Id');
        id_ciclo = id_ciclo[0].Id;
        loadingContent();
        var data = {
            comm: "async",
            id_ciclo: id_ciclo
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


$("#webContent").on("click", "#btnModificarCiclo", function () {
    var seleccionado = false;
    $($('#tblCiclosEscolaresActivos').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var link = "formModificarCiclosEscolares";
        var id_ciclo = $('#tblCiclosEscolaresActivos').bootstrapTable('getSelections', 'Id');
        var id_ciclo = id_ciclo[0].Id;
        loadingContent();
        var data = {
            comm: "async",
            id_ciclo: id_ciclo
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

$("#webContent").on("click", "#btnEliminarCiclo", function () {
    var seleccionado = false;
    $($('#tblCiclosEscolaresActivos').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        function eliminarCiclosEscolares() {
            var link = "formEliminarCiclosEscolares";
            var datos = eval(JSON.stringify($("#tblCiclosEscolaresActivos").bootstrapTable('getSelections')));
            var nombre_ciclo_escolar = datos[0].nombre;
            var id = datos[0].Id;
            loadingModal();
            var data = {
                comm: "async",
                nombre: nombre_ciclo_escolar
            };
            var callback = function (data) {
                $(".window-modal").html(data);
                $.mtStart();
                loadedModal();
                $("#btnBajaCicloEscolar").on("click", function () {
                    loadingModal();
                    var link = "eliminarCiclosEscolares";
                    var data = {
                        comm: "dbs",
                        id_ciclo: id
                    };
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == true) {
                            closeModal();
                            var datos = eval(JSON.stringify($("#tblCiclosEscolaresActivos").bootstrapTable('getSelections')));
                            datos[0].state = false;

                            $('#tblHistorialCiclosEscolares').bootstrapTable('prepend', datos);
                            $('#tblCiclosEscolaresActivos').bootstrapTable('remove', {
                                field: 'Id',
                                values: [id]
                            });

                            setTimeout(function () {
                                openMessage("#5cb85c", "#FFF", info.resultado);
                            }, 600);

                            addClassAdministration($("#tblCiclosEscolaresActivos"), "0"); //elementTable, type
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    };
                    requestJson(link, data, callback);
                });
            };
            requestView(link, data, callback);
        }
        openModal(eliminarCiclosEscolares);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", ".btnCancelCiclos", function () {
    $("#menu-pc-sesion li[data-file*='formCiclosEscolares']").trigger("click");
});

$("#webContent").on("click", ".form-registrar-ciclosEscolares .btnAceptarCiclos", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        error = validaFechasCiclosEscolares();
    }
    if (error == false) {
        var data = $(".form-ciclos").find("input").serialize();
        data += "&comm=dbs";

        loadingPage();
        var link = "registrarCiclosEscolares";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje) {
                $("#menu-pc-sesion li[data-file*='formCiclosEscolares']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", ".form-modificar-ciclosEscolares .btnModificarCiclos", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        error = validaFechasCiclosEscolares();
    }
    if (error == false) {
        var data = $(".form-modificar-ciclosEscolares").find("input").serialize();
        data += "&comm=dbs";
        loadingPage();
        var link = "modificarCiclosEscolares";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje) {
                $("#menu-pc-sesion li[data-file*='formCiclosEscolares']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnCicloEscolarAlta", function () {
    var seleccionado = false;

    $($('#tblHistorialCiclosEscolares').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var ciclosActivos = parseInt($("#tblCiclosEscolaresActivos tbody tr td").length);

        if (ciclosActivos == 1) {
            var datos = eval(JSON.stringify($("#tblHistorialCiclosEscolares").bootstrapTable('getSelections')));
            var id = datos[0].Id;
            var link = "validaFechaCicloBaja";
            var data = {
                comm: "req",
                id_ciclo_escolar: id
            };
            loadingPage();
            var callback = function (info) {
                if (info.valida == true) {
                    var link = "altaCiclosEscolares";
                    var data = {
                        comm: "dbs",
                        id_ciclo_escolar: id
                    };
                    var callback = function (info) {
                        loadedPage();
                        if (info.mensaje == true) {
                            closeModal();
                            var datos = eval(JSON.stringify($("#tblHistorialCiclosEscolares").bootstrapTable('getSelections')));

                            datos[0].state = false

                            $('#tblCiclosEscolaresActivos').bootstrapTable('prepend', datos);
                            $('#tblHistorialCiclosEscolares').bootstrapTable('remove', {
                                field: 'Id',
                                values: [id]
                            });

                            openMessage("#5cb85c", "#FFF", info.resultado);

                            addClassAdministration($("#tblHistorialCiclosEscolares"), "1"); //elementTable, type
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    };
                    requestJson(link, data, callback);
                } else {
                    loadedPage();
                    openAlert("Fecha del ciclo escolar finalizada", "No se puede dar de alta un cliclo escolar que ya finalizó su fecha fin.", "message");
                }
            };
            requestJson(link, data, callback);
        } else {
            openAlert("Ya existe un ciclo escolar activo", "No se puede dar de alta un cliclo escolar si hay un cliclo escolar activo.", "message");
        }
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});