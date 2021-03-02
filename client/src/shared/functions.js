import {
    routing,
} from '../helpers/urls';


export const bodySize = () => parseInt($("body").css("width"));

export const isHeaderUser = () => {
    var header = $("header").hasClass("usr-ssn");
    var img = $("#content-sesion figure").hasClass("userSessImg");
    return header && img;
};

export const isHomeGuest = () => {
    var isHome = routing(1, "") && !($("header").hasClass("usr-ssn"));
    return isHome;
};