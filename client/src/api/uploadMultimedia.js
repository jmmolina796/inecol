import {
    isHeaderUser
} from '../shared/functions';

import {
    openAlert,
    defaultErrorAlert
} from '../shared/alert';

import {
    openMessage
} from '../shared/message';

import {
    routing
} from '../helpers/urls';

import {
    deleteImage
} from './';

const backFileUploadError = (type, element) => {
    if (type == "pub" || type == "pubMod") {
        element.parent().find(".contenedorImagenesPost").children().remove(".imagen-loader");
        $(".publicacion-imagen").val("");
        if (element.parent().find(".contenedorImagenesPost").children().length < 1) {
            element.parent().find(".imagenesPublicacion").hide("fast");
        }
    } else if (type == "FPub" || type == "FPubMod") {
        element.parent().find(".contenedorArchivosPost").children().remove(".archivo-loader");
        $(".publicacion-archivo").val("");
        if (element.parent().find(".contenedorArchivosPost").children().length < 1) {
            element.parent().find(".archivosPublicacion").hide("fast");
        }
    } else if (routing(1, "configuracion")) {
        $(".imagen-selector").removeClass("imagen-loading");
    }
}

const uploadMultimedia = (element, mult, type, callback, del, delLink, type2) => {
    del = (del === undefined) ? false : del;
    delLink = (delLink === undefined) ? "" : delLink;
    type2 = (type2 === undefined) ? "" : type2;
    var flag = false;
    var message = "";

    var archivo = element[0].files;
    var archivos = new FormData();
    for (let i = 0; i < archivo.length; i++) {
        archivos.append('file' + i, archivo[i]);
    }

    if (mult == "fl") {
        flag = archivo[0].size > 15 * (1024 * 1024);
        message = "No se pueden subir archivos superiores a 15MB.";
    } else {
        flag = archivo[0].size > 10 * (1024 * 1024);
        message = "No se pueden subir imágenes superiores a 10MB.";
    }

    if (flag) {
        openMessage("#F00", "#FFF", message);
        if (type != "pub" && type != "pubMod" && type != "FPub" && type != "FPubMod") {
            var elementLoading = element.closest(".fl-loading");
            if (elementLoading.length > 0) {
                elementLoading.removeClass("fl-loading");
                element.parent().find("input[type='text']").val("No seleccionado");
            }
        }
    } else {

        if (type == "pub" || type == "pubMod") {
            var divImagen = element.parent().find(".imagenesPublicacion");
            if (divImagen.css("display") == "none") {
                if (divImagen.find(".agregarImagenPost").css("display") == "none") {
                    divImagen.find(".agregarImagenPost").show()
                    divImagen.find(".eliminarImagenPost").text("Eliminar");
                }
                divImagen.show("fast");
            }
            element.parent().find(".contenedorImagenesPost").append("<div class='imagen-loader'></div>");
        } else if (type == "FPub" || type == "FPubMod") {
            var divArchivo = element.parent().find(".archivosPublicacion");
            if (divArchivo.css("display") == "none") {
                if (divArchivo.find(".agregarArchivoPost").css("display") == "none") {
                    divArchivo.find(".agregarArchivoPost").show()
                    divArchivo.find(".eliminarArchivoPost").text("Eliminar");
                }
                divArchivo.show("fast");
            }
            var name = element.val();
            var position = name.lastIndexOf("\\") + 1;
            name = name.substring(position, name.length);
            position = name.lastIndexOf(".") + 1;
            var extension = name.substring(position, name.length);
            extension = extension.toLowerCase();
            name = name.substring(0, position - 1);
            name += "." + extension;
            element.parent().find(".contenedorArchivosPost").append("<div class='archivo-loader'><span>" + name + "</span></div>");
        }

        element.val("");

        var link = "subirImagen?type=" + type;

        if (isHeaderUser()) {
            if (localStorage.USR_SESS === undefined) {
                link += "&USR_SESS=@UNDEFINED";
            } else {
                link += "&USR_SESS=" + ($(".usr-ssn").data().USR_SESS);
            }
        }
        $.ajax({
            url: link,
            type: "POST",
            contentType: false,
            data: archivos,
            processData: false,
            cache: false,

            retryCount: 0,
            retryLimit: 10,
            timeout: 0,
            retryTimeout: 10000,
            created: Date.now(),

            success: (data) => {
                debugger;
                try {
                    var info = JSON.parse(data);
                    if ((info.rdirUsrSessUrl === undefined)) {
                        if (info.size) {
                            var title = "Archivo muy pesado";
                            var content = "El archivo excedió el tamaño máximo.";
                            defaultErrorAlert(title, content);

                            backFileUploadError(type, element);
                        } else if (info.format) {
                            var title = "Archivo incorrecto";
                            var content = "El archivo que se ha seleccionado no está permitido.";
                            defaultErrorAlert(title, content);

                            backFileUploadError(type, element);

                        } else if (info.error) {
                            openMessage("#F00", "#FFF", "Error de conexión.");
                        } else {
                            if (del === true) {
                                var callback2 = function (info) {};
                                deleteImage(delLink, type2, callback2)
                            }
                            callback(info);
                        }
                    } else {
                        if (info.rdirUsrSessUrl == "@accessRequired") {
                            $(".btn-sesion").trigger("click");
                        } else {
                            var functionAceptar = () => setTimeout(() => {
                                window.location = URL_GLOBAL + info.rdirUsrSessUrl;
                            }, 100);
                            openAlert(info.titlRdir, info.messRdir, "message", "Aceptar", "none", functionAceptar);
                        }
                    }
                } catch (err) {
                    openMessage("#F00", "#FFF", "Error desconocido.");
                    backFileUploadError(type, element);
                }
            },
            error: (xhr, ajaxOptions, thrownError) => {
                this.retryCount++;
                if (this.retryCount <= this.retryLimit && Date.now() - this.created < this.retryTimeout) {
                    $.ajax(this);
                    return;
                }

                requestError(xhr, ajaxOptions, thrownError);
            }
        });
    }
};

export default uploadMultimedia;