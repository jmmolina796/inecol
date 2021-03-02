import 'jquery-touch-events';

import {
    requestView
} from '../api';

import {
    isHomeGuest
} from '../shared/functions';

import {
    contentDisabled
} from '../shared/contentLoaders';

import {
    goToUrl
} from '../helpers/routing';

import {
    getRoutingName
} from '../helpers/urls';

import {
    openAlert
} from '../shared/alert';

$("#busqueda").on("click", "#contendorBotonesBusqueda .auxBotonesBusqueda >div", function () {
    $("#busqueda div").removeClass("selected");
    $(this).addClass("selected");
    $("#auxCntItmsBsqdPrl").empty();
    $("#txtBusquedaPrincipal").val("");
    var filtro = $(this).attr("data-filtro");

    switch (filtro) {
        case 'proyectos':
            $("#msbusqueda").remove();
            $("#txtBusquedaPrincipal").attr("placeholder", "Buscar proyectos:");
            break;
        case 'modulos':
            $("#msbusqueda").remove();
            $("#txtBusquedaPrincipal").attr("placeholder", "Buscar módulos:");
            break;
        case 'docentes':
            $("#msbusqueda").remove();
            $("#txtBusquedaPrincipal").attr("placeholder", "Buscar docentes:");
            break;
        default:
            $("#msbusqueda").remove();
            $("#txtBusquedaPrincipal").attr("placeholder", "Buscar escuelas:");
            //$("#txtBusquedaPrincipal").before("<div style='margin:10px' id='msbusqueda'>Clave de escuela | Nombre escuela | Nombre escuela,Municipio | Nombre escuela,Localidad </div>");
    }
});

$("#busqueda").on("keyup", "#txtBusquedaPrincipal", function () {
    $("#contenedorItemsBusqueda").show();
    var filtroBusqueda = $("#txtBusquedaPrincipal").val().trim();
    if (filtroBusqueda != "") {
        $("#contentTxtBusqueda .clear").show();
        $("#loaderContenedorItemsBusqueda").show();
        var tipoBusqueda = $("#busqueda #contendorBotonesBusqueda div.selected").attr("data-filtro");
        var link = "obtenerBusquedaPrincipal";
        var data = {
            comm: "dbs",
            filtroBusqueda: filtroBusqueda,
            tipoBusqueda: tipoBusqueda
        };
        var callback = function (data) {
            $("#auxCntItmsBsqdPrl").html(data);
            $("#loaderContenedorItemsBusqueda").hide();
        }
        requestView(link, data, callback);
    } else {
        $("#auxCntItmsBsqdPrl").empty();
        $("#contentTxtBusqueda .clear").hide();
    }
});

$("#busqueda").on("keypress", "#txtBusquedaPrincipal", function (e) {

    var key = e.which;
    if (key == 13) // the enter key code
    {
        var text = $(this).val().trim();
        var patt = /^[a-z0-9\sáéíóúÁÉÍÓÚ]+$/;
        if (text != "") {
            $(this).blur();
            if (patt.test(text)) {
                var filtro = $("#contendorBotonesBusqueda").find(".selected").attr("data-filtro");
                var link = URL_GLOBAL;
                switch (filtro) {
                    case 'proyectos':
                        link += URL_BUSQUEDA_PROYECTOS + text;
                        break;
                    case 'modulos':
                        link += URL_BUSQUEDA_MODULOS + text;
                        break;
                    case 'docentes':
                        link += URL_BUSQUEDA_DOCENTES + text;
                        break;
                    default:
                        link += URL_BUSQUEDA_ESCUELAS + text;

                }
                $("#contenedorItemsBusqueda").hide();
                goToUrl(link);
            } else {
                $(this).val("");
                var title = "Campo de búsqueda";
                var content = "Solo se pueden realizar búsquedas por texto y números.";

                function mostrarError() {
                    $(element).mtError();
                }
                var functionAceptar = mostrarError;
                openAlert(title, content, "messageError", "Aceptar", "none", functionAceptar);

            }
        }
        return false;
    }

});

$("#webContent").on("click", "#obtenerMasResultados", function (event) {
    var url = window.location.href;
    var limit1 = parseInt($("#contentMasResultadosBusqueda .itemBusquedaPrincipal").length);
    var tipoBusqueda = decodeURI(getRoutingName(url, 2).name);
    var filtroBusqueda = decodeURI(getRoutingName(url, 3).name);
    var link = "verMasResultadosBusquedaPrincipal";
    var data = {
        comm: "req",
        filtroBusqueda: filtroBusqueda,
        tipoBusqueda: tipoBusqueda,
        limit1: limit1
    };
    var callback = function (data) {
        $("#contentMasResultadosBusqueda #obtenerMasResultados").remove();
        $("#contentMasResultadosBusqueda").append(data);

    }
    requestView(link, data, callback);
});

$("#busqueda").on("click", "#txtBusquedaPrincipal", function () {
    $("#txtBusquedaPrincipal").trigger("keyup");
    $("#contentSearch").addClass("fixed");
    contentDisabled();
});

$("#busqueda").on("click", "#iconHide", function () {
    $(".search-principal.sp-body").removeClass("hide");
    $("#busqueda").hide();
    $("header").removeClass("searchShow");
    $(".btn-usr-mn").css("left", "130px");
    $(this).removeClass("menuClicked");
    if (isHomeGuest()) {
        if (($("#menu-pc").hasClass("hide"))) {
            $("#menu-pc").removeClass("hide");
        }
    } else {
        $(".search-principal.sp-head").removeClass("hide");
    }
});

$("#wrapper").on("click", ".go-top-btn", function () {
    $("body").velocity("scroll", 0);
});

$("#busqueda").on("click", ".itemBusquedaPrincipal", function (e) {
    e.preventDefault();
    var link = $(this).find("a").attr("href");
    var name = $(this).find(".name").text();
    goToUrl(link);
    $("#txtBusquedaPrincipal").val(name);
});

$(".search-principal").on("click", function () {
    $("#busqueda").show();
    $("header").addClass("searchShow");
    $(".search-principal").addClass("hide");
    $(".btn-usr-mn").css("left", "70px");
    if ($("#txtBusquedaPrincipal").val().trim() != "") {
        $("#contentTxtBusqueda .clear").show();
    }
    if (isHomeGuest()) {
        $("#iconHide").addClass("menuClicked");
        $("#menu-pc").addClass("hide");
    }
});

$("#contentTxtBusqueda").on("tapstart", ".clear", function () {
    $("#contenedorItemsBusqueda").hide();
    $("#txtBusquedaPrincipal").val("");
    $(this).hide();
});