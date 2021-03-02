import velocity from 'velocity-animate';

import {
    routing,
    getURLAfter
} from '../helpers/urls';

const scrollDownChats = () => {
    if (routing(1, "mensajes") && getURLAfter(3) != "") {
        var bodyWidth = parseInt($("body").css("width"));
        var mensajesEl = $(".contenedor-chats .contenido");
        var scrollMax = $(".contenedor-chats .contInt").css("height");

        if (bodyWidth < 699) {
            velocity(mensajesEl, "scroll", {
                duration: 0,
                offset: scrollMax
            });

            $(".contenedor-chats").removeClass("onlyChats");
            $(".contenedor-chats").addClass("onlyMensajes");
        } else {
            velocity(mensajesEl, "scroll", {
                duration: 0,
                container: mensajesEl,
                offset: scrollMax
            });
        }
    }
};

export default scrollDownChats;