import {
    URL_GLOBAL
} from '../constants';

import {
   isHeaderUser 
} from '../shared/functions';

import {
    openMessage
} from '../shared/message';

import {
    openAlert
} from '../shared/alert';

import {
    loadedPage
} from '../shared/contentLoaders';

const requestJson = (link, data, callback) => {
    if (isHeaderUser()) {

        if (typeof (data) == "string") {
            if (localStorage.USR_SESS === undefined) {
                data += "&USR_SESS=@UNDEFINED";
            } else {
                data += "&USR_SESS=" + ($(".usr-ssn").data().USR_SESS);
            }
        } else {
            if (localStorage.USR_SESS === undefined) {
                data.USR_SESS = "@UNDEFINED";
            } else {
                data.USR_SESS = $(".usr-ssn").data().USR_SESS;
            }
        }
    }
    $.ajax({
        url: link,
        type: "POST",
        data: data,

        retryCount: 0,
        retryLimit: 10,
        timeout: 10000,
        retryTimeout: 10000,
        created: Date.now(),

        success: (data) => {
            debugger;
            try {
                const info = JSON.parse(data);
                if ((info.rdirUsrSessUrl === undefined)) {
                    callback(info);
                } else {
                    if (info.rdirUsrSessUrl == "@accessRequired") {
                        $(".btn-sesion").trigger("click");
                    } else {
                        const functionAceptar = () => setTimeout(() => {
                            window.location = URL_GLOBAL + info.rdirUsrSessUrl;
                        }, 100);

                        openAlert(info.titlRdir, info.messRdir, "message", "Aceptar", "none", functionAceptar);
                    }
                }
            } catch (err) {
                loadedPage();
                openMessage("#F00", "#FFF", "Error de conexión.");
            }
        },
        error: (xhr, ajaxOptions, thrownError) => {
            debugger;
            this.retryCount++;
            if (this.retryCount <= this.retryLimit && Date.now() - this.created < this.retryTimeout) {
                $.ajax(this);
                return;
            }

            requestError(xhr, ajaxOptions, thrownError);
        }
    });
};

export default requestJson;