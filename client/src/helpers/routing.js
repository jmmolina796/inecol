import requestView from '../api/requestView';
import loadedImagesPage from '../shared/loadedImagesPage';
import configurationLoad from '../shared/configurationLoad';
import scrollDownChats from '../shared/scrollDownChats';

import {
    getRoutingName,
    getUrlLocal,
    routing,
    setUrlLocal,
    getURLAfter,
} from '../helpers/urls';

import {
    loadingContent
} from '../shared/contentLoaders';

import loadFilesMenu from '../shared/loadFilesMenu';

export const isSavedInLocalSotragePosition = () => localStorage.pos !== undefined;

export const isSavedInLocalStorage = () => localStorage.file !== undefined;

export const loadSavedInLocalStorage = () => {
    const link = localStorage.file;
    localStorage.removeItem("file");
    loadingContent();
    var data = {
        comm: "async"
    };
    var callback = (data) => {
        $("#webContent").html(data);
        loadFilesMenu();
        loadedImagesPage();
        configurationLoad();
    };
    requestView(link, data, callback);
};

//SOLO LOS SYNC, ya que los ASYNC no recargan.

export const goToUrl = (url, aux) => {
    aux = aux || "";

    window.history.pushState(null, null, url);
    if (isSavedInLocalStorage()) {
        loadSavedInLocalStorage();
        document.title = "PASEVIC";
    } else {
        var lastUrl = getRoutingName(getUrlLocal(), 1);
        var auxChatFlag = false;
        var data = {
            comm: "sync",
            "ldfl": true
        };

        /* Loader */
        if (routing(1, "mensajes") && getURLAfter(3) != "") //Chat
        {
            if (lastUrl.name != "mensajes") {
                auxChatFlag = true;
                data = {
                    comm: "sync",
                    "ldfl": true,
                    "auxChat": auxChatFlag
                }; //mensajesUsuario - Controller
            }
            $(".mensajes").addClass("loading");
        } else if (!(routing(1, "proyectos") && getURLAfter(3) != "" && aux == "changedCicloEscolar")) //CUALQUIERA MENOS Proyectos ciclo
        {
            $("#load-bar").show();
        }
        /* Loader */

        var link = window.location.href;
        var callback = (data) => {
            setUrlLocal(); //Set url in local storage

            var html = $(data);
            document.title = html.eq(0).text();

            if (routing(1, "mensajes") && getURLAfter(3) != "" && !auxChatFlag) {
                $(".contenedor-chats .mensajesContent").html(html.eq(html.length - 1).html());
                $(".mensajes").removeClass("loading");
                $(".contenedor-chats").removeClass("onlyChats").addClass("onlyMensajes");
            } else {
                $("#webContent").html(html.eq(html.length - 1).html());
                if (isSavedInLocalSotragePosition()) {
                    $(localStorage.pos).velocity("scroll", 0);
                    localStorage.removeItem("pos");
                } else {
                    window.scrollTo(0, 0);
                }
                loadedImagesPage();
                configurationLoad();
                if ($(".mt-form").length > 0) {
                    $.mtStart();
                }
            }

            if (routing(1, "proyectos") && getURLAfter(3) != "" && aux == "changedCicloEscolar") //Proyectos ciclo
            {
                $(".loader-section").hide();
                return;
            }

            $("#load-bar").hide();
            scrollDownChats();

        }
        requestView(link, data, callback);
    }
};