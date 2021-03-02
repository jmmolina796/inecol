import addClassAdministration from '../shared/addClassAdministration';
import entidadesMunicipios from '../eventCreators/entidadesMunicipios';

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
    defaultErrorAlert
} from '../shared/alert';

import {
    openMessage
} from '../shared/message';

$("#webContent").on("click", "#btnNuevoEscuela", function () {
    var link = "formRegistrarEscuelas";
    loadingContent();
    var data = {
        comm: "async"
    };
    var callback = function (data) {
        $("#webContent").html(data);
        $.mtStart();
        loadedContent();
        entidadesMunicipios("#escuela-entidad", "#escuela-municipio");
    };
    requestView(link, data, callback);

});

$("#webContent").on("click", ".btnCancelEscuelas", function () {
    $("#menu-pc-sesion li[data-file*='formEscuelas']").trigger("click");
});

$("#webContent").on("click", "#btnCreateEscuela", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var data = $(".form-registrar-escuela").find("input, select").serialize();
        data += "&comm=dbs";

        loadingPage();
        var link = "registrarEscuelas";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formEscuelas']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else if (info.mensaje == "clave") {
                var title = "Clave de la escuela";
                var content = info.resultado;
                var element = $("#escuela-clave");
                defaultErrorAlert(title, content, element);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnConsultarEscuela", function () {
    var seleccionado = false;
    $($('#tblEscuelas').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblEscuelas").bootstrapTable('getSelections')));
        var link = "formConsultarEscuelas";
        var id = datos[0].clave;

        loadingContent();
        var data = {
            comm: "async",
            id_escuela: id
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            loadedContent();
            entidadesMunicipios("#escuela-entidad", "#escuela-municipio");
        };
        requestView(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnModificarEscuela", function () {
    var seleccionado = false;
    $($('#tblEscuelas').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblEscuelas").bootstrapTable('getSelections')));
        var link = "formModificarEscuelas";
        var id = datos[0].clave;

        loadingContent();
        var data = {
            comm: "async",
            id_escuela: id
        };
        var callback = function (data) {
            $("#webContent").html(data);
            $.mtStart();
            loadedContent();
            entidadesMunicipios("#escuela-entidad", "#escuela-municipio");
        };
        requestView(link, data, callback);

    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnUpdateEscuela", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var data = $(".form-modificar-escuela").find("input, textarea, select").serialize();
        data += "&comm=dbs";
        loadingPage();

        var link = "modificarEscuelas";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formEscuelas']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else if (info.mensaje == "clave") {
                var title = "Clave de la escuela";
                var content = info.resultado;
                var element = $("#escuela-clave");
                defaultErrorAlert(title, content, element);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnEliminarEscuela", function () {
    var seleccionado = false;
    $($('#tblEscuelas').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        function eliminarEscuela() {
            var datos = eval(JSON.stringify($("#tblEscuelas").bootstrapTable('getSelections')));
            var link = "formEliminarEscuelas";
            var nombre_escuela = datos[0].nombre;
            var clave_escuela = datos[0].clave;
            loadingModal();
            var data = {
                comm: "async",
                nombre: nombre_escuela,
                clave: clave_escuela
            };
            var callback = function (data) {
                $(".window-modal").html(data);
                $.mtStart();
                loadedModal();
                $("#btnBajaEscuela").on("click", function () {
                    loadingModal();
                    var link = "eliminarEscuelas";
                    var data = {
                        comm: "dbs",
                        clave: clave_escuela
                    };
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == true) {
                            closeModal();
                            var datos = eval(JSON.stringify($("#tblEscuelas").bootstrapTable('getSelections')));
                            datos[0].state = false;

                            $('#tblEscuelasBaja').bootstrapTable('prepend', datos);
                            $('#tblEscuelas').bootstrapTable('remove', {
                                field: 'clave',
                                values: [clave_escuela]
                            });

                            openMessage("#5cb85c", "#FFF", info.resultado);

                            addClassAdministration($("#tblEscuelas"), "0"); //elementTable, type
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }
                    };
                    requestJson(link, data, callback);
                });
            };
            requestView(link, data, callback);
        }
        openModal(eliminarEscuela);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }
});

$("#webContent").on("click", "#btnEscuelaAlta", function () {
    var seleccionado = false;

    $($('#tblEscuelasBaja').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var datos = eval(JSON.stringify($("#tblEscuelasBaja").bootstrapTable('getSelections')));
        var clave_escuela = datos[0].clave;
        var link = "altaEscuelas";
        var data = {
            comm: "dbs",
            clave_escuela: clave_escuela
        };
        loadingPage();
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                var datos = eval(JSON.stringify($("#tblEscuelasBaja").bootstrapTable('getSelections')));
                datos[0].state = false
                $('#tblEscuelas').bootstrapTable('prepend', datos);
                $('#tblEscuelasBaja').bootstrapTable('remove', {
                    field: 'clave',
                    values: [clave_escuela]
                });
                openMessage("#5cb85c", "#FFF", info.resultado);
                addClassAdministration($("#tblEscuelasBaja"), "1"); //elementTable, type
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }

        };
        requestJson(link, data, callback);
    } else {
        openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
    }

});


$("#webContent").on("change", "#escuelas-tipos", function () {
    var tipo = $("#escuelas-tipos").val();
    var numero_docentes = $("#escuela-maestros").val();

    loadingPage();
    var link = "escuelasFiltros";
    var data = {
        comm: "async",
        "numero_docentes": numero_docentes,
        "tipo": tipo
    };
    var callback = function (data) {
        loadedPage();
        $(".divContainerTable").empty().append(data);
        loadFilesMenu();

    }
    requestView(link, data, callback);
});

$("#webContent").on("change", "#escuela-maestros", function () {
    var numero_docentes = $("#escuela-maestros").val();
    var tipo = $("#escuelas-tipos").val();

    if (numero_docentes == 1) {
        var elemento = $("#escuelas-tipos option").eq(2);
        var texto = elemento.text();
        $("#escuelas-tipos").siblings("input").val(texto);
        elemento.prop("selected", true);
        $("#escuelas-tipos option").eq(1).prop("disabled", true);
        tipo = 2;
    } else {
        $("#escuelas-tipos option").eq(1).prop("disabled", false);
    }

    loadingPage();
    var link = "escuelasFiltros";
    var data = {
        comm: "async",
        "numero_docentes": numero_docentes,
        "tipo": tipo
    };
    var callback = function (data) {
        loadedPage();
        $(".divContainerTable").empty().append(data);
        loadFilesMenu();

    }
    requestView(link, data, callback);
});