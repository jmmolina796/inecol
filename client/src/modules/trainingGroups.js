import addClassAdministration from '../shared/addClassAdministration';
import newSessionTemplate from '../templates/newSession';

import _ from 'lodash';

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

// $("#webContent").on("click", "#btnCrearGrupos", function () {
//     loadingContent();
//     var link = "formCrearGrupos";
//     var data = {
//         comm: "async"
//     };
//     var callback = function (data) {
//         $("#webContent").html(data);
//         $.mtStart();
//         loadedContent();
//     }
//     requestView(link, data, callback);
// });

// $("#webContent").on("click", ".remove-tr-session", function() {
//     sessionsIndex -= 1;
//     $(this).parent().remove();
// });

// $("#webContent").on("click", ".add-tr-session", function() {
//     sessionsIndex += 1;
//     const template = newSessionTemplate(sessionsIndex);
//     $(".tr-sessions").append(template);
//     $.mtStart();
// });

// $("#webContent").on("click", "#btnCreateCapacitacion", function () {
//     var error = $(this).mtValidate();
//     if (error == false) {
//         const $sessions = $(".tr-sessions .tr-session-inf");
//         let sessions = [];
//         $sessions.each((i) => {
//             const info = $($sessions[i]).find("input, textarea").serializeArray();
//             const session = {
//                 "cap_sesion_nombre": info[0].value,
//                 "cap_sesion_descripcion": info[1].value
//             };
//             sessions.push(session);
//         })
//         var data = {
//             "comm": "dbs",
//             "capacitacion_nombre": $("#capacitacion-nombre").val(),
//             "capacitacion_descripcion": $("#capacitacion-descripcion").val(),
//             "capacitacion_proyecto": $("#slct-proyectos").val(),
//             "capacitacion_sesiones": sessions
//         };
//         loadingPage();
//         var link = "registrarCapacitaciones";
//         var callback = function (info) {
//             loadedPage();
//             if (info.mensaje == true) {
//                 $("#menu-pc-sesion li[data-file*='formCapacitaciones']").trigger("click");
//                 openMessage("#5cb85c", "#FFF", info.resultado);
//             } else if (info.mensaje == false) {
//                 openMessage("#F00", "#FFF", info.resultado);
//             } else {
//                 openMessage("#F00", "#FFF", info.resultado);
//             }
//         }
//         requestJson(link, data, callback);
//     }
// });

$("#webContent").on("click", "#btnCrearGrupos", function () {
    var seleccionado = false;
    $($('#tblGruposCapacitaciones').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });
    if (seleccionado) {
        var id_cap_sesion = $('#tblGruposCapacitaciones').bootstrapTable('getSelections', 'Id');
        id_cap_sesion = id_cap_sesion[0].Id;
        loadingContent();
        var link = "formCrearGrupos";
        var data = {
            comm: "async",
            id_cap_sesion: id_cap_sesion
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

// $("#webContent").on("click", "#btnModificarCapacitacion", function () {
//     var seleccionado = false;
//     $($('#tblCapacitaciones').bootstrapTable('getSelections')).each(function (index, value) {
//         seleccionado = true;
//     });
//     if (seleccionado) {
//         var id_capacitacion = $('#tblCapacitaciones').bootstrapTable('getSelections', 'Id');
//         id_capacitacion = id_capacitacion[0].Id;

//         loadingContent();
//         var link = "formModificarCapacitaciones";
//         var data = {
//             comm: "async",
//             id_capacitacion: id_capacitacion
//         };
//         var callback = function (data) {
//             $("#webContent").html(data);
//             $.mtStart();
//             $("#btnUpdateCapacitacion").data("id_capacitacion", $("#btnUpdateCapacitacion").attr("data-capacitacion")).removeAttr("data-capacitacion");
//             sessionsIndex = $(".tr-sessions .tr-session-inf").length - 1;
//             loadedContent();
//         }
//         requestView(link, data, callback);
//     } else {
//         openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
//     }
// });

// $("#webContent").on("click", "#btnUpdateCapacitacion", function () {
//     var error = $(this).mtValidate();
//     if (error == false) {
//         const $sessions = $(".tr-sessions .tr-session-inf");
//         var idCapacitacion= $("#btnUpdateCapacitacion").data().id_capacitacion;
//         let sessions = [];
//         $sessions.each((i) => {
//             const info = $($sessions[i]).find("input, textarea").serializeArray();
//             const session = {
//                 "cap_sesion_nombre": info[0].value,
//                 "cap_sesion_descripcion": info[1].value
//             };
//             sessions.push(session);
//         })
//         var data = {
//             "comm": "dbs",
//             "id_capacitacion": idCapacitacion,
//             "capacitacion_nombre": $("#capacitacion-nombre").val(),
//             "capacitacion_descripcion": $("#capacitacion-descripcion").val(),
//             "capacitacion_proyecto": $("#slct-proyectos").val(),
//             "capacitacion_sesiones": sessions
//         };
//         loadingPage();
//         var link = "modificarCapacitaciones";
//         var callback = function (info) {
//             loadedPage();
//             if (info.mensaje == true) {
//                 $("#menu-pc-sesion li[data-file*='formCapacitaciones']").trigger("click");
//                 openMessage("#5cb85c", "#FFF", info.resultado);
//             } else if (info.mensaje == false) {
//                 openMessage("#F00", "#FFF", info.resultado);
//             } else {
//                 openMessage("#F00", "#FFF", info.resultado);
//             }
//         }
//         requestJson(link, data, callback);
//     }
// });

// $("#webContent").on("click", "#btnEliminarCapacitacion", function () {
//     var seleccionado = false;
//     $($('#tblCapacitaciones').bootstrapTable('getSelections')).each(function (index, value) {
//         seleccionado = true;
//     });
//     if (seleccionado) {
//         function eliminarAdmin() {
//             var link = "formEliminarCapacitaciones";
//             var datos = eval(JSON.stringify($("#tblCapacitaciones").bootstrapTable('getSelections')));
//             var nombre_capacitacion = datos[0].Nombre;
//             var id = datos[0].Id;
//             loadingModal();
//             var data = {
//                 comm: "async",
//                 nombre: nombre_capacitacion
//             };
//             var callback = function (data) {
//                 $(".window-modal").html(data);
//                 loadedModal();
//                 $("#btnBajaCapacitacion").on("click", function () {
//                     loadingModal();
//                     var link = "eliminarCapacitaciones";
//                     var data = {
//                         comm: "dbs",
//                         id_capacitacion: id
//                     };
//                     var callback = function (info) {
//                         loadedModal();
//                         if (info.mensaje == true) {
//                             closeModal();
//                             var datos = eval(JSON.stringify($("#tblCapacitaciones").bootstrapTable('getSelections')));
//                             datos[0].state = false;

//                             $('#tblCapacitacionesBaja').bootstrapTable('prepend', datos);
//                             $('#tblCapacitaciones').bootstrapTable('remove', {
//                                 field: 'Id',
//                                 values: [id]
//                             });

//                             openMessage("#5cb85c", "#FFF", info.resultado);

//                             addClassAdministration($("#tblCapacitaciones"), "0"); //elementTable, type
//                         } else {
//                             openMessage("#F00", "#FFF", info.resultado);
//                         }
//                     }
//                     requestJson(link, data, callback);
//                 });
//             };
//             requestView(link, data, callback);
//         }
//         openModal(eliminarAdmin);
//     } else {
//         openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
//     }
// });

// $("#webContent").on("click", ".btnCancelCapacitacion", function () {
//     $("#menu-pc-sesion li[data-file*='formCapacitaciones']").trigger("click");
// });

// $("#webContent").on("click", "#btnCapacitacionAlta", function () {
//     var seleccionado = false;

//     $($('#tblCapacitacionesBaja').bootstrapTable('getSelections')).each(function (index, value) {
//         seleccionado = true;
//     });
//     if (seleccionado) {
//         var datos = eval(JSON.stringify($("#tblCapacitacionesBaja").bootstrapTable('getSelections')));
//         var id = datos[0].Id;
//         var link = "altaCapacitaciones";
//         var data = {
//             comm: "dbs",
//             id_capacitacion: id
//         };
//         loadingPage();
//         var callback = function (info) {
//             loadedPage();
//             if (info.mensaje == true) {
//                 var datos = eval(JSON.stringify($("#tblCapacitacionesBaja").bootstrapTable('getSelections')));
//                 datos[0].state = false
//                 $('#tblCapacitaciones').bootstrapTable('prepend', datos);
//                 $('#tblCapacitacionesBaja').bootstrapTable('remove', {
//                     field: 'Id',
//                     values: [id]
//                 });

//                 openMessage("#5cb85c", "#FFF", info.resultado);

//                 addClassAdministration($("#tblCapacitacionesBaja"), "1"); //elementTable, type
//             } else {
//                 openMessage("#F00", "#FFF", info.resultado);
//             }
//         }
//         requestJson(link, data, callback);
//     } else {
//         openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
//     }
// });