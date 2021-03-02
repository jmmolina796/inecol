import {
    URL_GLOBAL
} from '../constants';

import {
    closeMessage
} from '../shared/message';

import {
    isHeaderUser
} from '../shared/functions';

import {
    isJson
} from '../helpers/jsonValidate';

import {
    openAlert
} from '../shared/alert';

const requestView = (link, data, callback) => {
    closeMessage();
    if (isHeaderUser()) {
        if (localStorage.USR_SESS === undefined) {
            data.USR_SESS = "@UNDEFINED";
        } else {
            data.USR_SESS = $(".usr-ssn").data().USR_SESS;
        }
    }
    $.ajax({
        type: "POST",
        url: link,
        data: data,

        retryCount: 0,
        retryLimit: 10,
        timeout: 10000,
        retryTimeout: 10000,
        created: Date.now(),

        success: (data) => {
            debugger;
            const info = isJson(data);
            if (info[0] == false) {
                callback(data);
            } else {
                if (info[1].rdirUsrSessUrl == "@accessRequired") {
                    $(".btn-sesion").trigger("click");
                } else {
                    const functionAceptar = () => setTimeout(() => {
                        window.location = URL_GLOBAL + info[1].rdirUsrSessUrl;
                    }, 100);

                    openAlert(info[1].titlRdir, info[1].messRdir, "message", "Aceptar", "none", functionAceptar);
                }
            }
        },
        error: (xhr, exception, thrownError) => {
            this.retryCount++;
            if (this.retryCount <= this.retryLimit && Date.now() - this.created < this.retryTimeout) {
                $.ajax(this);
                return;
            }

            messageError(xhr, exception, thrownError, title, content);
        }
    });
};

export default requestView;