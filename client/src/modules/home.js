import velocity from 'velocity-animate';

import {
    openModal,
    loadingModal,
    loadedModal,
} from '../shared/modal';

import {
    requestJson,
    requestView,
} from '../api';

import {
    openMessage
} from '../shared/message';

$(".btn-sesion").on("click", function () {
    function loguearUsuario() {
        loadingModal();
        var link = "logueo";
        var data = {
            comm: "async"
        };
        var callback = function (data) {
            $(".window-modal").html(data);
            $.mtStart();
            loadedModal();

            $("#logueoUsuarios").on("click", function () {
                var error = $(this).mtValidate();
                if (error == false) {
                    loadingModal();
                    var link = "iniciar_sesion";
                    var data = $(".form-logueo").find("input").serialize();
                    data += "&comm=req";
                    var callback = function (info) {
                        loadedModal();
                        if (info.mensaje == true) {
                            localStorage.USR_SESS = info.USR_SESS;
                            setTimeout(function () {
                                window.location.reload(true);
                            }, 200);
                        } else if (info.mensaje == false) {
                            openMessage("#F00", "#FFF", info.resultado);
                            $("#logueoPassword").val("");
                        } else {
                            openMessage("#F00", "#FFF", info.resultado);
                        }

                    }
                    requestJson(link, data, callback);
                }
            });
        }
        requestView(link, data, callback);
    }
    openModal(loguearUsuario);
});

$(".window-modal").on("click", ".fPassword", function () {
    var link = "formRecuperarPassword";
    var data = {
        comm: "async"
    };
    loadingModal();
    var callback = function (data) {
        const $el = $(".form-recuperar-password").html(data);
        velocity($el, "transition.slideLeftIn", 200, () => {
            $(".body-modal").addClass("segundoPlano");
        });
        $.mtStart();
        loadedModal();
    };
    requestView(link, data, callback);
});

$(".window-modal").on("click", ".btnEnviarMail", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var link = "enviarMail";
        var data = {
            comm: "req",
            correo: $("#usuario-correo").val().trim()
        };
        loadingModal();
        var callback = function (info) {
            loadedModal();
            if (info.mensaje == true) {
                alert(info.resultado);
                //closeModal();
            } else {
                alert(info.resultado);
            }
        };
        requestJson(link, data, callback);
    }
});

$(".form-cambiar-password").on("click", "#btnCambiarContrasena", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var $newPass1 = $("#usuario-password").val();
        var $newPass2 = $("#usuario-passwordCon").val();
        var token = getURLToken();
        if ($newPass1 == $newPass2) {
            loadingPage();
            var link = "modificarPasswordUsuario";
            var data = {
                comm: "req",
                password: $newPass1,
                token: token
            };
            var callback = function (info) {
                loadedPage();
                if (info.mensaje) {
                    alert(info.resultado);
                    goHome();
                } else {
                    alert(info.resultado);
                    goHome();
                }
            }
            requestJson(link, data, callback);
        } else {
            alert("Las contraseñas no coinciden");
        }
    }
});