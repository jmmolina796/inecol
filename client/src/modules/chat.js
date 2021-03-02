import velocity from 'velocity-animate';

import {
    URL_GLOBAL,
    URL_MENSAJES
} from '../constants';

import {
    getURLWall
} from '../helpers/urls';

import {
    requestJson
} from '../api';

import {
    goToUrl
} from '../helpers/routing';

$("#webContent").on("click", ".chats article", function () {
    $(this).addClass("seleccionado").removeClass("nuevo");
    $(this).siblings("article").each(function () {
        $(this).removeClass("seleccionado");
    });
});

$("#webContent").on("click", ".mensajes .return", function () {
    /*$(this).closest(".contenedor-chats").removeClass("onlyMensajes");
    $(this).closest(".contenedor-chats").addClass("onlyChats");
    $(".contenedor-chats .chats").children().removeClass("seleccionado")*/
    goToUrl(URL_GLOBAL + URL_MENSAJES);
});

$("#webContent").on("click", "#sendMessage", function () {
    var mensaje = $("#chatMessage").val().trim();
    if (mensaje != "") {
        var nombre_usuario = getURLWall();
        var link = "enviarMensaje";
        var data = {
            comm: "dbs",
            nombre_usuario: nombre_usuario,
            mensaje: mensaje
        };
        $(".mensajesContent .footer").addClass("loading");
        var callback = function (info) {

            var chatUpdated = $(".contenedor-chats .chats").find(".seleccionado");
            chatUpdated.find(".mensaje").text(info.text);
            chatUpdated.find(".fecha").text(info.date);

            $(".chats").find(">.seleccionado").insertBefore($(".chats").children().eq(0));

            $(".mensajesContent .footer").removeClass("loading");
            $(".mensajesContent .contInt").append(info.men);
            $("#chatMessage").val("");

            var bodyWidth = parseInt($("body").css("width"));
            var mensajesEl = $(".contenedor-chats .contenido");
            var scrollMax = $(".contenedor-chats .contInt").css("height");
            if (bodyWidth < 699) {
                //NO, hasta después de cargar
                velocity(mensajesEl, "scroll", {
                    duration: 0,
                    offset: scrollMax
                });
            } else {
                velocity(mensajesEl, "scroll", {
                    duration: 0,
                    container: mensajesEl,
                    offset: scrollMax
                });
            }

        }
        requestJson(link, data, callback);
    }

});