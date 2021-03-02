export const setMenu = () => {
    if ($("#menu-pc-sesion").length > 0) {
        $("#menu-pc-sesion").toggleClass("open");
    } else {
        $("#menu-pc").toggleClass("open");
    }
};

export const closeMenu = () => $("#menu-pc-sesion").removeClass("open");

export const setCntSession = () => $("#content-user").addClass("open");

export const closeCntSession = () => $("#content-user").removeClass("open");