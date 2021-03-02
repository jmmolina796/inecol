import {
    defaultErrorAlert
} from '../shared/alert';

const validaFechasProyectosConvocatoria = () => {
    var error = false;

    var fechaInicioConvocatoria = "";
    var fechaFinConvocatoria = "";

    var vectorFechaInicioConvocatoria = [];
    var vectorFechaFinConvocatoria = [];

    vectorFechaInicioConvocatoria = $("#proyecto-fechaInicioInscripcion").val().split("/");
    vectorFechaFinConvocatoria = $("#proyecto-fechaFinInscripcion").val().split("/");

    fechaInicioConvocatoria = vectorFechaInicioConvocatoria[2] + "-" + vectorFechaInicioConvocatoria[1] + "-" + vectorFechaInicioConvocatoria[0];
    fechaFinConvocatoria = vectorFechaFinConvocatoria[2] + "-" + vectorFechaFinConvocatoria[1] + "-" + vectorFechaFinConvocatoria[0];

    if (fechaInicioConvocatoria >= fechaFinConvocatoria) {
        error = true;
        var title = "Fecha de inicio de convocatoria";
        var content = "La fecha de inicio de convocatoria no puede ser mayor o igual a la fecha final de convocatoria.";
        var element = $("#proyecto-fechaInicioInscripcion");
        defaultErrorAlert(title, content, element);
    }
    return error;
};

export default validaFechasProyectosConvocatoria;