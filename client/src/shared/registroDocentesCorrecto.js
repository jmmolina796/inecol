import {
    routing,
    goHome,
} from '../helpers/urls';

import {
    openAlert
} from '../shared/alert';

import {
    openMessage
} from '../shared/message';

const registroDocentesCorrecto = (mensaje) => {
    /*var link = "continua_sesion";
    var data = {comm:"req"};
    var callback = function(info)
    {*/
    if (routing(1, "registro-docentes")) {
        var functionAceptar = recargar;
        var title = "Registro"
        var message = "Te has registrado con éxito a PASEVIC. Ya puedes iniciar sesión para poder compartir tu aprendizaje y experiencias con el mundo.";
        openAlert(title, message, "message", "Aceptar", "none", functionAceptar);

        function recargar() {
            goHome();
        }
    } else {
        $("#menu-pc-sesion li[data-file*='formDocentes']").trigger("click");
        openMessage("#5cb85c", "#FFF", mensaje);
    }
    /*};
    requestJson(link,data,callback);*/
};

export default registroDocentesCorrecto;