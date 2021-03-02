const addClassAdministration = (nameTable, type) => {
    if (type == "0") {
        if (nameTable.find("tbody td").length == 1) {
            $(".contenedorTabla").addClass("noActive");
        }

        if ($(".contenedorTabla").hasClass("noInactive")) {
            $(".contenedorTabla").removeClass("noInactive");
        }
    } else {
        if (nameTable.find("tbody td").length == 1) {
            $(".contenedorTabla").addClass("noInactive");
        }

        if ($(".contenedorTabla").hasClass("noActive")) {
            $(".contenedorTabla").removeClass("noActive");
        }
    }
};

export default addClassAdministration;