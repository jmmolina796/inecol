import {
    defaultErrorAlert
} from '../shared/alert';

const validaFechasConvocatoriasEInicioYFinProyectos = () => {
    var error = false;

    var fechaInicio = "";
    var fechaFin = "";

    var vectorFechaInicio = [];
    var vectorFechaFin = [];

    vectorFechaInicio = $("#proyecto-fechaInicio").val().split("/");
    vectorFechaFin = $("#proyecto-fechaFin").val().split("/");

    fechaInicio = vectorFechaInicio[2] + "-" + vectorFechaInicio[1] + "-" + vectorFechaInicio[0];
    fechaFin = vectorFechaFin[2] + "-" + vectorFechaFin[1] + "-" + vectorFechaFin[0];

    var fechaInicioConvocatoria = "";
    var fechaFinConvocatoria = "";

    var vectorFechaInicioConvocatoria = [];
    var vectorFechaFinConvocatoria = [];

    vectorFechaInicioConvocatoria = $("#proyecto-fechaInicioInscripcion").val().split("/");
    vectorFechaFinConvocatoria = $("#proyecto-fechaFinInscripcion").val().split("/");

    fechaInicioConvocatoria = vectorFechaInicioConvocatoria[2] + "-" + vectorFechaInicioConvocatoria[1] + "-" + vectorFechaInicioConvocatoria[0];
    fechaFinConvocatoria = vectorFechaFinConvocatoria[2] + "-" + vectorFechaFinConvocatoria[1] + "-" + vectorFechaFinConvocatoria[0];

    if (fechaInicioConvocatoria > fechaFin) {
        error = true;
        var title = "Fecha de inicio";
        var content = "La fecha de inicio de convocatoria no puede ser mayor a la fecha de fin.";
        var element = $("#proyecto-fechaInicioInscripcion");
        defaultErrorAlert(title, content, element);
    } else {

        if (fechaFinConvocatoria > fechaFin) {
            error = true;
            var title = "Fecha de fin de convocatoria";
            var content = "La fecha de fin de convocatoria no puede ser mayor a la fecha de fin.";
            var element = $("#proyecto-fechaFinInscripcion");
            defaultErrorAlert(title, content, element);
        }

    }
    return error;
};

export default validaFechasConvocatoriasEInicioYFinProyectos;