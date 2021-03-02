import {
    closeModal
} from '../shared/modal';

export const openAlert = (title, body, type, button1, button2, functionCancelar, functionAceptar) => {
    $(".alert-modal").find(".headerAlert h4").text(title);
    $(".alert-modal").find(".bodyAlert").text(body);

    $(".alert-modal").removeClass("messageError");

    if (type == "confirm") {
        $(".alert-modal").find(".buttonsAlert").addClass("two-btn").removeClass("one-btn");

        if (button1 == undefined) {
            $(".alert-modal").find(".btnAlertAceptar").text("Aceptar");
        } else {
            $(".alert-modal").find(".btnAlertAceptar").text(button1);
        }
        if (button2 == undefined) {
            $(".alert-modal").find(".btnAlertCancelar").text("Cancelar");
        } else {
            $(".alert-modal").find(".btnAlertCancelar").text(button2);
        }
    } else if (type == "message" || type == "messageError") {
        $(".alert-modal").find(".buttonsAlert").addClass("one-btn").removeClass("two-btn");
        if (button1 == undefined) {
            $(".alert-modal").find(".btnAlertCancelar").text("Aceptar");
        } else {
            $(".alert-modal").find(".btnAlertCancelar").text(button1);
        }
    }

    if (type == "messageError") {
        $(".alert-modal").addClass("messageError");
    }


    if ($("window-modal").css("display") != "none") {
        closeModal(false);
    }

    //$(".alert-modal").velocity("transition.shrinkIn",100);
    $(".alert-modal").show();

    /*Prueba*/

    //setTimeout(function(){
    $("#main").css("opacity", "0.1");
    //},280);

    /*Prueba*/


    $("body").css("overflow", "hidden");

    if (functionAceptar != undefined) {
        $(".alert-modal .btnAlertAceptar").one("click", function () {
            closeAlert();
            functionAceptar();
            $(".alert-modal .btnAlertCancelar").off("click");
        });
    }
    if (functionCancelar != undefined) {
        $(".alert-modal .btnAlertCancelar").one("click", function () {
            closeAlert();
            functionCancelar();
            $(".alert-modal .btnAlertAceptar").off("click");
        });
    }
};

export const closeAlert = () => {
    //$(".alert-modal").velocity("transition.shrinkOut",100);
    $(".alert-modal").hide();
    $("body").css("overflow", "auto");

    /*Prueba*/

    $("#main").css("opacity", "1");

    /*Prueba*/
};

export const defaultErrorAlert = (title, content, element, extraFunction) => {
    const functionAceptar = () => {
        if (element !== undefined && element != "none") {
            $(element).mtError();
        } else {
            if (extraFunction !== undefined) {
                extraFunction();
            }
        }
    };
    openAlert(title, content, "messageError", "Aceptar", "none", functionAceptar);
};