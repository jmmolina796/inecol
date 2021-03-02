import {
    defaultErrorAlert
} from '../shared/alert';

const validaFechasProyectos = () => {
    var error = false;

    var fechaInicio = "";
    var fechaFin = "";

    var vectorFechaInicio = [];
    var vectorFechaFin = [];

    vectorFechaInicio = $("#proyecto-fechaInicio").val().split("/");
    vectorFechaFin = $("#proyecto-fechaFin").val().split("/");

    fechaInicio = vectorFechaInicio[2] + "-" + vectorFechaInicio[1] + "-" + vectorFechaInicio[0];
    fechaFin = vectorFechaFin[2] + "-" + vectorFechaFin[1] + "-" + vectorFechaFin[0];

    if (fechaInicio >= fechaFin) {
        error = true;
        var title = "Fecha de inicio";
        var content = "La fecha de inicio no puede ser mayor o igual a la fecha de fin.";
        var element = $("#proyecto-fechaInicio");
        defaultErrorAlert(title, content, element);
    }
    return error;
};

export default validaFechasProyectos;