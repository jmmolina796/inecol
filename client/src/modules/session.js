import {
    setCntSession
} from '../shared/menu';

import {
    goHome
} from '../helpers/urls';

import { requestJson } from '../api';

$("#content-user").on("click", "#closeSesion", function () {

    var link = "cerrar_sesion";
    var data = {
        comm: "req"
    };
    var callback = (data) => {
        localStorage.clear();
        goHome(true);
    };
    requestJson(link, data, callback);
});

$("#content-sesion, .btn-usr-mn").on("click", function () { //IMPORTANT TO ADD
    setCntSession();
});