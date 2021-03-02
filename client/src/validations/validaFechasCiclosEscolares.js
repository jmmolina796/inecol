import {
    defaultErrorAlert
} from '../shared/alert';

const validaFechasCiclosEscolares = () => {
    var error = false;

    var fechaInicio = "";
    var fechaFin = "";

    var vectorFechaInicio = [];
    var vectorFechaFin = [];

    vectorFechaInicio = $("#ciclo-fechaInicio").val().split("/");
    vectorFechaFin = $("#ciclo-fechaFin").val().split("/");

    fechaInicio = vectorFechaInicio[2] + "-" + vectorFechaInicio[1] + "-" + vectorFechaInicio[0];
    fechaFin = vectorFechaFin[2] + "-" + vectorFechaFin[1] + "-" + vectorFechaFin[0];

    if (fechaInicio >= fechaFin) {
        error = true;
        var title = "Fecha de inicio";
        var content = "La fecha de inicio no puede ser mayor o igual a la fecha de fin.";
        var element = $("#proyecto-fechaInicioInscripcion");
        defaultErrorAlert(title, content, element);
    }
    return error;
};

export default validaFechasCiclosEscolares;