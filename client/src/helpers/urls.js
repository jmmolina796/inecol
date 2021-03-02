import {
    URL_GLOBAL
} from '../constants';

import {
    goToUrl
} from './routing';

export const setUrlLocal = () => localStorage.URL = window.location.href;

export const getUrlLocal = () => localStorage.URL;

export const routing = (number, name, only) => {
    var path = window.location.pathname.split("/");
    var flag = false;

    if (only === true) {
        if (path[number] == name && path[number + 1] === undefined) {
            flag = true;
        }
    } else {
        if (path[number] == name) {
            flag = true;
        }
    }

    return flag;
};

export const routingName = (link, number, name) => {
    var path = link.split("/");
    if (path[number + 2] == name && path[number + 3] === undefined) {
        return true;
    }
    return false;
};

export const getRoutingName = (link, number) => {
    var path = link.split("/");
    var result = {};

    result.name = path[number + 2];
    result.last = false;

    if (path[number + 3] === undefined) {
        result.last = true;
    }

    return result;
};

export const getURLAfter = (number) => {
    var url = window.location.href;
    var url = url.split("/");
    number = number + 1;
    var tama = url.length;
    var urlAfter = "";

    for (var x = number; x < tama; x++) {
        if (x + 1 == tama) {
            urlAfter += url[x];
        } else {
            urlAfter += url[x] + "/";
        }
    }
    return urlAfter;
};

export const getURLWall = () => {
    var url = window.location.href;
    url = url.split("/");
    var tama = url.length;
    var urlProyecto = url[tama - 1];

    return urlProyecto;
};

export const getURLToken = () => {
    var url = window.location.href;
    url = url.split("/");
    var tama = url.length;
    var urlToken = url[tama - 1];

    return urlToken;
};

export const getNameFile = (link) => {
    var url = link;
    url = url.split("/");
    var tama = url.length;
    var urlToken = url[tama - 1];

    return urlToken;
};

export const getTypeMuro = () => {
    var type = $(".ptdDcMuro").prop("tftx");
    return type;
};

export const goHome = (type) => {
    if (type === true) {
        window.location = URL_GLOBAL;
    } else {
        goToUrl(URL_GLOBAL);
    }
};

export const getUrlImage = (url) => {
    var posImg = url.lastIndexOf("/") + 1;
    url = url.substring(posImg, url.length);

    return url;
};