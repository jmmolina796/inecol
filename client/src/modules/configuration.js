import '../plugins/imagesLoaded';

import getDominantColor from '../shared/getDominantColor';

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
    deleteImage,
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
} from '../shared/contentLoaders';

import {
    openAlert
} from '../shared/alert';

import {
    openMessage
} from '../shared/message';

const imagenDefault = () => {
    var link = "imagenDefault";
    var data = {
        comm: "req"
    };
    var callback = (data) => {
        $("#imagen-configuracion img").attr("src", data);
        $("#imagen-configuracion").addClass("default");
    }
    requestView(link, data, callback);
}

$("#webContent").on("click", "#imagen-configuracion .nuevaImagen", function () {
    if ($("#admin-imagen-conf").length > 0) {
        $("#admin-imagen-conf").trigger("click");
    } else if ($("#docente-imagen-conf").length > 0) {
        $("#asesor-imagen-conf").trigger("click");
    } else if ($("#asesor-imagen-conf").length > 0) {
        $("#asesor-imagen-conf").trigger("click");
    }
});

$("#webContent").on("click", "#imagen-configuracion .eliminarImagen", function () {
    var link = $("#imagen-configuracion img").attr("src");
    if ($(this).closest(".form-configuracion-docente").length > 0) {
        deleteImage(link, "docImg", imagenDefault);
        $(this).parent().find("img").attr("data-color", "default");
    } else if ($(this).closest(".form-configuracion-administrador").length > 0) {
        deleteImage(link, "admImg", imagenDefault);
        $(this).parent().find("img").attr("data-color", "default");
    } else if ($(this).closest(".form-configuracion-asesor").length > 0) {
        deleteImage(link, "aseImg", imagenDefault);
        $(this).parent().find("img").attr("data-color", "default");
    }
});

$("#webContent").on("change", "#admin-imagen-conf", function () {
    $(".imagen-selector").addClass("imagen-loading");
    var error = validateFile($(this));
    if (!error) {
        var element = $(this);
        var mult = "img";
        var type = "administradores";

        var link = $("#imagen-configuracion img").attr("src");
        link = getUrlImage(link);

        var del = true;
        var delLink = link;
        var type2 = "admImg";

        var callback = (info) => {
            $("#imagen-configuracion img").attr("src", info.link);

            if ($("#imagen-configuracion").hasClass("default")) {
                $("#imagen-configuracion").removeClass("default");
            }

            $(".imagen-selector").removeClass("imagen-loading");
            $("#imagen-configuracion-img").parent().imagesLoaded().then(function () {
                var elementImage = $("#imagen-configuracion-img")
                var arr = getDominantColor(elementImage);
                elementImage.attr("data-color", arr);
            });
        }
        uploadMultimedia(element, mult, type, callback, del, delLink, type2);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado es incorrecto. Solo se permiten imágenes.";
        defaultErrorAlert(title, content);
        $("#admin-imagen-conf").val("");
        $(".imagen-selector").removeClass("imagen-loading");
    }
});

$("#webContent").on("change", "#docente-imagen-conf", function () {
    $(".imagen-selector").addClass("imagen-loading");
    var error = validateFile($(this));
    if (!error) {
        var element = $(this);
        var mult = "img";
        var type = "docentes";

        var link = $("#imagen-configuracion img").attr("src");
        link = getUrlImage(link);

        var del = true;
        var delLink = link;
        var type2 = "docImg";

        var callback = (info) => {
            $("#imagen-configuracion img").attr("src", info.link);

            if ($("#imagen-configuracion").hasClass("default")) {
                $("#imagen-configuracion").removeClass("default");
            }

            $(".imagen-selector").removeClass("imagen-loading");

            $("#imagen-configuracion-img").parent().imagesLoaded().then(() => {
                var elementImage = $("#imagen-configuracion-img")
                var arr = getDominantColor(elementImage);
                elementImage.attr("data-color", arr);
            });
        }
        uploadMultimedia(element, mult, type, callback, del, delLink, type2);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado es incorrecto. Solo se permiten imágenes.";
        defaultErrorAlert(title, content);
        $("#docente-imagen-conf").val("");
        $(".imagen-selector").removeClass("imagen-loading");
    }
});

$("#webContent").on("change", "#asesor-imagen-conf", function () {
    $(".imagen-selector").addClass("imagen-loading");
    var error = validateFile($(this));
    if (!error) {
        var element = $(this);
        var mult = "img";
        var type = "asesores";

        var link = $("#imagen-configuracion img").attr("src");
        link = getUrlImage(link);

        var del = true;
        var delLink = link;
        var type2 = "aseImg";

        var callback = (info) => {
            $("#imagen-configuracion img").attr("src", info.link);

            if ($("#imagen-configuracion").hasClass("default")) {
                $("#imagen-configuracion").removeClass("default");
            }

            $(".imagen-selector").removeClass("imagen-loading");

            $("#imagen-configuracion-img").parent().imagesLoaded().then(() => {
                var elementImage = $("#imagen-configuracion-img")
                var arr = getDominantColor(elementImage);
                elementImage.attr("data-color", arr);
            });
        }
        uploadMultimedia(element, mult, type, callback, del, delLink, type2);
    } else {
        var title = "Archivo incorrecto";
        var content = "El archivo que se ha seleccionado es incorrecto. Solo se permiten imágenes.";
        defaultErrorAlert(title, content);
        $("#asesor-imagen-conf").val("");
        $(".imagen-selector").removeClass("imagen-loading");
    }
});

$("#webContent").on("click", "#btnConfigDoc", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var link = $("#imagen-configuracion img").attr("src");
        var imagen = getUrlImage(link);
        var color = $("#imagen-configuracion-img").attr("data-color");
        var formulario = $(".form-docentes").find("input,select,#ck-doc-pasevic").serializeArray();
        if ($("#tblEscuelasAgregadasDocente tbody tr").length > 0) {
            var clave = "";
            var claveSinGradosOGrupos = "";
            var id_grado = "";
            var id_grado1 = "";
            var id_grado2 = "";
            var id_grupo = "";
            var id_grupo1 = "";
            var id_grupo2 = "";
            var grado1 = "";
            var grado2 = "";
            var grupo1 = "";
            var grupo2 = "";
            var clave1 = "";
            var clave2 = "";
            var datos = [];
            error = false;
            $("#tblEscuelasAgregadasDocente tbody tr").each(function (index) {
                clave = $(this).find('td').eq(0).text().trim();
                id_grado = $(this).find("td").find(".slgrado option:selected").val();
                id_grupo = $(this).find("td").find(".slgrupo option:selected").val();
                if (id_grado == "none" || id_grupo == "none") {
                    error = true;
                    return false;
                } else {
                    datos[index] = [{
                        "clave": clave
                    }, {
                        "id_grado": id_grado
                    }, {
                        "id_grupo": id_grupo
                    }];
                }
            });
            if (error == false) {
                $("#tblEscuelasAgregadasDocente tbody tr").each(function (index1) {
                    if (error) {
                        return false;
                    }
                    clave1 = $(this).find('td').eq(0).text().trim();
                    grado1 = $(this).find("td").find(".slgrado option:selected").text().trim();
                    grupo1 = $(this).find("td").find(".slgrupo option:selected").text().trim();
                    id_grado1 = $(this).find("td").find(".slgrado option:selected").val().trim();
                    id_grupo1 = $(this).find("td").find(".slgrupo option:selected").val().trim();
                    $("#tblEscuelasAgregadasDocente tbody tr").each(function (index2) {
                        clave2 = $(this).find('td').eq(0).text().trim();
                        grado2 = $(this).find("td").find(".slgrado option:selected").text().trim();
                        grupo2 = $(this).find("td").find(".slgrupo option:selected").text().trim();
                        id_grado2 = $(this).find("td").find(".slgrado option:selected").val().trim();
                        id_grupo2 = $(this).find("td").find(".slgrupo option:selected").val().trim();
                        if (index1 != index2) {
                            if (clave1 == clave2) {
                                if (id_grado1 == id_grado2 && id_grupo1 == id_grupo2) {
                                    error = true;
                                    return false;
                                }
                            }
                        }
                    });
                });
                if (error == false) {
                    var data = {
                        "comm": "dbs",
                        "arreglo": datos,
                        "imagen": imagen,
                        "nombre": formulario[0].value,
                        "ape_paterno": formulario[1].value,
                        "ape_materno": formulario[2].value,
                        "mail": formulario[3].value,
                        "nombre_usuario": formulario[4].value,
                        "telefono": formulario[5].value,
                        "id_entidad": formulario[6].value,
                        "id_municipio": formulario[7].value,
                        "localidad": formulario[8].value,
                        "color": (color == undefined) ? "" : color
                    };
                    loadingPage();
                    var link = "modificarDocentes";
                    var callback = (info) => {
                        loadedPage();
                        if (info.mensaje == true) {
                            var functionAceptar = recargar;
                            openAlert("Mensaje", info.resultado, "message", "Aceptar", "none", functionAceptar);

                            function recargar() {
                                /*setTimeout(function(){*/
                                window.location.reload(true);
                                /*}, 100); */
                            }
                        } else if (info.mensaje == false) {
                            openMessage("#F00", "#FFF", info.resultado);
                        } else if (info.mensaje == "usuario") {
                            var title = "Nombre de usuario";
                            var content = info.resultado;
                            var element = $("#docente-usuario");
                            defaultErrorAlert(title, content, element);
                        } else if (info.mensaje == "email") {
                            var title = "Correo electrónico";
                            var content = info.resultado;
                            var element = $("#docente-correo");
                            defaultErrorAlert(title, content, element);
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }

                    }
                    requestJson(link, data, callback);
                } else {
                    var title = "El grupo y grado se repiten";
                    var content = "Por favor verifique que en la escuela con clave " + clave1 + " no se repita 2 veces el grado " + grado1 + " y el grupo " + grupo1 + ".";
                    defaultErrorAlert(title, content);
                    $("#containerTablaEscuelasAgregadas").velocity("scroll");
                }
            } else {
                var title = "Seleccione el grupo y el grado";
                var content = "Debe seleccionar el grado y el grupo de la escuela con clave " + clave + ".";
                defaultErrorAlert(title, content);
                $("#containerTablaEscuelasAgregadas").velocity("scroll");
            }
        } else {
            var title = "Ninguna escuela seleccionada";
            var content = "Debe agregar mínimo una escuela con la cual va a participar.";
            var element = $("#docente-escuelas");
            defaultErrorAlert(title, content, element);
        }
    }
});



$("#webContent").on("click", "#btnConfigAdmin", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var data = $(".form-configuracion-administrador").find("input").serialize();

        var link = $("#imagen-configuracion img").attr("src");
        var imagen = getUrlImage(link);
        var color = $("#imagen-configuracion-img").attr("data-color");
        color = color == undefined ? "" : color;
        data += "&imagen=" + imagen + "&color=" + color + "&comm=dbs";

        var link = "modificarAdministradores";
        loadingPage();
        var callback = (info) => {
            loadedPage();
            if (info.mensaje == true) {
                var functionAceptar = recargar;
                openAlert("Mensaje", info.resultado, "message", "Aceptar", "none", functionAceptar);

                function recargar() {
                    /*setTimeout(function(){*/
                    window.location.reload(true);
                    /*}, 100); */
                }
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else if (info.mensaje == "usuario") {
                var title = "Nombre de usuario";
                var content = info.resultado;
                var element = $("#admin-usuario");
                defaultErrorAlert(title, content, element);
            } else if (info.mensaje == "email") {
                var title = "Correo electrónico";
                var content = info.resultado;
                var element = $("#admin-correo");
                defaultErrorAlert(title, content, element);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", "#btnConfigAsesor", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var data = $(".form-configuracion-asesor").find("input, select").serialize();

        var link = $("#imagen-configuracion img").attr("src");
        var imagen = getUrlImage(link);
        var color = $("#imagen-configuracion-img").attr("data-color");
        color = color == undefined ? "" : color;
        data += "&imagen=" + imagen + "&color=" + color + "&comm=dbs";

        debugger;

        var link = "modificarAsesores";
        loadingPage();
        var callback = (info) => {
            loadedPage();
            if (info.mensaje == true) {
                var functionAceptar = recargar;
                openAlert("Mensaje", info.resultado, "message", "Aceptar", "none", functionAceptar);

                function recargar() {
                    window.location.reload(true);
                }
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
            } else if (info.mensaje == "usuario") {
                var title = "Nombre de usuario";
                var content = info.resultado;
                var element = $("#asesor-usuario");
                defaultErrorAlert(title, content, element);
            } else if (info.mensaje == "email") {
                var title = "Correo electrónico";
                var content = info.resultado;
                var element = $("#asesor-correo");
                defaultErrorAlert(title, content, element);
            } else {
                openMessage("#F00", "#FFF", info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$("#webContent").on("click", ".configuration-more .cancelarCuenta", function () {
    function eliminarCuenta() {
        loadingModal();
        var link = "modalEliminarCuenta";
        var data = {
            comm: "async"
        };
        var callback = function (data) {
            $(".window-modal").append(data);
            loadedModal();
            $(".form-cerrar-cuenta #btnCerrarCuenta").on("click", function () {
                loadingModal();

                var link = "eliminarCuenta";
                var data = {
                    comm: "req"
                };
                var callback = (info) => {
                    loadedModal();
                    closeModal();
                    if (info.mensaje == true) {
                        var functionAceptar = recargar;
                        var title = "Mensaje"
                        var message = "Su cuenta ha sido desactivada.";
                        openAlert(title, message, "message", "Aceptar", "none", functionAceptar);

                        function recargar() {
                            goHome(true);
                        }
                    } else {
                        openMessage("#F00", "#FFF", info.resultado);
                    }
                };
                requestJson(link, data, callback);
            });
        }
        requestView(link, data, callback);
    }
    openModal(eliminarCuenta);
});


$("#webContent").on("click", ".configuration-more .cambiarClave", function () {
    function modificarClave() {
        loadingModal();
        var link = "modalModificarClave";
        var data = {
            comm: "async"
        };
        var callback = function (data) {
            $(".window-modal").append(data);
            loadedModal();
            $.mtStart();

            $(".form-cambiar-clave #modificarClaveUsuario").on("click", function () {
                var error = $(this).mtValidate();
                if (error == false) {
                    var contrasena1 = $(".form-cambiar-clave #claveNueva").val();
                    var contrasena2 = $(".form-cambiar-clave #claveNueva2").val();

                    if (contrasena1 == contrasena2) {
                        var data = $(".form-cambiar-clave").find("input").serialize();
                        data += "&comm=req";
                        loadingModal();

                        var link = "modificarClave";
                        loadingModal();
                        var callback = (info) => {
                            loadedModal();
                            if (info.mensaje == "1") {
                                closeModal(false);
                                var functionAceptar = recargar;
                                openAlert("Mensaje", info.resultado, "message", "Aceptar", "none", functionAceptar);

                                function recargar() {
                                    setTimeout(function () {
                                        window.location.reload(true);
                                    }, 100);
                                }

                            } else {
                                $(".form-cambiar-clave #claveActual").val("");
                                openMessage("#F00", "#FFF", info.resultado);
                            }

                        };
                        requestJson(link, data, callback);
                    } else {
                        $(".form-cambiar-clave #claveNueva").val("");
                        $(".form-cambiar-clave #claveNueva2").val("");
                        openMessage("#F00", "#FFF", "Las contraseñas nuevas no coinciden.");
                    }
                }
            });
        }
        requestView(link, data, callback);
    }
    openModal(modificarClave);
});