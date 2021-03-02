import addClassAdministration from '../shared/addClassAdministration';

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
    openAlert
} from '../shared/alert';

import {
    openMessage
} from '../shared/message';

$("#webContent").on("click", "#btnNuevoAlianza", function () {

    loadingContent();
    var link = "formRegistrarAlianzas";
    var data = {
        comm: "async"
    };
    var callback = function (data) {
        $("#webContent").html(data);
        $.mtStart();
        loadedContent();
    }
    requestView(link, data, callback);

});

$("#webContent").on("click", "#btnCreateAlianza", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var data = $(".form-registrar-alianza").find("input, textarea").serialize();
        data += "&comm=dbs";
        loadingPage();
        var link = "registrarAlianzas";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formAlianzas']").trigger("click");
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

$("#webContent").on("click", "#btnConsultarAlianza", function () {
    var seleccionado = false;
    $($('#tblAlianzas').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var id_alianza = $('#tblAlianzas').bootstrapTable('getSelections', 'Id');
        id_alianza = id_alianza[0].Id;
        loadingContent();
        var link = "formConsultarAlianzas";
        var data = {
            comm: "async",
            id_alianza: id_alianza
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

$("#webContent").on("click", "#btnModificarAlianza", function () {
    var seleccionado = false;
    $($('#tblAlianzas').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var id_alianza = $('#tblAlianzas').bootstrapTable('getSelections', 'Id');
        id_alianza = id_alianza[0].Id;

        loadingContent();
        var link = "formModificarAlianzas";
        var data = {
            comm: "async",
            id_alianza: id_alianza
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            $("#btnUpdateAlianza").data("id_alianza", $("#btnUpdateAlianza").attr("data-alianza")).removeAttr("data-alianza");
            loadedContent();
        }
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnUpdateAlianza", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var data = $(".form-modificar-alianza").find("input, textarea").serialize();
        var idAlianza = $("#btnUpdateAlianza").data().id_alianza;
        data += "&id_alianza=" + idAlianza + "&comm=dbs";
        loadingPage();
        var link = "modificarAlianzas";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje) {
                $("#menu-pc-sesion li[data-file*='formAlianzas']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        }
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnEliminarAlianza", function () {
    var seleccionado = false;
    $($('#tblAlianzas').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        function eliminarAdmin() {
            var link = "formEliminarAlianzas";
            var datos = eval(JSON.stringify($("#tblAlianzas").bootstrapTable('getSelections')));
            var nombre_alianza = datos[0].Nombre;
            var id = datos[0].Id;
            loadingModal();
            var data = {
                comm: "async",
                nombre: nombre_alianza
            };
            var callback = function (data) {
                $(".window-modal").html(data);
                loadedModal();
                $("#btnBajaAlianza").on("click", function () {
                    loadingModal();
                    var link = "eliminarAlianzas";
                    var data = {
                        comm: "dbs",
                        id_alianza: id
                    };
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == true) {
                            closeModal();
                            var datos = eval(JSON.stringify($("#tblAlianzas").bootstrapTable('getSelections')));
                            datos[0].state = false;

                            $('#tblAlianzasBaja').bootstrapTable('prepend', datos);
                            $('#tblAlianzas').bootstrapTable('remove', {
                                field: 'Id',
                                values: [id]
                            });

                            openMessage("#5cb85c", "#FFF", info.resultado);

                            addClassAdministration($("#tblAlianzas"), "0"); //elementTable, type
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    }
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

$("#webContent").on("click", ".btnCancelAlianza", function () {
    $("#menu-pc-sesion li[data-file*='formAlianzas']").trigger("click");
});

$("#webContent").on("click", "#btnAlianzaAlta", function () {
    var seleccionado = false;

    $($('#tblAlianzasBaja').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblAlianzasBaja").bootstrapTable('getSelections')));
        var id = datos[0].Id;
        var link = "altaAlianzas";
        var data = {
            comm: "dbs",
            id_alianza: id
        };
        loadingPage();
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                var datos = eval(JSON.stringify($("#tblAlianzasBaja").bootstrapTable('getSelections')));
                datos[0].state = false
                $('#tblAlianzas').bootstrapTable('prepend', datos);
                $('#tblAlianzasBaja').bootstrapTable('remove', {
                    field: 'Id',
                    values: [id]
                });

                openMessage("#5cb85c", "#FFF", info.resultado);

                addClassAdministration($("#tblAlianzasBaja"), "1"); //elementTable, type
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        }
        requestJson(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});