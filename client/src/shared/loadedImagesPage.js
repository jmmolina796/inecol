import velocity from 'velocity-animate';

// // import defaultColorPrincipalNodes from './defaultColorPrincipalNodes';
// // import changeColorPrincipalNodes from './changeColorPrincipalNodes';

import {
    routing,
} from '../helpers/urls';

const loadedImagesPage = () => {
    const $body = $("body")
    velocity($body, "stop"); //Detener el bucle
    if ((routing(1, "docentes") || (routing(1, "administradores")) || (routing(1, "asesores"))) && !(routing(3, "proyectos") || routing(3, "modulos"))) {
        var arr = $("#portada-usuario-img").attr("data-color");
        if (arr != "default") {
            arr = arr.split(",");
            // changeColorPrincipalNodes(arr[0], arr[1], arr[2]);
            $(".tipo-usuario .contenido, .mensaje, .portada-usuario img, .perfil-informacion .infoUsuario-header").css("border-color", "rgba(" + arr + ",0.5)");
        } else {
            // defaultColorPrincipalNodes();
        }
    } else if (routing(1, "alianzas-y-proyectos")) {
        $("body").css("background-color", "#252827");
    } else if (routing(1, "configuracion")) {
        var arr = $("#imagen-configuracion-img").attr("data-color");
        if (arr != "default") {
            arr = arr.split(",");
            // changeColorPrincipalNodes(arr[0], arr[1], arr[2]);
        } else {
            // defaultColorPrincipalNodes();
        }
    } else if (routing(1, "modulos") || routing(1, "proyectos") || routing(1, "modulos-participantes") || routing(1, "proyectos-participantes")) {
        var arr = $("#bckPtdMuro-img").attr("data-color");
        if (arr != "default") {
            arr = arr.split(",");
            // changeColorPrincipalNodes(arr[0], arr[1], arr[2]);
        } else {
            // defaultColorPrincipalNodes();
        }
    } else {
        // defaultColorPrincipalNodes();
    }
};

export default loadedImagesPage;