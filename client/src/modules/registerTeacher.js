import entidadesMunicipios from '../eventCreators/entidadesMunicipios';

import {
    requestJson,
} from '../api';

import {
    loadingPage,
    loadedPage,
} from '../shared/contentLoaders';

import {
    openMessage
} from '../shared/message';

import {
    goHome
} from '../helpers/urls';

$("#webContent").on("click", "#btnIngresarLlave", function () {
    var error = $(this).mtValidate();
    if (error == false) {
        var clave = $(".form-ingresar-llave #ingresar-llave").val();
        var link = "verificarLlave";
        var data = {
            comm: "dbs",
            llave: clave
        };
        loadingPage();
        var callback = function (info) {
            loadedPage();
            if (info.mensaje == true) {
                location.reload(true);
            } else if (info.mensaje == false) {
                openMessage("#F00", "#FFF", info.resultado);
                $(".form-ingresar-llave #ingresar-llave").val("");
            } else {
                openMessage("#F00", "#FFF", info.resultado);
                $(".form-ingresar-llave #ingresar-llave").val("");
            }

        };
        requestJson(link, data, callback);
    }
});

$("#webContent").one("mousedown", ".docente-sl_aux", function () {
    entidadesMunicipios("#slEntidad", "#slMunicipio");
    $(this).removeClass("docente-sl_aux");
});


$("#webContent").on("click", ".btnRegresarHome", function () {
    goHome();
});