const isThereCheckSelected = (accion) => {
    let seleccionado = "No";

    if (accion == "r") {
        $(".form-registrar-proyectos :checkbox").each(function () {
            if ($(this).is(':checked')) {
                seleccionado = "Si";
            }
        });
    }

    if (accion == "m") {
        $(".form-modificar-proyectos :checkbox").each(function () {
            if ($(this).is(':checked')) {
                seleccionado = "Si";
            }
        });
    }

    if (accion == "r2") {
        $(".form-registrar-modulos :checkbox").each(function () {
            if ($(this).is(':checked')) {
                seleccionado = "Si";
            }
        });
    }

    if (accion == "m2") {
        $(".form-modificar-modulos :checkbox").each(function () {
            if ($(this).is(':checked')) {
                seleccionado = "Si";
            }
        });
    }
    return seleccionado;
};

export default isThereCheckSelected;