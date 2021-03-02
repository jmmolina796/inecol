const defaultColorPrincipalNodes = () => {
    var colorBody = $("body").css("background-color");
    if (colorBody != "#e8e8e8" && colorBody != "rgb(232, 232, 232)") {
        $("body").css("background-color", "rgb(232,232,232)");
        $("header section, #busqueda, #iconHide span").css("background-color", "rgb(68,68,68)");
        $("footer").css({
            "background-color": "rgb(221,79,36)",
            "color": "#FFF"
        });
        $("#contenedorItemsBusqueda").css("box-shadow", "10px 10px 10px #ccc");
    }
};

export default defaultColorPrincipalNodes;