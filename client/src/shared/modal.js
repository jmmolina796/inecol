import {
    closeMessage
} from './message';

let helpMessage;

export const openModal = (callback) => {
    $("#loader-modal").show();
    $("body").css("overflow", "hidden");

    /*Prueba*/

    //$(".window-modal").velocity("transition.slideDownBigIn",callback,250);  //Efecto

    callback();
    $(".window-modal").show();

    /*Prueba*/

    $(".window-modal .content-modal").hide();
    helpMessage = setTimeout(() => {
        $(".helpMessage").show("fast")
    }, 5000);
    /*setTimeout(function(){
        //$(".window-modal").css("box-shadow","0px 0px 120px 120px rgba(0,0,0,0.3) inset")


            /*Prueba*/

    //$("#main").addClass("blur")
    $("#main").css("opacity", "0.2");

    /*Prueba*/

    //},280);
}

export const closeModal = (effect) => {
    if (window.arMlt != undefined) {
        window.pntFl = undefined;
        window.arMlt = undefined;
        window.tpFl = undefined;
    }

    $("#loader-modal").hide();
    $("body").css("overflow", "auto");


    /*Prueba*/

    //$("#main").removeClass("blur");
    $("#main").css("opacity", "1");

    /*Prueba*/


    if ($(".contenedorLinksPostActivo").length > 0) {
        $(".contenedorLinksPostActivo").removeClass("contenedorLinksPostActivo");
    }

    $(".window-modal .content-modal").remove();
    //$(".window-modal .content-modal").hide();
    closeMessage();

    if (effect == false) {
        $(".window-modal").hide();
    } else {
        //$(".window-modal").velocity("transition.slideUpBigOut",300);
        $(".window-modal").hide();
    }

}

export const loadingModal = () => {
    $("#loader-modal").css({
        "z-index": "22"
    }).show();
    $(".content-modal>").css({
        "opacity": "0.3"
    });
}
export const loadedModal = () => {
    clearTimeout(helpMessage);
    $(".content-modal").show();
    $("#loader-modal").hide().css({
        "z-index": "20"
    });
    $(".content-modal>").css({
        "opacity": "1"
    });
};