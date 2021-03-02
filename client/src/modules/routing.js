import {
    URL_GLOBAL,
    URL_MENSAJES
} from '../constants';

import loadedImagesPage from '../shared/loadedImagesPage';
import configurationLoad from '../shared/configurationLoad';
import scrollDownChats from '../shared/scrollDownChats';

import {
    getRoutingName,
    getUrlLocal,
    getURLAfter,
    routing,
    setUrlLocal
} from '../helpers/urls';

import {
    goToUrl
} from '../helpers/routing';

import {
    requestView
} from '../api';

import {
    closeModal
} from '../shared/modal';

window.addEventListener('popstate', (e) => {
    var lastUrl = getRoutingName(getUrlLocal(), 1);
    var auxChatFlag = false;
    var data = {
        comm: "sync",
        "ldfl": true
    };
    var loadNewFlag = false;

    if (routing(1, "mensajes") && getURLAfter(3) != "") {
        var nombre_usuario = getURLAfter(3);
        var urlLocal = getUrlLocal();
        var actualUrl = window.location.href;;
        var cant = $(".chats article").find("a[href='" + URL_GLOBAL + URL_MENSAJES + nombre_usuario + "']").length;
        loadNewFlag = (urlLocal != actualUrl && cant == 0);

        data = {
            comm: "sync",
            "ldfl": true,
            "loadNew": loadNewFlag
        };

        if (lastUrl.name != "mensajes") {
            auxChatFlag = true;
            data = {
                comm: "sync",
                "ldfl": true,
                "auxChat": auxChatFlag
            }; //mensajesUsuario - Controller
        }
        $(".mensajes").addClass("loading");
    }

    var link = window.location.href;
    var callback = (data) => {
        setUrlLocal();

        closeModal(false);
        var html = $(data);
        document.title = html.eq(0).text();
        var nombre_usuario = getURLAfter(3);
        if (routing(1, "mensajes") && nombre_usuario != "" && !auxChatFlag) {

            $(".contenedor-chats .mensajesContent").html(html.eq(1).html());

            if (loadNewFlag) {
                $(".contenedor-chats .chats").prepend(html.eq(2));
            }

            $(".mensajes").removeClass("loading");
            $(".contenedor-chats").removeClass("onlyChats").addClass("onlyMensajes");
            $(".chats article").removeClass("seleccionado");
            $(".chats article").find("a[href='" + URL_GLOBAL + URL_MENSAJES + nombre_usuario + "']").parent().addClass("seleccionado");
        } else {
            $("#webContent").html(html.eq(html.length - 1).html());
            loadedImagesPage();
            configurationLoad();
            if ($(".mt-form").length > 0) {
                $.mtStart();
            }
        }

        scrollDownChats();

    }
    requestView(link, data, callback);
});

$("#main").on("click", ".goToUrl", function (e) {
    var link = $(this).find("a").attr("href");
    e.preventDefault();
    goToUrl(link);
});

$(".window-modal").on("click", ".goToUrl", function (e) {
    e.stopImmediatePropagation();
    var link = $(this).find("a").attr("href");
    e.preventDefault();
    goToUrl(link);
    closeModal(false);
});

$("#webContent").on("click", ".slctPrtMuro .goToUrl", function (e) {
    e.stopImmediatePropagation();
    var link = $(this).find("a").attr("href");
    e.preventDefault();
    goToUrl(link);
});

$("#webContent").on("click", ".pageSecCnt .goToUrl", function (e) {
    e.stopImmediatePropagation();
    var link = $(this).find("a").attr("href");
    e.preventDefault();
    goToUrl(link);
});