import '../plugins/material-datepicker';
import velocity from 'velocity-animate';
import isThereCheckSelected from '../shared/isThereCheckSelected';

import {
    validaFechasConvocatoriasEInicioYFinProyectos,
    validaFechasProyectos,
    validaFechasProyectosConvocatoria,
    validateFile
} from '../validations';

import {
    getUrlImage
} from '../helpers/urls';

import {
    requestJson,
    requestView,
    uploadMultimedia,
    socketEvent,
    deleteImage
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
    loadedContent,
    loadingSection,
    loadedSection
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

import {
    getRoutingName,
    routing,
    getURLAfter,
    getURLWall,
    getTypeMuro
} from '../helpers/urls';

import {
    linkifyYouTubeURLs
} from '../helpers/linkify'

// unirse al proyecto

$("#webContent").on("click", ".unirse-proyecto", function () {
    var id_proyecto = $(this).attr("data-IdProyecto");
    var nombre_proyecto = $(this).closest("article").find("h2").text();
    var link = "validaUnionProyectoFechasConvocatoria";
    var data = {
        comm: "dbs",
        id_proyecto: id_proyecto
    };
    var callback = function (info) {
        loadedPage();
        if (info.mensaje == true) {
            if (info.valida == false) {
                openAlert("Fecha de convocatoria finalizada", "No se puede unir al proyecto debido a que se terminó la fecha de convocatoria.", "message");
            } else {
                function mostrarTablaGradosUnionDocenteProyecto() {
                    var link = "unirseProyectoDocente";
                    var data = {
                        comm: "req",
                        id_proyecto: id_proyecto,
                        nombre_proyecto: nombre_proyecto
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
                openModal(mostrarTablaGradosUnionDocenteProyecto);
            }
        } else if (info.mensaje == false) {
            openMessage("#F00", "#FFF", info.resultado);
        } else {

            openMessage("#F00", "#FFF", info.resultado);

        }
    };
    requestJson(link, data, callback);

});



$(".window-modal").on("click", ".btnUnionProyecto", function () {
    var seleccionado = false;
    var id_proyecto = $(this).attr("data-IdProyecto");

    $($('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections')).each(function (index, value) {
        seleccionado = true;
    });

    if (seleccionado) {
        var clave_escuela = $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'clave_escuela')[0].clave_escuela;
        var nom_grado = $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'id_grado')[0].grado;
        var nom_grupo = $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'id_grupo')[0].grupo;
        var nom_nivel = $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'id_grado')[0].nivel;

        var DATA = {
            id_proyecto: id_proyecto,
            clave_escuela: $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'clave_escuela')[0].clave_escuela,
            id_grado: $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'id_grado')[0].id_grado,
            id_grupo: $('#tblGradosDocenteUnionMuro').bootstrapTable('getSelections', 'id_grupo')[0].id_grupo,
            tipo: "1",
            comm: "req"
        }

        var link = "verificarGradosDocentesCoincidencias";
        var callback = function (info) {
            var functionAceptar = registroProyecto;
            var functionCancelar = cancelarRegistro;
            var DATAOBJ = DATA;

            function registroProyecto() {
                registrarUnionDocentesMuros(DATAOBJ, '1');
            }

            function cancelarRegistro() {
                $(".unirse-proyecto[data-idproyecto='" + id_proyecto + "']").trigger("click");
            }

            if (info.mensaje == true) {
                openAlert("¿Unirse al proyecto?", "¿Desea unirse al proyecto con la escuela que tiene la clave " + clave_escuela + ", grado " + nom_grado + " y el grupo " + nom_grupo + "?", "confirm", "Aceptar", "Cancelar", functionCancelar, functionAceptar);
            } else if (info.mensaje == false) {
                openAlert("¿Unirse al proyecto?", "El proyecto al que desea unirse no fue creado para el grado " + nom_grado + " de " + nom_nivel + ".\n ¿Desea unirse de todos modos con la escuela que tiene la clave " + clave_escuela + ", grado " + nom_grado + " de " + nom_nivel + " y el grupo " + nom_grupo + "?", "confirm", "Aceptar", "Cancelar", functionCancelar, functionAceptar);
            } else {
                openMessage("#F00", "#FFF", info.resultado);

            }
        };
        requestJson(link, DATA, callback);
    } else {
        var functionCancelar = function functionAceptar() {
            $(".unirse-proyecto[data-idproyecto='" + id_proyecto + "']").trigger("click");
        }
        openAlert("Seleccione la escuela", "Debe seleccionar la escuela con el que se va a unir al proyecto.", "message", "Aceptar", "", functionCancelar);
    }

});


function registrarUnionDocentesMuros(DATA, tipo) {
    if (tipo == '1') {
        var link = "registrarUnionDocentesProyectos";
    } else {
        var link = "registrarUnionDocentesModulos";
    }
    loadingModal();
    var callback = function (info) {
        loadedModal();
        if (info.mensaje == true) {
            loadingPage();
            window.location = info.link;
        } else if (info.mensaje == false) {
            openMessage("#F00", "#FFF", info.resultado);
        } else {
            openMessage("#F00", "#FFF", info.resultado);
        }
    };
    requestJson(link, DATA, callback);
}


//Ver RelProyectos


$("#webContent").on("click", ".slctPrtMuro", function () {
    let infMisMuros = $(this).find(".infMisMuros");
    if (!($(this).hasClass("goToUrl"))) {
        if (infMisMuros.css("display") == "none") {
            // infMisMuros.velocity("transition.flipXIn", 400);
            velocity(infMisMuros, "transition.flipXIn", {
                duration: 400
            });
            $(this).find(".descripcion").hide();
        } else {
            // infMisMuros.velocity("transition.flipXOut", 400);
            velocity(infMisMuros, "transition.flipXOut", {
                duration: 400
            });
            $(this).find(".descripcion").show();
        }
    }
});

/*$("#webContent").on("click",".slctPrtMuro .infMisMuros .return",function(){
    $(this).find(".infMisMuros").velocity("transition.slideLeftOut",200);
    $(this).find(".descripcion").velocity("transition.slideLeftIn",200);
});*/

$("#webContent").on("change", "#slEstadosProyecto", function () {

    var $id_ciclo_escolar = $("#slCicloEscolar option:selected").attr("value");
    var $estadoProyecto = $("#slEstadosProyecto option:selected").attr("value");

    loadingPage();
    var link = "proyectoDocenteFiltros";
    var data = {
        comm: "req",
        "id_ciclo_escolar": $id_ciclo_escolar,
        "estadoProyecto": $estadoProyecto
    };
    var callback = function (data) {
        $(".contenedorMisProyectos .filtroProyectosAux").html(data);
        loadedPage();
    };
    requestView(link, data, callback);

});

$("#webContent").on("change", "#slCicloEscolar", function () {
    var urlModulo = getURLWall();
    var id_ciclo_escolar = $("#slCicloEscolar").val().trim();
    var link = "docentesModulos";
    $("#loader-docModules").addClass("show");
    var data = {
        comm: "req",
        urlModulo: urlModulo,
        id_ciclo_escolar: id_ciclo_escolar
    };
    var callback = function (data) {
        $("#webContent .docentes-relacionados-modulos").html(data);
        $("#loader-docModules").removeClass("show");
    };
    requestView(link, data, callback);
});

$("body").on("change", "#slCicloEscolarPortadaModuloDocente", function () {
    var urlModulo = getURLWall();
    var id_ciclo_escolar = $("#slCicloEscolarPortadaModuloDocente").val().trim();

    loadingModal();
    var link = "docentesModulosPortadaDocente";
    var data = {
        comm: "req",
        urlModulo: urlModulo,
        id_ciclo_escolar: id_ciclo_escolar
    };
    var callback = function (data) {
        $(".window-modal .docentes-relacionados-proyectos").html(data);
        loadedModal();
    }
    requestView(link, data, callback);
});

$("body").on("change", "#slCicloEscolarMod", function () {
    var URLactual = window.location.href;
    var nombre_usuario = getRoutingName(URLactual, 2);
    var id_ciclo_escolar = $("#slCicloEscolarMod").val().trim();
    if ($("#loader-docModules").length > 0) {
        $("#loader-docModules").addClass("show");
    } else {
        $("#loader-fltrMrRsltAux").show();
    }
    var link = "obtenerModulosDocente";
    var data = {
        comm: "async",
        nombre_usuario: nombre_usuario.name,
        id_ciclo_escolar: id_ciclo_escolar
    };
    var callback = function (data) {
        $(".contenedorModulos").replaceWith(data);
        if ($("#loader-docModules").length > 0) {
            $("#loader-docModules").removeClass("show");
        } else {
            $("#loader-fltrMrRsltAux").hide();
        }
    }
    requestView(link, data, callback);
});


//Ver proyecto docente

$("#webContent").on("click", ".cntDcMuro .fltLblMuro", function () {
    var element = $(".cntDcMuro .fltLblMuro")
    element.hide();
    element.parent().find(".filtroBody").show();
});

$("#webContent").on("click", ".cntDcMuro .closeFiltro", function () {
    var element = $(".cntDcMuro .fltLblMuro")
    element.show();
    element.parent().find(".filtroBody").hide();
});

$("#webContent").on("click", ".cntDcMuro .iconConfiguracion", function () {
    var element = $(".cntDcMuro .iconConfiguracion")
    element.hide();
    element.parent().find(".cntMuro").show();
});

$("#webContent").on("click", ".cntDcMuro .closeConf", function () {
    var element = $(".cntDcMuro .iconConfiguracion")
    element.show();
    element.parent().find(".cntMuro").hide();
});

$("#webContent").on("click", ".cntDcMuro .infLblMuro", function () {
    var element = $(".cntDcMuro .infLblMuro")
    element.hide();
    element.parent().find(".rsmInfMuro").show();
});

$("#webContent").on("click", ".cntDcMuro .closeInfo", function () {
    var element = $(".cntDcMuro .infLblMuro")
    element.show();
    element.parent().find(".rsmInfMuro").hide();
});

$("#webContent").on("click", ".ptdDcMuro .relacionadosMuro", function () {
    function proyectoDocenteRelacionados() {
        var mod = getTypeMuro();
        if (mod == "p") {
            var link = "proyectoDocenteRelacionados";
            var urlProyecto = getURLWall();
            var data = {
                comm: "async",
                urlProyecto: urlProyecto
            };
        } else {
            var link = "moduloDocenteRelacionados";
            var urlModulo = getURLWall();
            var data = {
                comm: "async",
                urlModulo: urlModulo
            };
        }
        loadingModal();
        var callback = function (data) {
            $(".window-modal").html(data);
            $.mtStart();
            loadedModal();
        }
        requestView(link, data, callback);

    }
    openModal(proyectoDocenteRelacionados);
});

$("#webContent").on("click", ".ptdDcMuro .codigoQrMuro", function () {
    function proyectoDocenteQr() {
        var link = "generarQr";
        var urlWall = getURLWall();
        var mod = getTypeMuro();
        loadingModal();
        var data = {
            comm: "req",
            urlWall: urlWall,
            mod: mod
        };
        var callback = function (data) {
            $(".window-modal").html(data);
            loadedModal();
            var qrCode = $("#qrcode").html();
            $("#qrcode").empty();
            //$('#qrcode').qrcode(qrCode);
            $('#qrcode').qrcode({
                render: "table",
                text: qrCode,
            });
        }
        requestView(link, data, callback);
    }
    openModal(proyectoDocenteQr);
});

$("#wrapper").on("click", ".docRelMuro figure", function (e) {
    var type = 0;
    if ($(this).attr("data-docente") != undefined) {
        var id_docente = $(this).closest("figure").attr("data-docente");
        var id_ciclo_escolar = "";

        if (routing(1, "proyectos")) {
            id_ciclo_escolar = $("#slCicloEscolarProyectos").val();
        }
        if (routing(1, "proyectos-participantes")) {
            id_ciclo_escolar = $("#slCicloEscolarProyectosPub").val();
        }

        if (routing(1, "proyectos") || routing(1, "modulos")) {
            type = 1;
        }

        if (routing(1, "proyectos") || routing(1, "proyectos-participantes")) {

            var urlProyecto = getURLWall();
            var link = "proyectoDocenteRelacionadosInfo";
            var data = {
                comm: "async",
                "url": urlProyecto,
                "id_docente": id_docente,
                "type": type,
                "id_ciclo_escolar": id_ciclo_escolar
            };
        } else if (routing(1, "modulos") || routing(1, "modulos-participantes")) {

            var urlModulo = getURLWall();
            var link = "moduloDocenteRelacionadosInfo";
            var id_ciclo_escolar = "";

            if ($("#slCicloEscolar").length > 0) {
                id_ciclo_escolar = $("#slCicloEscolar option:selected").val();
            } else {
                if ($("#slCicloEscolarPortadaModuloDocente").length > 0) {
                    id_ciclo_escolar = $("#slCicloEscolarPortadaModuloDocente option:selected").val();
                }
            }

            var data = {
                comm: "async",
                "url": urlModulo,
                "id_docente": id_docente,
                "type": type,
                "id_ciclo_escolar": id_ciclo_escolar
            };
        }
        loadingModal();
        var callback = function (data) {
            loadedModal();
            $(".body-modal").addClass("segundoPlano");
            debugger;
            if (type == 1) {
                // $(".pageSecCnt").html(data).velocity("transition.flipXIn", 400);
                velocity($(".pageSecCnt").html(data), "transition.flipXIn", {
                    duration: 400
                });
            } else {
                // $(".pageSecCnt").html(data).velocity("transition.flipXIn", 400);
                velocity($(".pageSecCnt").html(data), "transition.flipXIn", {
                    duration: 400
                });
            }
        }
        requestView(link, data, callback);
    }
});

/*$("#wrapper").on("click",".rtnDocRelMuro",function(){
    $(this).parent().velocity("transition.flipXOut",400);
    $(".body-modal").removeClass("segundoPlano");
});*/

$("#wrapper").on("click", ".pageSecCnt", function () {
    velocity($(this), "transition.flipXOut", {
        duration: 400
    });
    $(".body-modal").removeClass("segundoPlano");
});

$("#webContent").on("click", ".ptdDcMuro .infoMuro", function () {
    function mostrarInformacionProyecto() {
        var mod = getTypeMuro();

        if (mod == "p") {
            var link = "informacionProyecto";
            var urlProyecto = getURLWall();
            var data = {
                comm: "async",
                urlProyecto: urlProyecto
            };
        } else {
            var link = "informacionModulo";
            var urlModulo = getURLWall();
            var data = {
                comm: "async",
                urlModulo: urlModulo
            };
        }

        loadingModal();
        var callback = function (data) {
            $(".window-modal").html(data);
            loadedModal();
        };
        requestView(link, data, callback);
    }
    openModal(mostrarInformacionProyecto);
});


//LIKES

$("#webContent").on("click", ".ptdDcMuro .heart_likes", function (event) {

    var mod = getTypeMuro();

    if (mod == "p") {
        var urlProyecto = getURLWall();
        var link = "likePortadaProyectos";
        var data = {
            comm: "dbs",
            urlProyecto: urlProyecto
        };
    } else {
        var urlModulo = getURLWall();
        var link = "likePortadaModulos";
        var data = {
            comm: "dbs",
            urlModulo: urlModulo
        };
    }

    var callback = function (info) {
        if (info.mensaje == true) {

            socketEvent("sendLikeWall", {
                url: getURLAfter(2),
                can: info.cantidad_likes
            });

            $("#webContent .ptdDcMuro .likes").html(info.cantidad_likes);

            if (info.dar_like == 'S') {
                velocity($("#webContent .ptdDcMuro .heart_likes").addClass("liked"), "transition.shrinkIn");
            } else {
                velocity($("#webContent .ptdDcMuro .heart_likes").removeClass("liked"), "transition.shrinkIn");
            }
        } else if (info.mensaje == false) {
            openMessage("#F00", "#FFF", info.resultado);

        } else {
            openMessage("#F00", "#FFF", info.resultado);

        }
    };
    requestJson(link, data, callback);
});




//Imágenes

$("#webContent").on("click", ".publicarPost .foto, .publicarPost .agregarImagenPost", function () {
    $(this).closest(".publicarPost").find(".publicacion-imagen").trigger("click");
});


$("#webContent").on("change", ".publicarPost .publicacion-imagen", function () {
    var error = validateFile($(this));
    if (!error) {
        var mod = getTypeMuro();
        if (mod == "p") {
            var type = "pub";
        } else {
            var type = "pubMod";
        }

        var mult = "img";
        var element = $(this);
        var callback = function (info) {
            var link = "imagenPublicacion";
            var data = {
                comm: "async",
                link: info.link
            };
            var callback3 = function (data) {
                element.parent().find(".contenedorImagenesPost").children().remove(".imagen-loader");
                element.parent().find(".contenedorImagenesPost").append(data);

                if (element.parent().find(".contenedorImagenesPost").children().length < 1) {
                    element.parent().find(".imagenesPublicacion").hide("fast");
                }
            };
            requestView(link, data, callback3);
        };
        uploadMultimedia(element, mult, type, callback);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado es incorrecto. Solo se permiten imágenes.";
        defaultErrorAlert(title, content);
        $(".publicacion-imagen").val("");
    }
});

$("#webContent").on("click", ".publicarPost .eliminarImagenPost", function () {
    if ($(this).siblings().css("display") != "none") {
        $(this).text("Listo");
        $(this).siblings().hide();
        $(this).closest(".imagenesPublicacion").find(".imagenPost span").show();
    } else {
        $(this).text("Eliminar");
        $(this).siblings().show();
        $(this).closest(".imagenesPublicacion").find(".imagenPost span").hide();
    }
});


$("#webContent").on("click", ".publicarPost .imagenPost span", function () {
    var element = $(this);
    var link = element.siblings().attr("src");
    var mod = getTypeMuro();
    if (mod == "p") {
        var type = "pubImg";
    } else {
        var type = "pubImgMod";
    }
    var callback = function (data) {
        if (element.closest(".contenedorImagenesPost").children().length <= 1) {
            element.closest(".imagenesPublicacion").hide("fast");
        }
        element.parent().remove();
    };
    deleteImage(link, type, callback);
});

function arrowButtons(tam, point) {
    if (point + 1 == tam) {
        $(".arrRight").addClass("hide");
    }

    if (point == 0) {
        $(".arrLeft").addClass("hide");
    }
}

$("#webContent").on("click", ".imgPbMuro", function () {
    var element = $(this);

    function mostrarMultimedia() {
        loadingModal();
        var actualSrc = $(element).attr("src");
        var arrImg = $(element).closest(".containerImagenesPublicacion").find("img");
        var arrSrc = [];
        $.each(arrImg, function (i) {
            var src = $(this).attr("src");
            arrSrc[i] = src;
            if (actualSrc == src) {
                window.pntFl = i;
            }
        });

        window.arMlt = arrSrc;
        window.tpFl = 0;

        var tam = arrSrc.length;

        var link = "mostrarMultimedia";
        var data = {
            comm: "async",
            src: actualSrc,
            type: 0
        };
        var callback = function (data) {
            $(".window-modal").html(data);

            arrowButtons(tam, window.pntFl);

            loadedModal();
        };
        requestView(link, data, callback);
    }
    openModal(mostrarMultimedia);
});

$("#webContent").on("click", ".cover-youtube", function () {
    var element = $(this).siblings();

    function mostrarMultimedia() {
        loadingModal();
        var actualSrc = $(element).attr("src");
        var arrYtb = $(element).closest(".containerEnlacesYoutubePublicacion").find("iframe");
        var arrSrc = [];
        $.each(arrYtb, function (i) {
            var src = $(this).attr("src");
            arrSrc[i] = src;
            if (actualSrc == src) {
                window.pntFl = i;
            }
        });

        window.arMlt = arrSrc;
        window.tpFl = 1;

        var tam = arrSrc.length;

        var link = "mostrarMultimedia";
        var data = {
            comm: "async",
            src: actualSrc,
            type: 1
        };
        var callback = function (data) {
            $(".window-modal").html(data);

            arrowButtons(tam, window.pntFl);

            loadedModal();
        };
        requestView(link, data, callback);
    }
    openModal(mostrarMultimedia);
});

$(".window-modal").on("click", ".arrRight", function () {

    loadingModal();
    var point = window.pntFl;
    var arrMult = window.arMlt;
    var tam = arrMult.length;
    var type = window.tpFl;

    point += 1;
    if (point < tam) {
        var link = "elementoMultimedia";
        var data = {
            comm: "async",
            src: arrMult[point],
            type: type
        };
        var callback = function (data) {
            window.pntFl = point;
            $(".arrLeft").removeClass("hide");

            point += 1;
            if (point >= tam) {
                $(".arrRight").addClass("hide");
            }

            $(".elementMul").html(data);
            loadedModal();
        };
        requestView(link, data, callback);
    } else {
        $(".arrRight").addClass("hide");
        loadedModal();
    }

});

$(".window-modal").on("click", ".arrLeft", function () {
    loadingModal();
    var point = window.pntFl;
    var arrMult = window.arMlt;
    var tam = arrMult.length;
    var type = window.tpFl;

    point -= 1;
    if (point >= 0) {
        var link = "elementoMultimedia";
        var data = {
            comm: "async",
            src: arrMult[point],
            type: type
        };
        var callback = function (data) {
            window.pntFl = point
            $(".arrRight").removeClass("hide");

            point -= 1;
            if (point < 0) {
                $(".arrLeft").addClass("hide");
            }

            $(".elementMul").html(data);
            loadedModal();
        };
        requestView(link, data, callback);
    } else {
        $(".arrLeft").addClass("hide");
        loadedModal();
    }
});


//Archivos

$("#webContent").on("click", ".publicarPost .archivo, .publicarPost .agregarArchivoPost", function (event) {
    $(this).closest(".publicarPost").find(".publicacion-archivo").trigger("click");
});

$("#webContent").on("change", ".publicarPost .publicacion-archivo", function (event) {
    var error = validateFile($(this));
    if (!error) {
        var mod = getTypeMuro();
        if (mod == "p") {
            var type = "FPub";
        } else {
            var type = "FPubMod";
        }

        var mult = "fl";
        var element = $(this);
        var callback = function (info) {
            var name = element.parent().find(".contenedorArchivosPost .archivo-loader span").last().text();
            var link = "archivoPublicacion";
            var data = {
                comm: "async",
                link: info.link,
                name: name
            };
            var callback3 = function (data) {
                element.parent().find(".contenedorArchivosPost").children().remove(".archivo-loader");
                element.parent().find(".contenedorArchivosPost").append(data);

                if (element.parent().find(".contenedorArchivosPost").children().length < 1) {
                    element.parent().find(".archivosPublicacion").hide("fast");
                }
            };
            requestView(link, data, callback3);
        };
        uploadMultimedia(element, mult, type, callback);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado no está permitido.";
        defaultErrorAlert(title, content);
        $(".publicacion-archivo").val("");
    }
});

$("#webContent").on("click", ".publicarPost .eliminarArchivoPost", function (event) {
    if ($(this).siblings().css("display") != "none") {
        $(this).text("Listo");
        $(this).siblings().hide();
        $(this).closest(".archivosPublicacion").find(".archivoPost span:first-child").show();
    } else {
        $(this).text("Eliminar");
        $(this).siblings().show();
        $(this).closest(".archivosPublicacion").find(".archivoPost span:first-child").hide();
    }
});

$("#webContent").on("click", ".publicarPost .archivoPost span", function () {
    var element = $(this);
    var link = element.attr("data-link");
    var mod = getTypeMuro();
    if (mod == "p") {
        var type = "pubFl";
    } else {
        var type = "pubFlMod";
    }
    var callback = function (data) {
        if (element.closest(".contenedorArchivosPost").children().length <= 1) {
            element.closest(".archivosPublicacion").hide("fast");
        }
        element.closest(".archivoPost").remove();
    };
    deleteImage(link, type, callback);
});



// TEXTO


$("#webContent").on("click", ".publicarPost .texto", function () {

    var elementoModificar = $(this).closest(".publicarPost").find(".mensajePost");
    var elemento = {
        html: elementoModificar,
        modificarCss: function () {
            this.html.css("box-shadow", "none");

            velocity(this.html, "scroll", {
                offset: "-10px"
            });
            
        }
    };
    elementoModificar.css("box-shadow", "5px 5px 20px #FFF096 inset, -5px -5px 20px #FFF096 inset");
    setTimeout($.proxy(elemento, "modificarCss"), 100);
});





//Botón publicar

$("#webContent").on("click", ".cntMuroLft #btnPublicar, .modificarPost .btnModificarPub", function (event) {
    var loader = $(this).closest(".publicarPost").find(".loader-section");
    var textoPublicacion = $(this).closest(".publicarPost").find(".mensajePost").val().trim();
    if (textoPublicacion != "") {
        loadingSection(loader);
        var publicacionCompleta = textoPublicacion;
        var url = window.location.href;
        url = url.split("/");
        var tama = url.length;
        var urlProyecto = url[tama - 1];

        var elementosImagenes = $(this).closest(".publicarPost").find(".imagenesPublicacion .imagenPost img");
        var imagenes = [];
        if (elementosImagenes.length > 0) {
            elementosImagenes.each(function (index) {
                var urlImagen = $(this).attr("src");
                var posImg = urlImagen.lastIndexOf("/") + 1;
                urlImagen = urlImagen.substring(posImg, urlImagen.length);
                imagenes[index] = [{
                    "url_imagen": urlImagen
                }, ];
            });
        }

        var elementosArchivos = $(this).closest(".publicarPost").find(".archivosPublicacion .archivoPost p");
        var archivos = [];
        if (elementosArchivos.length > 0) {
            elementosArchivos.each(function (index) {
                var urlArch = $(this).find("span").eq(0).attr("data-link");
                var posArch = urlArch.lastIndexOf("/") + 1;
                urlArch = urlArch.substring(posArch, urlArch.length);
                archivos[index] = [{
                    "url_archivo": urlArch,
                    "nombre_archivo": $(this).find("span").eq(1).text()
                }];
            });
        }

        var elementosIframes = $(this).closest(".publicarPost").find(".linksPublicacion .linkPost iframe");

        var iframesYoutube = [];
        if (elementosIframes.length > 0) {
            elementosIframes.each(function (index) {
                var link_youtube = $(this).attr('src');
                var n = parseInt(link_youtube.indexOf("/embed/"));
                if (n != -1) {
                    var respuesta = linkifyYouTubeURLs(link_youtube);

                    if (respuesta !== false) {
                        iframesYoutube[index] = [{
                            "iframe_youtube": link_youtube
                        }, ];
                    }
                }
            });
        }

        var mod = getTypeMuro();

        if ($(this).closest(".publicarPost").hasClass("modificarPost") == true) {
            var idp = $(this).parent().attr("data-idp");
            var link = "modificarPublicacionProyecto";
            var urlProyecto = getURLWall();
            var data = {
                comm: "req",
                urlProyecto: urlProyecto,
                publicacionCompleta: publicacionCompleta,
                imagenes: imagenes,
                archivos: archivos,
                iframesYoutube: iframesYoutube,
                idPub: idp,
                type: mod
            };
            var callback = function (data) {
                $(".cntPubMuro .pubHide").remove();
                $(".cntPubMuro .modificarPost").after(data);
                $(".cntPubMuro .modificarPost").remove();
                // $(".cntPubMuro .publicacion-proyecto-gestion[data-idp='" + idp + "']").velocity("scroll");
                velocity($(".cntPubMuro .publicacion-proyecto-gestion[data-idp='" + idp + "']"), "scroll");


            }
            requestView(link, data, callback);
        } else {
            var link = "publicacionProyecto";
            var urlProyecto = getURLWall();
            var data = {
                comm: "req",
                urlProyecto: urlProyecto,
                publicacionCompleta: publicacionCompleta,
                imagenes: imagenes,
                archivos: archivos,
                iframesYoutube: iframesYoutube,
                type: mod
            };
            var callback = function (info) {
                var elemento = $("#btnPublicar").closest(".publicarPost");
                elemento.find("textarea").val("");

                elemento.find(".archivosPublicacion").hide();
                elemento.find(".imagenesPublicacion").hide();
                elemento.find(".linksPublicacion").hide();

                elemento.find(".contenedorArchivosPost").children().remove();
                elemento.find(".contenedorImagenesPost").children().remove();
                elemento.find(".contenedorLinksPost").children().remove();

                if ($(".cntPubMuro").children().length == 0) {
                    $(".cntDcMuro").removeClass("cntDcMuroVc");
                }

                $(".cntPubMuro").prepend(info.pub);
                // $(".cntPubMuro").children().first().velocity("scroll");
                velocity($(".cntPubMuro").children().first(), "scroll");

                loadedSection(loader);

                socketEvent("sendPublication", {
                    url: getURLAfter(2),
                    idP: info.idP,
                    tp: mod
                });

            };
            requestJson(link, data, callback);
        }
    } else {
        var functionAceptar = focusTextarea;
        var element = $(this).closest(".publicarPost").find(".mensajePost");
        openAlert("Mensaje", "Escribe un comentario para la publicación.", "message", "Aceptar", "none", functionAceptar);

        function focusTextarea() {
            // element.velocity("scroll", {
            //     offset: "-10px"
            // });
            velocity(element, "scroll", {
                offset: "-10px"
            });

        }
    }
});



//Videos Youtube

$("#webContent").on("click", ".publicarPost .youtube", function () {
    $(this).closest(".publicarPost").find(".contenedorLinksPost").addClass("contenedorLinksPostActivo");

    function agregarVideoYoutube() {
        var link = "agregarVideoYoutube";
        var data = {
            comm: "async"
        };
        var elementoModal = $(this);
        var callback = function (data) {
            $(".window-modal").html(data);
            loadedModal();
            $.mtStart();
            $(".form-video-youtube #btnAgregarVideo").on("click", function () {
                var youtubeLink = $(this).closest(".form-video-youtube").find(".youtubeLink").val();
                var linksYoutube = linkifyYouTubeURLs(youtubeLink);
                var elementPostActivo = $(".contenedorLinksPostActivo").closest(".publicarPost").find(".youtube");
                if (linksYoutube === false) {
                    var functionAceptar = function () {
                        elementPostActivo.trigger("click");
                    }
                    var title = "Enlace incorrecto";
                    var content = "El enlace del video tiene un formato incorrecto.";
                    defaultErrorAlert(title, content, "none", functionAceptar);
                } else {
                    var datos1 = "<div>" + linksYoutube + "</div>";
                    var datosParseados1 = $.parseHTML(datos1);
                    var links1 = $(datosParseados1).find("iframe");
                    for (let x = 0; x < links1.length; x++) {
                        $(".contenedorLinksPostActivo").append("<div class='linkPost'><span>X</span><div>" + links1[x].outerHTML + "</div></div>");
                    }
                    if ($(".contenedorLinksPostActivo").parent().css("display") == "none") {
                        if ($(".contenedorLinksPostActivo").parent().find(".agregarLinkPost").css("display") == "none") {
                            $(".contenedorLinksPostActivo").parent().find(".agregarLinkPost").show()
                            $(".contenedorLinksPostActivo").parent().find(".eliminarLinkPost").text("Eliminar");
                        }
                        $(".contenedorLinksPostActivo").parent().show("fast");
                    }
                    closeModal();
                }
            });
        };
        requestView(link, data, callback);
    }
    openModal(agregarVideoYoutube);
});

$("#webContent").on("click", ".publicarPost .eliminarLinkPost", function (event) {
    if ($(this).siblings().css("display") != "none") {
        $(this).text("Listo");
        $(this).siblings().hide();
        $(this).closest(".linksPublicacion").find(".linkPost span:first-child").show();
    } else {
        $(this).text("Eliminar");
        $(this).siblings().show();
        $(this).closest(".linksPublicacion").find(".linkPost span:first-child").hide();
    }
});

$("#webContent").on("click", ".publicarPost .agregarLinkPost", function (event) {
    $(this).closest(".publicarPost").find(".youtube").trigger("click");
});

$("#webContent").on("click", ".publicarPost .linkPost span", function () {
    var element = $(this);
    if (element.data().archivoId == undefined) {
        if (element.closest(".contenedorLinksPost").children().length <= 1) {
            element.closest(".linksPublicacion").hide("fast");
        }
        element.closest(".linkPost").remove();
    }
});


//Editar proyectos

$("#webContent").on("click", ".publicacion-proyecto-gestion .editarPublicacion", function () {
    var elementoC = $(this).closest(".publicacion-proyecto-gestion");
    var tam = $("#contendorPublicacionesProyectos").find(".modificarPost").length;
    var loader = elementoC.find(">.loader-section");
    if (tam > 0) {
        var functionAceptar = modificarPublicacion;
        var functionCancelar = apuntarPublicar;
        openAlert("¿Salir sin guardar?", "No has guardado el comentario ¿Deseas cerrarlo?", "confirm", "Aceptar", "Cancelar", functionCancelar, functionAceptar);
    } else {
        modificarPublicacion();
    }

    function modificarPublicacion() {
        var idp = elementoC.attr("data-idp");
        var urlProyecto = getURLWall();

        loadingSection(loader);
        var link = "editarPublicacion";
        var mod = getTypeMuro();
        var data = {
            comm: "async",
            id_pub: idp,
            urlP: urlProyecto,
            type: mod
        };
        var callback = function (data) {
            if ($("#contendorPublicacionesProyectos").find(".modificarPost").length > 0) {
                $(".modificarPost .btnCancelarPub").trigger("click");
            }
            loadedSection(loader);
            elementoC.addClass("pubHide");
            elementoC.before(data);
            // $(".modificarPost").velocity("scroll");
            velocity($(".modificarPost"), "scroll");

        };
        requestView(link, data, callback);

        /*error: function(jqXHR, textStatus, errorThrown)
        {
            openAlert("Error de conexión","Ha ocurrido un error de conexión. ¿Estás conectado a Internet?","message");
            loadedSection(loader);
        }*/

    }

    function apuntarPublicar() {
        if (tam > 0) {
            // $("#contendorPublicacionesProyectos").find(".modificarPost").velocity("scroll");
            velocity($("#contendorPublicacionesProyectos").find(".modificarPost"), "scroll");
        }
    }

});


$("#webContent").on("click", ".modificarPost .btnCancelarPub", function () {

    var imagenes = [];
    var archivos = [];
    $(this).closest(".modificarPost").find(".imagenesPublicacion img").each(function (index) {
        var urlImagen = $(this).attr("src");
        var posImg = urlImagen.lastIndexOf("/") + 1;
        urlImagen = urlImagen.substring(posImg, urlImagen.length);
        imagenes[index] = [{
            "url_imagen": urlImagen
        }, ];
    });

    $(this).closest(".modificarPost").find(".archivosPublicacion .archivoPost p").each(function (index) {
        var urlArch = $(this).find("span").eq(0).attr("data-link");
        var posArch = urlArch.lastIndexOf("/") + 1;
        urlArch = urlArch.substring(posArch, urlArch.length);
        archivos[index] = [{
            "url_archivo": urlArch,
            "nombre_archivo": $(this).find("span").eq(1).text()
        }];
    });

    $("#contendorPublicacionesProyectos").children().remove(".modificarPost");
    var elemento = $("#contendorPublicacionesProyectos .pubHide");
    elemento.removeClass("pubHide");
    // elemento.velocity("scroll");
    velocity(elemento, "scroll");


    var mod = getTypeMuro();
    loadingModal();

    var link = "existeUrlsMultimedia";
    var data = {
        comm: "req",
        urlsImg: imagenes,
        urlsFl: archivos,
        type: mod
    };
    var callback = function (data) {};
    requestView(link, data, callback);
});


//Filtros publicaciones

function filtroComentariosAjax(tipoBusqueda, ordenamiento) {
    var urlProyecto = getURLWall();
    var mod = getTypeMuro();
    var link = "busquedaPublicaciones";
    var data = {
        comm: "req",
        urlProyecto: urlProyecto,
        tipoBusqueda: tipoBusqueda,
        ordenamiento: ordenamiento,
        type: mod
    };

    var callback = function (data) {
        $("#contendorPublicacionesProyectos").empty();
        $("#contendorPublicacionesProyectos").append(data);
        // $("#contendorPublicacionesProyectos").children().first().velocity("scroll");
        velocity($("#contendorPublicacionesProyectos").children().first(), "scroll");

    };
    requestView(link, data, callback);
}


$('#webContent').on("click", '.fltDcMuro .fechaAscendente', function () {
    $(".fltDcMuro .filtroDate .selected").removeClass("selected");
    $(".fltDcMuro .fechaAscendente").addClass("selected");

    var linkTipoBusqueda = $(".fltDcMuro .filtroType .selected");
    var tipoBusqueda = "";

    if (linkTipoBusqueda.length == 0) {
        tipoBusqueda = 'AllPublicaciones';
    } else {
        if (linkTipoBusqueda.hasClass("publicaciones")) {
            tipoBusqueda = 'AllPublicaciones';
        } else if (linkTipoBusqueda.hasClass("imagenes")) {
            tipoBusqueda = 'AllImagenes';
        } else if (linkTipoBusqueda.hasClass("archivos")) {
            tipoBusqueda = 'AllArchivos';
        } else if (linkTipoBusqueda.hasClass("youtubeVideos")) {
            tipoBusqueda = 'AllLinksYoutube';
        }
    }
    filtroComentariosAjax(tipoBusqueda, "asc");
});

$('#webContent').on("click", '.fltDcMuro .fechaDescendente', function () {
    $(".fltDcMuro .filtroDate .selected").removeClass("selected");
    $(".fltDcMuro .fechaDescendente").addClass("selected");

    var linkTipoBusqueda = $(".fltDcMuro .filtroType .selected");
    var tipoBusqueda = "";

    if (linkTipoBusqueda.length == 0) {
        tipoBusqueda = 'AllPublicaciones';
    } else {
        if (linkTipoBusqueda.hasClass("publicaciones")) {
            tipoBusqueda = 'AllPublicaciones';
        } else if (linkTipoBusqueda.hasClass("imagenes")) {
            tipoBusqueda = 'AllImagenes';
        } else if (linkTipoBusqueda.hasClass("archivos")) {
            tipoBusqueda = 'AllArchivos';
        } else if (linkTipoBusqueda.hasClass("youtubeVideos")) {
            tipoBusqueda = 'AllLinksYoutube';
        }
    }
    filtroComentariosAjax(tipoBusqueda, "desc");
});

$('#webContent').on("click", ".divPaginacion", function () {
    var limit1 = $("#contendorPublicacionesProyectos .publicacion-proyecto").length;
    var limit2 = 5;

    var urlProyecto = getURLWall();

    var linkTipoBusqueda = $(".fltDcMuro .filtroType .selected");
    var tipoBusqueda = "";

    if (linkTipoBusqueda.length == 0) {
        tipoBusqueda = 'AllPublicaciones';
    } else {
        if (linkTipoBusqueda.hasClass("publicaciones")) {
            tipoBusqueda = 'AllPublicaciones';
        } else if (linkTipoBusqueda.hasClass("imagenes")) {
            tipoBusqueda = 'AllImagenes';
        } else if (linkTipoBusqueda.hasClass("archivos")) {
            tipoBusqueda = 'AllArchivos';
        } else if (linkTipoBusqueda.hasClass("youtubeVideos")) {
            tipoBusqueda = 'AllLinksYoutube';
        }
    }

    var ordenamiento = $(".fltDcMuro .filtroDate .selected");

    if (ordenamiento.length == 0) {
        ordenamiento = 'desc';
    } else {
        if (ordenamiento.hasClass('fechaAscendente')) {
            ordenamiento = 'asc';
        } else {
            ordenamiento = 'desc';
        }
    }

    $(this).remove();
    var mod = getTypeMuro();
    var link = "busquedaPublicaciones";
    var data = {
        comm: "req",
        urlProyecto: urlProyecto,
        tipoBusqueda: tipoBusqueda,
        ordenamiento: ordenamiento,
        limit1: limit1,
        limit2: limit2,
        type: mod
    };
    var callback = function (data) {
        $("#contendorPublicacionesProyectos").append(data);
    }
    requestView(link, data, callback);
});


$('#webContent').on("click", ".publicaciones", function () {

    $(".fltDcMuro .filtroType .selected").removeClass("selected");
    $(".fltDcMuro .publicaciones").addClass("selected");

    var ordenamiento = $(".fltDcMuro .filtroDate .selected");

    if (ordenamiento.length == 0) {
        ordenamiento = 'desc';
    } else {
        if (ordenamiento.hasClass('fechaAscendente')) {
            ordenamiento = 'asc';
        } else {
            ordenamiento = 'desc';
        }
    }
    filtroComentariosAjax("AllPublicaciones", ordenamiento);
});

$('#webContent').on("click", ".imagenes", function () {
    $(".fltDcMuro .filtroType .selected").removeClass("selected");
    $(".fltDcMuro .imagenes").addClass("selected");

    var ordenamiento = $(".fltDcMuro .filtroDate .selected");
    if (ordenamiento.length == 0) {
        ordenamiento = 'desc';
    } else {
        if (ordenamiento.hasClass('fechaAscendente')) {
            ordenamiento = 'asc';
        } else {
            ordenamiento = 'desc';
        }
    }
    filtroComentariosAjax("AllImagenes", ordenamiento);
});

$('#webContent').on("click", ".archivos", function () {
    $(".fltDcMuro .filtroType .selected").removeClass("selected");
    $(".fltDcMuro .archivos").addClass("selected");

    var ordenamiento = $(".fltDcMuro .filtroDate .selected");

    if (ordenamiento.length == 0) {
        ordenamiento = 'desc';
    } else {
        if (ordenamiento.hasClass('fechaAscendente')) {
            ordenamiento = 'asc';
        } else {
            ordenamiento = 'desc';
        }
    }
    filtroComentariosAjax("AllArchivos", ordenamiento);
});

$('#webContent').on("click", ".youtubeVideos", function () {
    $(".fltDcMuro .filtroType .selected").removeClass("selected");
    $(".fltDcMuro .youtubeVideos").addClass("selected");

    var ordenamiento = $(".fltDcMuro .filtroDate .selected");

    if (ordenamiento.length == 0) {
        ordenamiento = 'desc';
    } else {
        if (ordenamiento.hasClass('fechaAscendente')) {
            ordenamiento = 'asc';
        } else {
            ordenamiento = 'desc';
        }
    }
    filtroComentariosAjax("AllLinksYoutube", ordenamiento);
});


$('body').on("click", ".divPaginacionComentarios", function () {
    var id_publicacion = $(this).closest(".publicacion-proyecto").attr("data-idp");
    var url = window.location.href;
    url = url.split("/");
    var tama = url.length;
    var urlProyecto = url[tama - 1];
    var limit1 = 0;
    var limit2 = 5;
    var boton = "";
    var thisElement = $(this);

    if ($(this).closest(".infoPublicacion").length > 0) {
        var loader = $(this).closest(".infoPublicacion").find(".loader-section");
    } else {
        var loader = $(this).parent().find(".loader-section");
    }

    if (!($(this).hasClass("comentariosPub"))) {
        boton = $(this).parent();
        limit1 = parseInt($(boton).parent().find(".comentarioPublicado").length);
        limit2 = 5;
    } else {
        if (!($(this).closest(".publicacion-proyecto").find(".contenedorComentariosPublicaciones").is(":empty"))) {
            $(this).closest(".infoPublicacion").css({
                "border-bottom-left-radius": "10px",
                "border-bottom-right-radius": "10px"
            });
            $(this).closest(".publicacion-proyecto").find(".contenedorComentariosPublicaciones").hide().empty();
            return;
        }
        $(this).closest(".infoPublicacion").css({
            "border-bottom-left-radius": "0",
            "border-bottom-right-radius": "0"
        });
    }

    loader.show();

    var mod = getTypeMuro();
    var link = "mostrarComentariosPublicaciones";
    var data = {
        comm: "req",
        id_publicacion: id_publicacion,
        urlProyecto: urlProyecto,
        limit1: limit1,
        limit2: limit2,
        type: mod
    };
    var callback = function (data) {
        if (boton != "") {
            $(boton).empty();
            $(boton).parent().append(data);
            $(boton).remove();
            $(boton).html(boton);
        } else {
            thisElement.closest(".publicacion-proyecto").find(".contenedorComentariosPublicaciones").show().append(data);
        }
        loader.hide();
    };
    requestView(link, data, callback);
});

$('body').on("click", ".btnComentar", function () {
    var comentario = $(this).closest(".contenedorPublicarComentario").find("textarea").val().trim();
    var id_publicacion = "";
    id_publicacion = $(this).closest(".contenedorComentariosPublicaciones").attr("data-idp");

    if (id_publicacion == undefined || id_publicacion == "" || id_publicacion == null) {
        id_publicacion = $(this).closest(".publicacion-proyecto").attr("data-idp");
    }

    $(this).closest(".contenedorPublicarComentario").find("textarea").val("");
    var boton = $(this).closest(".contenedorPublicarComentario");
    if (comentario != "") {
        var mod = getTypeMuro();
        var link = "registrarComentariosPublicaciones";
        var data = {
            comm: "req",
            comentario: comentario,
            id_publicacion: id_publicacion,
            url: getURLWall(),
            type: mod
        };
        loadingModal();
        var callback = function (info) {
            var parent = boton.parent();
            parent.prev(".infoPublicacion").find(".comentariosPublicaciones").text(info.can);
            parent.find(".contenedorPublicarComentario").after(info.com);
            var id_comn = parent.find(".comentarioPublicado").first().attr("data-idc");

            socketEvent("sendComment", {
                url: getURLAfter(2),
                idP: id_publicacion,
                idC: id_comn,
                usr: info.usr,
                can: info.can
            });
        };
        requestJson(link, data, callback);
    } else {
        var functionAceptar = focusTextarea;
        var element = $(this).closest(".contenedorPublicarComentario").find("textarea");
        openAlert("Mensaje", "Escribe el comentario para la publicación.", "message", "Aceptar", "none", functionAceptar);

        function focusTextarea() {
            // element.velocity("scroll", {
            //     offset: "-10px"
            // });
            velocity(element, "scroll", {
                offset: "-10px"
            });

        }
    }
});



//Eliminar publicacion

$("#webContent").on("click", ".publicacion-proyecto-gestion .eliminarPublicacion", function () {

    var elementoC = $(this).closest(".publicacion-proyecto-gestion");

    var functionAceptar = aceptarEliminarPublicacion;
    var functionCancelar = function () {};

    openAlert("Eliminar publicación", "¿Desea eliminar esta publicación?", "confirm", "Aceptar", "Cancelar", functionCancelar, functionAceptar);

    function aceptarEliminarPublicacion() {
        var idp = elementoC.attr("data-idp");
        var urlProyecto = getURLWall();
        var mod = getTypeMuro();
        var link = "eliminarPublicacion";
        var data = {
            comm: "req",
            urlProyecto: urlProyecto,
            id_pub: idp,
            type: mod
        };
        var callback = function (info) {
            if (info.mensaje == "OK") {
                $(elementoC).remove();
                if ($("#contendorPublicacionesProyectos").children().length == 0) {
                    $(".cntDcMuro").addClass("cntDcMuroVc");
                }
            } else {
                openMessage("#F00", "#FFF", "Eso que estás haciendo no está permitido.");
            }
        }
        requestJson(link, data, callback);
    }
});

//Likes Publicaciones

$("#webContent").on("click", ".publicacion-proyecto .infoContentPublicacion .likesPub", function () {
    var elemento = $(this);
    var urlProyecto = getURLWall();
    var id_publicacion = $(this).closest(".publicacion-proyecto").attr("data-idp");
    var mod = getTypeMuro();
    var link = "likePublicacionesProyectos";
    var data = {
        comm: "dbs",
        urlProyecto: urlProyecto,
        id_publicacion: id_publicacion,
        type: mod
    };
    var callback = function (info) {
        if (info.mensaje == true) {
            $(elemento).parent().find(".likesPublicaciones").html(info.cantidad_likes);
            if (info.dar_like == 'S') {
                // $(elemento).addClass("liked").velocity("transition.shrinkIn");
                velocity($(elemento).addClass("liked"), "transition.shrinkIn");
            } else {
                // $(elemento).removeClass("liked").velocity("transition.shrinkIn");
                velocity($(elemento).removeClass("liked"), "transition.shrinkIn");
            }
            socketEvent("sendLikeComment", {
                url: getURLAfter(2),
                idP: id_publicacion,
                can: info.cantidad_likes
            });
        } else if (info.mensaje == false) {
            openMessage("#F00", "#FFF", info.resultado);
        } else {
            openMessage("#F00", "#FFF", info.resultado);
        }
    }
    requestJson(link, data, callback);
});


//Eliminar Comentarios
$("#webContent").on("click", ".publicacion-proyecto .eliminarComentario", function () {
    if ($(this).closest(".contenedorComentariosPublicaciones").find(".contenedorModificarComentario").length == 0) {
        var elementoC = $(this).closest(".comentarioPublicado");
        var functionAceptar = aceptarEliminarComentario;
        var functionCancelar = function () {};

        openAlert("Eliminar comentario", "¿Desea eliminar este comentario?", "confirm", "Aceptar", "Cancelar", functionCancelar, functionAceptar);

        function aceptarEliminarComentario() {
            var idp = elementoC.closest(".publicacion-proyecto").attr("data-idp");
            var idc = elementoC.attr("data-idc");;
            var urlProyecto = getURLWall();
            var mod = getTypeMuro();
            var link = "eliminarComentario";
            var data = {
                comm: "req",
                id_comn: idc,
                id_pub: idp,
                urlProyecto: urlProyecto,
                type: mod
            };
            var callback = function (info) {
                if (info.mensaje == "1") {
                    $(elementoC).remove();
                } else {
                    openAlert("Permiso denegado", "Lo que estás haciendo no está permitido.", "message");
                }
            };
            requestJson(link, data, callback);
        }
    }
});


//Modificar comentarios

$("#webContent").on("click", ".publicacion-proyecto .editarComentario", function () {
    if ($(this).closest(".contenedorComentariosPublicaciones").find(".contenedorModificarComentario").length == 0) {
        var elementoC = $(this).closest(".comentarioPublicado");
        var idp = elementoC.closest(".publicacion-proyecto").attr("data-idp");
        var idc = elementoC.attr("data-idc");

        var urlProyecto = getURLWall();
        var mod = getTypeMuro();
        var link = "formModificarComentario";
        var data = {
            comm: "req",
            id_comn: idc,
            id_pub: idp,
            urlProyecto: urlProyecto,
            type: mod
        };
        var callback = function (data) {
            if (data == "") {
                openAlert("Error", "No puedes modificar este comentario.", "message");
            } else {
                elementoC.parent().find(".opcionesComentario").hide();
                elementoC.closest(".contenedorComentariosPublicaciones").find(".contenedorPublicarComentario").hide();
                $(elementoC).before(data).hide();
            }

        };
        requestView(link, data, callback);
    }
});

$("#webContent").on("click", ".publicacion-proyecto .btnModificarComentario", function () {
    var elementoC = $(this).closest(".contenedorModificarComentario");

    var idc = elementoC.attr("data-idc");
    var urlProyecto = getURLWall();
    var idp = elementoC.closest(".publicacion-proyecto").attr("data-idp");
    var mod = getTypeMuro();
    var comentario_pub = elementoC.closest(".contenedorModificarComentario").find("textarea").val();

    var link = "modificarComentario";
    var data = {
        comm: "req",
        id_comn: idc,
        id_pub: idp,
        urlProyecto: urlProyecto,
        comentario_publicacion: comentario_pub,
        type: mod
    };
    var callback = function (data) {
        if (data == "") {
            openAlert("Error", "No puedes modificar este comentario.", "message");
        } else {
            var idc = elementoC.closest(".contenedorModificarComentario").attr("data-idc");
            elementoC.closest(".contenedorComentariosPublicaciones").find(".comentarioPublicado[data-idc='" + idc + "']").after(data).remove();
            elementoC.closest(".contenedorComentariosPublicaciones").find(".opcionesComentario").show();
            elementoC.closest(".contenedorComentariosPublicaciones").find(".contenedorPublicarComentario").show();
            elementoC.closest(".contenedorComentariosPublicaciones").find(".contenedorModificarComentario").remove();
        }

    };
    requestView(link, data, callback);
});


$("#webContent").on("click", ".publicacion-proyecto .btnCancelarComentario", function () {
    var idc = $(this).closest(".contenedorModificarComentario").attr("data-idc");
    $(this).closest(".contenedorComentariosPublicaciones").find(".opcionesComentario").show();
    $(this).closest(".contenedorComentariosPublicaciones").find(".comentarioPublicado[data-idc='" + idc + "']").show();
    $(this).closest(".contenedorComentariosPublicaciones").find(".contenedorPublicarComentario").show();
    $(this).closest(".contenedorComentariosPublicaciones").find(".contenedorModificarComentario").remove();
});


$("#webContent").on("click", "#btnDesunirse", function () {
    function desunirseProyecto() {
        var link = "modalDesunirProyecto";
        var mod = getTypeMuro();
        var data = {
            comm: "async",
            type: mod
        };
        var callback = function (data) {
            $(".window-modal").append(data);
            loadedModal();
            $.mtStart();
            $("#btnDesunirProyecto").on("click", function () {
                var error = $(this).mtValidate();
                if (error == false) {
                    loadingModal();
                    var urlProyecto = getURLWall();
                    var password = $("#claveUsuario").val();
                    var link = "desunionProyecto";
                    var data = {
                        comm: "req",
                        password: password,
                        urlProyecto: urlProyecto,
                        type: mod
                    };
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == false) {
                            openMessage("#F00", "#FFF", info.resultado);
                            $("#claveUsuario").val("");
                        } else {
                            closeModal(false);
                            var functionAceptar = recargar;
                            openAlert("Mensaje", info.resultado, "message", "Aceptar", "none", functionAceptar);

                            function recargar() {
                                setTimeout(function () {
                                    goHome();
                                }, 100);
                            }
                        }
                    };
                    requestJson(link, data, callback);
                }
            });
        };
        requestView(link, data, callback);
    }
    openModal(desunirseProyecto);
});

$("#webContent").on("keyup", "#btnBuscarNameProyecto", function () {
    var $id_carpeta_proyecto = "0";
    var $busqueda_nombre_proyecto = $("#btnBuscarNameProyecto").val().trim();
    var $filtro_proyectos = "Nombre";

    if ($busqueda_nombre_proyecto.trim() == "") {
        var $filtro_proyectos = "Todos";
        var $id_carpeta_proyecto = "0";
        var $busqueda_nombre_proyecto = "0";
    }
    $("#loader-fltrMrRsltAux").show();
    var link = "seleccionar-proyectos_filtro";
    var data = {
        comm: "async",
        "id_carpeta_proyecto": $id_carpeta_proyecto,
        "busqueda_nombre_proyecto": $busqueda_nombre_proyecto,
        "filtro_proyectos": $filtro_proyectos
    };
    var callback = function (data) {
        $(".contenedorProyectos").replaceWith(data);
        $("#loader-fltrMrRsltAux").hide();
    };
    requestView(link, data, callback);
});


$("#webContent").on("click", "#linkRenovarProyecto", function (e) {
    e.preventDefault();
    var idProyecto = $("#btnUpdateProyecto").data().id_proyecto;
    var link = "formRenovarProyectos";
    loadingContent();
    var data = {
        comm: "async",
        id_proyecto: idProyecto
    };
    var callback = function (data) {
        $("#webContent").html(data);
        $.mtStart();
        loadedContent();
        $("#btnUpdateProyecto").data("id_proyecto", $("#btnUpdateProyecto").attr("data-proyecto")).removeAttr("data-proyecto");
        var img = $("#proyecto-imagen").attr("data-img");
        if (img != "") {
            $("#proyecto-imagen").removeAttr("data-img");
            $("#proyecto-imagen").parent().find(".img-file>img").attr("src", img);
            $("#proyecto-imagen").parent().parent().addClass("fl-loaded");

            var elementSpan = $("#proyecto-imagen").parent().find(".img-file span");
            setImageDeleteEvent(elementSpan, "proImg");
        }
        $(".img-file").find("span").hide();
    };
    requestView(link, data, callback);
});

$("#webContent").on("click", "#btnRenovarProyecto", function () {
    var error = $(this).mtValidate();

    if (error == false) {
        error = validaFechasProyectosConvocatoria();
    }

    if (error == false) {
        error = validaFechasProyectos();
    }

    if (error == false) {
        error = validaFechasConvocatoriasEInicioYFinProyectos();
    }

    if (error == false) {
        var seleccionado = isThereCheckSelected("r");
        if (seleccionado == "Si") {
            error = false;
        } else {
            error = true;

            var title = "Seleccione por lo menos un grado";
            var content = "Debe seleccionar por lo menos un grado para cualquiera de los niveles educativos (Preescolar, Primaria o Secundaria).";
            defaultErrorAlert(title, content);
            // $(".seleccionar-grados").first().velocity("scroll");
            velocity($(".seleccionar-grados").first(), "scroll");

        }
    }
    if (error == false) {
        var grados = [];
        $(".seleccionar-grados").find("input:checked").each(function (index) {
            grados[index] = {
                "grado": $(this).attr("id").split("-")[2]
            };
        });
        var formulario = $(".form-registrar-proyectos").find("input, textarea").serializeArray();
        var url = $("#proyecto-imagen").parent().find(".img-file img").attr("src");
        var imagen = getUrlImage(url);
        var color = $("#proyecto-imagen").attr("data-color");
        var alianzas = (($("#slct-alianzas").data().values.length == 0) ? "" : $("#slct-alianzas").data().values);
        loadingPage();

        var data = {
            "comm": "dbs",
            "grados": grados,
            "alianzas": alianzas,
            "imagen": ((imagen == undefined) ? "" : imagen),
            "proyecto-nombre": formulario[0].value,
            "proyecto-fechaInicioInscripcion": formulario[1].value,
            "proyecto-fechaFinInscripcion": formulario[2].value,
            "proyecto-fechaInicio": formulario[3].value,
            "proyecto-fechaFin": formulario[4].value,
            "proyecto-descripcion": formulario[5].value,
            "tipo_proyecto": "R",
            "id_proyecto_renovacion": $("#btnRenovarProyecto").attr("data-proyecto"),
            "color": ((color == undefined) ? "" : color)
        };
        var link = "registrarProyectos";
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                $("#menu-pc-sesion li[data-file*='formProyectos']").trigger("click");
                openMessage("#5cb85c", "#FFF", info.resultado);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else {
                if (info.validaFechas == true) {
                    openMessage("#F00", "#FFF", info.resultado);
                    $(info.inputFecha).focus();
                } else {
                    openMessage("#F00", "#FFF", info.resultado);
                }
            }
        };
        requestJson(link, data, callback);
    }
});

$("body").on("change", "#slCicloEscolarProyectosPub", function () {
    var urlProyecto = getURLWall();
    var id_ciclo_escolar = $(this).val().trim();
    var link = "obtenerDocentesProyectoCicloEsc";
    loadingModal();
    var data = {
        comm: "async",
        urlProyecto: urlProyecto,
        id_ciclo_escolar: id_ciclo_escolar
    };
    var callback = function (info) {
        $(".window-modal .docentes-relacionados-proyectos").html(info);
        loadedModal();
    }
    requestView(link, data, callback);

});

$("#webContent").on("change", "#slCicloEscolarProyectos", function () {
    var urlProyecto = getURLWall();
    var id_ciclo_escolar = $(this).val().trim();
    var link = "obtenerInfoProyectoCicloEscolar";
    $(".loader-section").show();
    var data = {
        comm: "async",
        urlProyecto: urlProyecto,
        id_ciclo_escolar: id_ciclo_escolar
    };
    var callback = function (info) {
        localStorage.pos = ".docentesRelacionados";
        var aux = "changedCicloEscolar";
        goToUrl(info.url, aux);
    }
    requestJson(link, data, callback);
});

$("#webContent").on("change", "#slCicloEscolarProyec", function () {
    var $id_ciclo_escolar = $("#slCicloEscolarProyec option:selected").attr("value");
    var URLactual = window.location.href;
    var nombre_usuario = getRoutingName(URLactual, 2);
    $("#loader-fltrMrRsltAux").show();
    var link = "proyectoDocenteFiltros";
    var data = {
        comm: "req",
        "id_ciclo_escolar": $id_ciclo_escolar,
        nombre_usuario: nombre_usuario.name
    };
    var callback = function (data) {
        $(".contenedorProyectos").replaceWith(data);
        $("#loader-fltrMrRsltAux").hide();
    };
    requestView(link, data, callback);
});

$("#webContent").on("change", "#slCicloEscolarPerfilDoc", function () {
    var $id_ciclo_escolar = $("#slCicloEscolarPerfilDoc option:selected").attr("value");
    var nombre_usuario = getURLWall();
    $("#loader-docProjects").addClass("show");
    var link = "proyectoDocenteFiltros";
    var data = {
        comm: "req",
        "id_ciclo_escolar": $id_ciclo_escolar,
        nombre_usuario: nombre_usuario
    };
    var callback = function (data) {
        $(".contenedorProyectos").replaceWith(data);
        $("#loader-docProjects").removeClass("show");
    };
    requestView(link, data, callback);
});