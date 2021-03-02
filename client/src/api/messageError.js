import {
    defaultErrorAlert
} from '../shared/alert';

const messageError = (xhr, exception, thrownError, title = "Error con la conexión", content = "Parece que ha ocurrido un error de conexión.") => {
    if (xhr.status === 0) {
        title = "Error con la conexión";
        content = "Parece que ha ocurrido un error de conexión. Comprube si está conectado a internet y inténtalo de nuevo en un momento.";
    } else if (xhr.status == 404) {
        title = "Error";
        content = "No se ha encontrado lo que buscas.";
    } else if (xhr.status == 500) {
        title = "Error del servidor";
        content = "Parece que ha ocurrido un error en el servidor. Inténtalo de nuevo en un momento.";
    } else if (exception === 'parsererror') {
        title = "Requested JSON parse failed";
        content = "Requested JSON parse failed.";
    } else if (exception === 'timeout') {
        title = "Error";
        content = "Parece que el servidor está tardando mucho en responder, inténtalo de nuevo en un momento";
    } else if (exception === 'abort') {
        title = "Error";
        content = "Parece que ha ocurrido un error. Inténtalo de nuevo en un momento.";
    }

    const functionReload = () => window.location.reload(true);

    defaultErrorAlert(title, content, "none", functionReload);
};

export default messageError;