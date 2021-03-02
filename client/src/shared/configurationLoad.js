import velocity from 'velocity-animate';
import loadFilesMenu from '../shared/loadFilesMenu';
import scrollDownChats from '../shared/scrollDownChats';

import {
    routing,
} from '../helpers/urls';

import {
    isHeaderUser,
    isHomeGuest,
} from './functions';

import {
    parallaxWindow,
} from '../shared/parallax';

import {
    entidadesMunicipios
} from '../eventCreators';

import {
    getURLWall
} from '../helpers/urls';

let myIntervalSlides = "";

const configurationLoad = () => {
    if (isHeaderUser() && localStorage.USR_SESS != undefined) {
        $("header.usr-ssn").data("USR_SESS", localStorage.USR_SESS);
    }

    /* 		Slides		*/
    if ($("#slider1").children().length > 0) {
        var elements = $("#slider1").children();
        var long = elements.length;
        var cont = 0;
        $(".rslides").children().css({
            "opacity": "0"
        });
        const $el = $(".rslides").children().eq(cont);
        velocity($el, {"opacity": "1"});
        cont++;
    }
    /* 		Slides		*/

    if (isHomeGuest()) {
        /* 		Slides		*/
        clearInterval(myIntervalSlides);
        myIntervalSlides = setInterval(function () {
            if (cont >= long) {
                cont = 0;
            }
            $(".rslides").children().removeClass("show");
            $(".rslides").children().css({
                "opacity": "0"
            });
            $(".rslides").children().eq(cont).addClass("show");
            const $el = $(".rslides").children().eq(cont);
            velocity($el, {"opacity": "1"});
            cont++;
        }, 6000);
        /* 		Slides		*/

        $("#wrapper").addClass("home");
        $("#menu-pc").removeClass("hide");
        $("#busqueda").hide();
        /*$(".menu-btn-pc").hide();*/
        /*$("header .search-principal").addClass("hide");*/
        $("header").addClass("principal");
        $("#contentSearch").addClass("principal");

        $("header").removeClass("searchShow"); //border-radius again
        parallaxWindow();
    } else {
        $("#wrapper").removeClass("home");
        /*$("#menu-pc").addClass("hide");*/
        /*$(".menu-btn-pc").show();*/
        if ($("#busqueda").css("display") != "block") {
            $("header .search-principal").removeClass("hide");
        }
        $("header").removeClass("principal");
        $("#contentSearch").removeClass("principal");
        if ($(".parallax-mirror").length > 0) {
            $(".parallax-mirror").remove();
        }
    }

    if (routing(1, "busqueda")) {
        if (routing(2, "proyectos") || routing(2, "docentes") || routing(2, "escuelas") || routing(2, "modulos")) {
            $(".search-principal").trigger("click");
            $("#busqueda div").removeClass("selected");
            $("#txtBusquedaPrincipal").val(decodeURI(getURLWall()));
            $("#contentTxtBusqueda .clear").show();
        }

        if (routing(2, "proyectos")) {
            $("#busquedaProyectos").addClass("selected");
            $("#txtBusquedaPrincipal").attr("placeholder", "Buscar proyectos:");
        } else if (routing(2, "docentes")) {
            $("#busquedaDocentes").addClass("selected");
            $("#txtBusquedaPrincipal").attr("placeholder", "Buscar docentes:");
        } else if (routing(2, "escuelas")) {
            $("#busquedaEscuelas").addClass("selected");
            $("#txtBusquedaPrincipal").attr("placeholder", "Buscar escuelas:");
        } else if (routing(2, "modulos")) {
            $("#busquedaModulos").addClass("selected");
            $("#txtBusquedaPrincipal").attr("placeholder", "Buscar módulos:");
        }
    }

    var existsMnSec = ($(".img-usr-mn").length == 1) ? true : false;
    $(window).on("scroll", function (event) {
        if (existsMnSec) {
            var scroll = $(window).scrollTop();
            if ($(window).scrollTop() > 50) {
                $(".btn-usr-mn").show();
            } else {
                $(".btn-usr-mn").hide();
            }
        }

        /*if(routing(1,"modulos"))
			{
				var scroll = $(window).scrollTop()*-1;
				if(scroll >= -100)
				{
					$(".imgModulo").css({"background-position-y":scroll});
				}
			}
			else if(routing(1,"proyectos"))
			{
				var scroll = $(window).scrollTop()*-1;
				if(scroll >= -100)
				{
					$(".imgProyecto").css({"background-position-y":scroll});
				}
			}
    		else*/

        if (routing(1, "proyectos-participantes") || routing(1, "modulos-participantes")) {
            if ($(".cntMuroRgh").css("display") != "none") {

                /*if($(".cntMuroRgh").scrollTop() + $(".cntMuroRgh").innerHeight()>=$(".cntMuroRgh")[0].scrollHeight)
		            {
		            	console.log("0k");
		            }*/
                var scroll = $(window).scrollTop();
                if ($(window).scrollTop() > 75) {
                    $(".cntMuroRgh").css({
                        "top": scroll - 55
                    });
                } else {
                    $(".cntMuroRgh").css({
                        "top": "20px"
                    });
                }
                //alert();
            }

        }
    });

    /*var scrollY = 0;
    	$('.cntDcMuro').on( 'DOMMouseScroll mousewheel', function ( event ) {
			if( event.originalEvent.detail > 0 || event.originalEvent.wheelDelta < 0 )
			{ //down
				scrollY++;
			}
			else
			{ //top
				scrollY--;
    			var tam = $(".cntMuroRgh").css("height");
    			tam = parseInt(tam);
    			scrollY = $(this).scrollTop() % tam;
			}
			console.log(scrollY);
			//scrollY += 1;
            $('.cntMuroRgh').scrollTop(scrollY);
    	  //prevent page fom scrolling

    	});*/

    /*$("#main").on("touchmove",function(event)
    {
    	$(".search-principal.sp-body").hide();
    	$(".btn-usr-mn").hide();
    	$(".menu-btn").hide();
    	event.stopImmediatePropagation();
    });

    $("#main").on("doubletap",function(event)
    {
    	$(".search-principal.sp-body").show();
    	$(".btn-usr-mn").show();
    	$(".menu-btn").show();
    });*/


    /*  /pasevic  */

    if ($(".contenedorTabla").length > 0) {
        loadFilesMenu();
    }

    /*  /pasevic  */



    /*  /pasevic/configuracion */

    if (routing(1, "configuracion")) {
        $.mtStart();
        $(".mt-principal .fl").hide();
        $('#tblEscuelasAgregadasDocente').bootstrapTable();
        entidadesMunicipios("#slEntidad", "#slMunicipio");
    }

    /*  /pasevic/configuracion */



    /*  /pasevic/registro-docentes  */

    if (routing(1, "registro-docentes")) {
        $.mtStart();
        entidadesMunicipios("#slEntidad", "#slMunicipio");
    }

    /*  /pasevic/registro-docentes  */



    /*  /pasevic/seleccionar-proyectos  */

    if (routing(1, "seleccionar-proyectos")) {
        $.mtStart();
    }

    /*  /pasevic/seleccionar-proyectos  */




    /*  /pasevic/nom_usuario/proyectos/url */

    if (routing(1, "proyectos-participantes")) {
        //cambiarTiempoPublicaciones();

        $(".portadaProyectoDocente").prop("tftx", "p");

    }

    if (routing(1, "modulos-participantes")) {
        //cambiarTiempoPublicaciones();

        $(".portadaModuloDocente").prop("tftx", "m");

    }

    if (routing(1, "mensajes")) {
        var bodyWidth = parseInt($("body").css("width"));
        var mensajesEl = $(".contenedor-chats .mensajes");

        $("#wrapper").addClass("chat");

        $(".menu-btn").addClass("blocked")
        $(".search-principal.sp-body").addClass("blocked");
        $(".btn-usr-mn").addClass("blocked");

        mensajesEl.scrollTop(mensajesEl.prop("scrollHeight"));

        if (bodyWidth >= 700) {
            window.scrollTo(0, document.body.scrollHeight);
        } else {
            window.scrollTo(0, 0);
        }

        $(window).on("scroll", function (event) {
            var bodyWidth = parseInt($("body").css("width"));

            if (bodyWidth < 700) {
                var scroll = $(window).scrollTop();
                if (scroll <= 50) {
                    var defaultScroll = 50;
                    scroll = defaultScroll - scroll
                    $(".mensajes .header").css({
                        "top": scroll + "px"
                    });
                } else {
                    $(".mensajes .header").css({
                        "top": "0"
                    });
                }
            }
        });

        scrollDownChats();

    } else {
        $("#wrapper").removeClass("chat");

        $(".menu-btn").removeClass("blocked");
        $(".search-principal.sp-body").removeClass("blocked");
        $(".btn-usr-mn").removeClass("blocked");
    }


    if (routing(1, "docentes") || routing(1, "modulos") || routing(1, "proyectos") || routing(1, "descargar-modulos") || routing(1, "seleccionar-modulos")) {
        $.mtStart();
    }
};

export default configurationLoad;