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

$("#webContent").on("click", "#btnNuevoInstitucion", function () {

    loadingContent();
    var link = "formRegistrarInstituciones";
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

$("#webContent").on("click", "#btnCreateInstitucion", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var data = $(".form-registrar-institucion").find("input, textarea").serialize();
        data += "&comm=dbs";
        loadingPage();
        var link = "registrarInstituciones";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formInstituciones']").trigger("click");
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

$("#webContent").on("click", "#btnConsultarInstitucion", function () {
    var seleccionado = false;
    $($('#tblInstituciones').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var id_institucion = $('#tblInstituciones').bootstrapTable('getSelections', 'Id');
        id_institucion = id_institucion[0].Id;
        loadingContent();
        var link = "formConsultarInstituciones";
        var data = {
            comm: "async",
            id_institucion: id_institucion
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

$("#webContent").on("click", "#btnModificarInstitucion", function () {
    var seleccionado = false;
    $($('#tblInstituciones').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var id_institucion = $('#tblInstituciones').bootstrapTable('getSelections', 'Id');
        id_institucion = id_institucion[0].Id;

        loadingContent();
        var link = "formModificarInstituciones";
        var data = {
            comm: "async",
            id_institucion: id_institucion
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            $("#btnUpdateInstitucion").data("id_institucion", $("#btnUpdateInstitucion").attr("data-institucion")).removeAttr("data-institucion");
            loadedContent();
        }
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnUpdateInstitucion", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var data = $(".form-modificar-institucion").find("input, textarea").serialize();
        var idInstitucion = $("#btnUpdateInstitucion").data().id_institucion;
        data += "&id_institucion=" + idInstitucion + "&comm=dbs";
        loadingPage();
        var link = "modificarInstituciones";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje) {
                $("#menu-pc-sesion li[data-file*='formInstituciones']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        }
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnEliminarInstitucion", function () {
    var seleccionado = false;
    $($('#tblInstituciones').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        function eliminarInstitucion() {
            var link = "formEliminarInstituciones";
            var datos = eval(JSON.stringify($("#tblInstituciones").bootstrapTable('getSelections')));
            var nombre_institucion = datos[0].Nombre;
            var id = datos[0].Id;
            loadingModal();
            var data = {
                comm: "async",
                nombre: nombre_institucion
            };
            var callback = function (data) {
                $(".window-modal").html(data);
                loadedModal();
                $("#btnBajaInstitucion").on("click", function () {
                    loadingModal();
                    var link = "eliminarInstituciones";
                    var data = {
                        comm: "dbs",
                        id_institucion: id
                    };
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == true) {
                            closeModal();
                            var datos = eval(JSON.stringify($("#tblInstituciones").bootstrapTable('getSelections')));
                            datos[0].state = false;

                            $('#tblInstitucionesBaja').bootstrapTable('prepend', datos);
                            $('#tblInstituciones').bootstrapTable('remove', {
                                field: 'Id',
                                values: [id]
                            });

                            openMessage("#5cb85c", "#FFF", info.resultado);

                            addClassAdministration($("#tblInstituciones"), "0"); //elementTable, type
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    }
                    requestJson(link, data, callback);
                });
            };
            requestView(link, data, callback);
        }
        openModal(eliminarInstitucion);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", ".btnCancelInstitucion", function () {
    $("#menu-pc-sesion li[data-file*='formInstituciones']").trigger("click");
});

$("#webContent").on("click", "#btnInstitucionAlta", function () {
    var seleccionado = false;

    $($('#tblInstitucionesBaja').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblInstitucionesBaja").bootstrapTable('getSelections')));
        var id = datos[0].Id;
        var link = "altaInstituciones";
        var data = {
            comm: "dbs",
            id_institucion: id
        };
        loadingPage();
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                var datos = eval(JSON.stringify($("#tblInstitucionesBaja").bootstrapTable('getSelections')));
                datos[0].state = false
                $('#tblInstituciones').bootstrapTable('prepend', datos);
                $('#tblInstitucionesBaja').bootstrapTable('remove', {
                    field: 'Id',
                    values: [id]
                });

                openMessage("#5cb85c", "#FFF", info.resultado);

                addClassAdministration($("#tblInstitucionesBaja"), "1"); //elementTable, type
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        }
        requestJson(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});