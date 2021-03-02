import {
    getUrlImage
} from '../helpers/urls';

import {
    requestJson
} from './';

const deleteImage = (url, type, callback) => {
    debugger;
    url = getUrlImage(url);
    var link = "existeUrlMultimedia";
    var data = {
        comm: "req",
        url: url,
        type: type
    };
    requestJson(link, data, callback);
};

export default deleteImage;