const changeColorPrincipalNodes = (c1, c2, c3) => {
    var colorBody = $("body").css("background-color");
    var color = c1 + ", " + c2 + ", " + c3;
    if (colorBody.substring(0, colorBody.lastIndexOf(",")) != "rgba(" + color) {
        c1 = parseInt(c1);
        c2 = parseInt(c2);
        c3 = parseInt(c3);

        var fontColor = "#FFF";
        var flag = 0;

        flag += (c1 > 200) ? 1 : 0;
        flag += (c2 > 200) ? 1 : 0;
        flag += (c3 > 200) ? 1 : 0;

        var avg = (c1 + c2 + c3) / 3;

        if (avg >= 232) {
            defaultColorPrincipalNodes();
            return;
        }

        if (flag < 2) {
            if (avg >= 160) {
                fontColor = "#000";
            }
        } else {
            fontColor = "#000";
        }

        $("body").css("background-color", "rgba(" + color + ",0.5)");
        $("header section, #busqueda, #iconHide span").css("background-color", "rgba(" + color + ",0.3)");
        $("footer").css("background-color", "rgba(" + color + ",1)");
        $("#contenedorItemsBusqueda").css("box-shadow", "10px 10px 10px rgba(" + color + ",0.7)");
    }
};

export default changeColorPrincipalNodes;