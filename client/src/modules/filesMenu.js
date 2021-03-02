import loadFilesMenu from '../shared/loadFilesMenu';

import {
    setMenu,
    closeMenu
} from '../shared/menu';

import {
    contentEnabled
} from '../shared/contentLoaders';

import {
    routing,
    getNameFile,
    goHome
} from '../helpers/urls';

import {
    loadingContent
} from '../shared/contentLoaders';

import {
    closeCntSession
} from '../shared/menu';

import {
    requestView
} from '../api';

// $(".menu-btn, .menu-btn-pc").on("tap", function () {
$(".menu-btn, .menu-btn-pc").on("click", function () {
    if ($(".menu-btn").hasClass("menu-hold")) {
        $(".menu-btn").removeClass("menu-hold");
    } else {
        setMenu();
    }
});

$("#menu .openFile").on("click", function () {
    var link = $(this).attr("data-file");
    if (routing(1, "")) {
        loadingContent();
        var data = {
            comm: "async"
        };
        var callback = (data) => {
            $("#webContent").html(data);
            loadFilesMenu();
        };
        requestView(link, data, callback);
    } else {
        localStorage.file = getNameFile(link);
        goHome();
    }
});

$(document).on("click", function (event) { //IMPORTANT TO ADD
    if ($("#content-user").css("right") == "0px") {
        closeCntSession();
    }
    if ($("#menu-pc-sesion").css("left") == "0px") {
        closeMenu();
    }
    var element = event.target;
    if ($(element).attr("id") != "txtBusquedaPrincipal" && !$(element).hasClass("btnBusqueda") && !$(element).hasClass("clear")) {
        if ($("#contentSearch").css("display") == "block") {
            $("#contenedorItemsBusqueda").hide();
            $("#contentSearch").removeClass("fixed");
            contentEnabled();
        }
    }
});