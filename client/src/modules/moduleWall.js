import velocity from 'velocity-animate';

import {
    requestJson,
    requestView,
} from '../api';

import {
    openModal,
    loadedModal,
    loadingModal
} from '../shared/modal';

import {
    openAlert,
} from '../shared/alert';

import {
    openMessage
} from '../shared/message';


//unirse al modulo

$("#webContent").on("click", ".unirse-modulo", function () {
    var id_modulo = $(this).attr("data-IdModulo");
    var nombre_modulo = $(this).closest("article").find("h2").text();

    function mostrarTablaGradosUnionDocenteModulo() {
        loadingModal();
        var link = "unirseModuloDocente";
        var data = {
            comm: "req",
            id_modulo: id_modulo,
            nombre_modulo: nombre_modulo
        };
        var callback = function (data) {
            $(".window-modal").html(data);
            loadedModal();
            $(".content-modal").css("width", "90%");
            $('#tblGradosDocenteUnionMuro').bootstrapTable();
            $("#contenedorTablaUnionMuro .fixed-table-header").remove();
            $('#tblGradosDocenteUnionMuro').bootstrapTable('hideColumn', 'id_grado');
            $('#tblGradosDocenteUnionMuro').bootstrapTable('hideColumn', 'id_grupo');

        };
        requestView(link, data, callback);
    }
    openModal(mostrarTablaGradosUnionDocenteModulo);

});

$(".window-modal").on("click", ".btnUnionModulo", function () {
    var seleccionado = false;
    var id_modulo = $(this).attr("data-IdModulo");

    $($('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });

    if (seleccionado) {
        var clave_escuela = $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'clave_escuela')[0].clave_escuela;
        var nom_grado = $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'id_grado')[0].grado;
        var nom_grupo = $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'id_grupo')[0].grupo;
        var nom_nivel = $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'id_grado')[0].nivel;

        var DATA = {
            id_modulo: $(this).attr("data-IdModulo"),
            clave_escuela: $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'clave_escuela')[0].clave_escuela,
            id_grado: $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'id_grado')[0].id_grado,
            id_grupo: $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'id_grupo')[0].id_grupo,
            tipo: "0",
            comm: "req"
        }

        var link = "verificarGradosDocentesCoincidencias";
        var callback = function (info) {
            var functionAceptar = registroModulo;
            var functionCancelar = cancelarRegistro;
            var DATAOBJ = DATA;

            function registroModulo() {
                registrarUnionDocentesMuros(DATAOBJ, '2');
            }

            function cancelarRegistro() {
                $(".unirse-modulo[data-idmodulo='" + id_modulo + "']").trigger("click");
            }

            if (info.mensaje == true) {
                openAlert("¿Unirse al módulo?", "¿Desea unirse al módulo con la escuela que tiene la clave " + clave_escuela + ", grado " + nom_grado + " y el grupo " + nom_grupo + "?", "confirm", "Aceptar", "Cancelar", functionCancelar, functionAceptar);
            } else if (info.mensaje == false) {
                openAlert("¿Unirse al módulo?", "El módulo al que desea unirse no fue creado para el grado " + nom_grado + " de " + nom_nivel + ".\n ¿Desea unirse de todos modos con la escuela que tiene la clave " + clave_escuela + ", grado " + nom_grado + " de " + nom_nivel + " y el grupo " + nom_grupo + "?", "confirm", "Aceptar", "Cancelar", functionCancelar, functionAceptar);
            } else {
                openMessage("#F00", "#FFF", info.resultado);

            }
        };
        requestJson(link, DATA, callback);
    } else {
        var functionCancelar = function functionAceptar() {
            $(".unirse-modulo[data-idmodulo='" + id_modulo + "']").trigger("click");
        }
        openAlert("Seleccione la escuela", "Debe seleccionar la escuela con el que se va a unir al módulo.", "message", "Aceptar", "", functionCancelar);
    }
});