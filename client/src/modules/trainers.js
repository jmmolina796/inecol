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

$("#webContent").on("change", "#capacitador-imagen", function () {
    var error = validateFile($(this));
    if (!error) {
        $(this).closest(".fl").addClass("fl-loading");
        var element = $(this);
        var mult = "img";
        var type = "capacitadores";
        var callback = function (info) {
            $("#capacitador-imagen").parent().find("img").attr("src", info.link);
            $("#capacitador-imagen").closest(".fl").addClass("fl-loaded").removeClass("fl-loading");
            var elementSpan = element.parent().find(".img-file span");

            $("#capacitador-imagen").parent().imagesLoaded().then(function () {
                var elementImage = $("#capacitador-imagen").parent().find("img");
                var arr = getDominantColor(elementImage);
                $("#capacitador-imagen").attr("data-color", arr);
            });

            setImageDeleteEvent(elementSpan, "capImg");
        }
        uploadMultimedia(element, mult, type, callback);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado es incorrecto. Solo se permiten imágenes.";
        defaultErrorAlert(title, content);
    }
});

$("#webContent").on("click", "#btnNuevoCapacitador", function () {
    var link = "formRegistrarCapacitadores";

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

$("#webContent").on("click", ".btnCancelCapacitador", function () {
    $("#menu-pc-sesion li[data-file*='formCapacitadores']").trigger("click");
});

// $("#webContent").on("click", "#btnCreateJuez", function () {
//     var error = $(this).mtValidate();
//     var contrasena1 = $("#juez-password").val().trim();
//     var contrasena2 = $("#juez-passwordCon").val().trim();

//     if (error == false) {
//         if (contrasena1 != contrasena2) {
//             error = true;
//             $("#juez-passwordCon").val("");
//             $("#juez-password").val("");
//             var title = "Contraseñas";
//             var content = "Las contraseñas no coinciden.";
//             var element = $("#juez-password");
//             defaultErrorAlert(title, content, element);

//         }
//     }
//     if (error == false) {
//         var formulario = $(".form-registrar-juez").find("input").serializeArray();
//         var url = $("#juez-imagen").parent().find(".img-file img").attr("src");
//         var imagen = getUrlImage(url);
//         var color = $("#juez-imagen").attr("data-color");
//         var proyectos = (($("#slct-proyectos").data().values.length == 0) ? "" : $("#slct-proyectos").data().values);
//         imagen = imagen == undefined ? "" : imagen;
//         color = color == undefined ? "" : color;

//         var data = {
//             "comm": "dbs",
//             "nombre": formulario[0].value,
//             "ape_paterno": formulario[1].value,
//             "ape_materno": formulario[2].value,
//             "email": formulario[3].value,
//             "nombre_usuario": formulario[4].value,
//             "password": formulario[5].value,
//             "telefono": formulario[6].value,
//             "proyectos_calificar": proyectos,
//             "imagen": imagen,
//             "color": color
//         };

//         debugger;

//         // data += "&imagen=" + imagen + "&proyectos_calificar=" + proyectos + "&color=" + color + "&comm=dbs";

//         loadingPage();
//         var link = "registrarJueces";
//         var callback = function (info) {
//             loadedPage();
//             if (info.mensaje == true) {
//                 $("#menu-pc-sesion li[data-file*='formJueces']").trigger("click");
//                 openMessage("#5cb85c", "#FFF", info.resultado);
//             } else if (info.mensaje == false) {
//                 openMessage("#F00", "#FFF", info.resultado);
//             } else if (info.mensaje == "usuario") {
//                 var title = "Nombre de usuario";
//                 var content = info.resultado;
//                 var element = $("#juez-usuario");
//                 defaultErrorAlert(title, content, element);
//             } else if (info.mensaje == "email") {
//                 var title = "Correo electrónico";
//                 var content = info.resultado;
//                 var element = $("#juez-correo");
//                 defaultErrorAlert(title, content, element);
//             } else {
//                 openMessage("#F00", "#FFF", info.resultado);
//             }
//         };
//         requestJson(link, data, callback);
//     }
// });

// $("#webContent").on("click", "#btnConsultarJuez", function () {
//     var seleccionado = false;

//     $($('#tblJueces').bootstrapTable('getSelections')).each(function (index, value) {
//         seleccionado = true;
//     });

//     if (seleccionado) {
//         var datos = eval(JSON.stringify($("#tblJueces").bootstrapTable('getSelections')));
//         var link = "formConsultarJueces";

//         var id = datos[0].Id;

//         loadingContent();
//         var data = {
//             comm: "async",
//             id_juez: id
//         };
        
//         var callback = function (data) {
//             $("#webContent").html(data);
//             $.mtStart();
//             loadedContent();
//         }
//         requestView(link, data, callback);
//     } else {
//         openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
//     }

// });

// $("#webContent").on("click", "#btnModificarJuez", function () {
//     var seleccionado = false;
//     $($('#tblJueces').bootstrapTable('getSelections')).each(function (index, value) {
//         seleccionado = true;
//     });
//     if (seleccionado) {
//         var datos = eval(JSON.stringify($("#tblJueces").bootstrapTable('getSelections')));
//         var id = datos[0].Id;

//         loadingContent();
//         var link = "formModificarJueces";
//         var data = {
//             comm: "async",
//             id_juez: id
//         };
//         var callback = function (data) {
//             $("#webContent").html(data);
//             $.mtStart();
//             loadedContent();
//             $("#btnUpdateJuez").data("id_juez", $("#btnUpdateJuez").attr("data-juez")).removeAttr("data-juez");
//             var img = $("#juez-imagen").attr("data-img");
//             if (img != "") {
//                 $("#juez-imagen").removeAttr("data-img");
//                 $("#juez-imagen").parent().find(".img-file>img").attr("src", img);
//                 $("#juez-imagen").parent().parent().addClass("fl-loaded");

//                 var elementSpan = $("#juez-imagen").parent().find(".img-file span");
//                 setImageDeleteEvent(elementSpan, "jueImg");
//             }
//         }
//         requestView(link, data, callback);
//     } else {
//         openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
//     }

// });

// $("#webContent").on("click", "#btnUpdateJuez", function() {
//     var error = $(this).mtValidate();
//     if (error == false) {
//         var formulario = $(".form-modificar-juez").find("input").serializeArray();
//         var id = $("#btnUpdateJuez").data().id_juez;
//         var url = $("#juez-imagen").parent().find(".img-file img").attr("src");
//         var imagen = getUrlImage(url);
//         var color = $("#juez-imagen").attr("data-color");
//         var proyectos_calificar = (($("#slct-proyectos").data().values.length == 0) ? "" : $("#slct-proyectos").data().values);

//         var data = {
//             "comm": "dbs",
//             "id_juez": id,
//             "nombre": formulario[0].value,
//             "ape_paterno": formulario[1].value,
//             "ape_materno": formulario[2].value,
//             "email": formulario[3].value,
//             "nombre_usuario": formulario[4].value,
//             "password": formulario[5].value,
//             "telefono": formulario[6].value,
//             "proyectos_calificar": proyectos_calificar,
//             "imagen": ((imagen == undefined) ? "" : imagen),
//             "color": ((color == undefined) ? "" : color)
//         };

//         loadingPage();
//         var link = "modificarJueces";
//         var callback = function (info) {
//             debugger;
//             loadedPage();
//             if (info.mensaje == true) {
//                 $("#menu-pc-sesion li[data-file*='formJueces']").trigger("click");
//                 openMessage("#5cb85c", "#FFF", info.resultado);
//             } else if (info.mensaje == false) {
//                 openMessage("#F00", "#FFF", info.resultado);
//             } else if (info.mensaje == "usuario") {
//                 var title = "Nombre de usuario";
//                 var content = info.resultado;
//                 var element = $("#juez-usuario");
//                 defaultErrorAlert(title, content, element);
//             } else if (info.mensaje == "email") {
//                 var title = "Correo electrónico";
//                 var content = info.resultado;
//                 var element = $("#juez-correo");
//                 defaultErrorAlert(title, content, element);
//             } else {
//                 openMessage("#F00", "#FFF", info.resultado);
//             }
//         };
//         requestJson(link, data, callback);
//     }
// });

// $("#webContent").on("click", "#btnEliminarJuez", function () {
//     var seleccionado = false;

//     $($('#tblJueces').bootstrapTable('getSelections')).each(function (index, value) {
//         seleccionado = true;
//     });
//     if (seleccionado) {

//         function eliminarJuez() {
//             var link = "formEliminarJueces";
//             var datos = eval(JSON.stringify($("#tblJueces").bootstrapTable('getSelections')));

//             var nombre_juez = datos[0].Nombre + " " + datos[0].Ape_paterno + " " + datos[0].Ape_materno;
//             var id = datos[0].Id;

//             loadingModal();
//             var data = {
//                 comm: "async",
//                 nombre: nombre_juez
//             };
//             var callback = function (data) {
//                 $(".window-modal").html(data);
//                 loadedModal();

//                 $("#btnBajaJuez").on("click", function () {
//                     loadingModal();
//                     var link = "eliminarJueces";
//                     var data = {
//                         comm: "dbs",
//                         id_juez: id
//                     };
//                     var callback = function (info) {
//                         loadedModal();
//                         if (info.mensaje == true) {
//                             closeModal();

//                             var datos = eval(JSON.stringify($("#tblJueces").bootstrapTable('getSelections')));
//                             datos[0].state = false;

//                             $('#tblJuecesBaja').bootstrapTable('prepend', datos);
//                             $('#tblJueces').bootstrapTable('remove', {
//                                 field: 'Id',
//                                 values: [id]
//                             });

//                             openMessage("#5cb85c", "#FFF", info.resultado);

//                             addClassAdministration($("#tblJueces"), "0"); //elementTable, type
//                         } else {
//                             openMessage("#F00", "#FFF", info.resultado);
//                         }
//                     };
//                     requestJson(link, data, callback);
//                 });
//             };
//             requestView(link, data, callback);
//         }
//         openModal(eliminarJuez);
//     } else {
//         openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
//     }
// });

// $("#webContent").on("click", "#btnJuezAlta", function () {
//     var seleccionado = false;

//     $($('#tblJuecesBaja').bootstrapTable('getSelections')).each(function (index, value) {
//         seleccionado = true;
//     });
//     if (seleccionado) {
//         var datos = eval(JSON.stringify($("#tblJuecesBaja").bootstrapTable('getSelections')));
//         var id = datos[0].Id;

//         var link = "altaJueces";
//         var data = {
//             comm: "dbs",
//             id_juez: id
//         };
//         loadingPage();
//         var callback = function (info) {
//             loadedPage();
//             if (info.mensaje == true) {
//                 var datos = eval(JSON.stringify($("#tblJuecesBaja").bootstrapTable('getSelections')));
//                 datos[0].state = false
//                 $('#tblJueces').bootstrapTable('prepend', datos);
//                 $('#tblJuecesBaja').bootstrapTable('remove', {
//                     field: 'Id',
//                     values: [id]
//                 });
//                 openMessage("#5cb85c", "#FFF", info.resultado);
//                 addClassAdministration($("#tblJuecesBaja"), "1"); //elementTable, type
//             } else {
//                 openMessage("#F00", "#FFF", info.resultado);
//             }
//         };
//         requestJson(link, data, callback);
//     } else {
//         openAlert("Seleccione un registro", "Debe seleccionar un registro.", "message");
//     }
// });