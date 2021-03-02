let contadorTiempo = 0;
let contadorTiempoComentarios = 0;

export const cambiarTiempoPublicaciones = () => {
    setInterval(function () {

        var id_publicacion = [];
        var index = -1;

        contadorTiempo += .5;
        /* si hay un elemento div hijo del contenedor div contendorPublicacionesProyectos que contenga el attributo data-tiempo-minutos = M
           	entonces guarda su id de publicacion en el arreglo id_publicacion solo aplica a los comentarios que
           	tienen en su contenido hace 2 minutos
   		*/
        $("#contendorPublicacionesProyectos > div[data-tiempo-minutos='M']").each(() => {
            index++;
            id_publicacion[index] = [{
                "id_publicacion": $(this).attr("data-idp")
            }, ];
        });

        /*
   			si hay elementos que su el valor de su atributo data-tiempo-minutos-faltantes = 20 con el contadorTiempo declarado
   			arriba se guarda su attributo data-idp  que es el que contiene su id de publicacion, en el arreglo id_publicacion
   			solo aplica para comentarios que tengan en su attributo  data-tiempo-minutos-faltantes = 20 (osea un numero)
           */
        $("#contendorPublicacionesProyectos > div[data-tiempo-minutos-faltantes='" + contadorTiempo + "']").each(() => {
            index++;
            id_publicacion[index] = [{
                "id_publicacion": $(this).attr("data-idp")
            }, ];
        });

        if (index > -1) {

            var link = "actualizarTiempoPublicacion";
            var data = {
                comm: "req",
                id_publicacion: id_publicacion
            };
            var callback = (info) => {
                for (var x = 0; x < info.informacion_tiempo_publicaciones.length; x++) {
                    // hace referencia al elemento que contenga el id_publicacion = 3 y lo guarda en la variable elemento
                    var elemento = $(".publicacion-proyecto[data-idp='" + info.informacion_tiempo_publicaciones[x][0] + "']");
                    // si la hora que trae de la base de datos es diferente a la hora que ya tiene entonces
                    // le pone la hora que que trae de la base de datos
                    if (elemento.attr("data-fecha-publicacion") != info.informacion_tiempo_publicaciones[x][1]) {
                        // si el elemento que fue referenciado el cual viene en la variable elemento
                        // tiene el atributo data-tiempo-minutos con valor de M entonces a ese se le coloca la nueva hora
                        // esto solo aplica para los comentarios que tienen como hora minutos
                        if (elemento.attr("data-tiempo-minutos") == "M") {
                            // le pone la nueva fecha en minutos al elemento de la publicacion
                            elemento.find("p").eq(1).text(info.informacion_tiempo_publicaciones[x][1]);

                            // le pone la nueva fecha en minutos al atributo del elemento referenciado
                            elemento.attr("data-fecha-publicacion", info.informacion_tiempo_publicaciones[x][1]);

                            var horas = parseInt(info.informacion_tiempo_publicaciones[x][2]);
                            var minutos = parseInt(info.informacion_tiempo_publicaciones[x][3]);
                            if (horas > 0) {
                                elemento.attr("data-tiempo-minutos", "0");
                                var minutos_faltantes = 60 - minutos + contadorTiempo;
                                elemento.attr("data-tiempo-minutos-faltantes", minutos_faltantes);
                            }
                        } else {
                            //         0        1        2    3
                            // array ["3","Hace 30 min","0","30"]
                            var horas = parseInt(info.informacion_tiempo_publicaciones[x][2]);
                            var minutos = parseInt(info.informacion_tiempo_publicaciones[x][3]);
                            var minutos_faltantes;

                            elemento.find("p").eq(1).text(info.informacion_tiempo_publicaciones[x][1]);
                            elemento.attr("data-fecha-publicacion", info.informacion_tiempo_publicaciones[x][1]);

                            if (horas >= 24 && horas < 48) {

                                var calculos1 = (48 - horas) * 60;
                                minutos_faltantes = calculos1 + contadorTiempo - minutos;
                            } else if (horas >= 48) {
                                minutos_faltantes = "S/N";
                            } else {
                                minutos_faltantes = 60 - minutos + contadorTiempo;
                            }

                            elemento.attr("data-tiempo-minutos-faltantes", minutos_faltantes);
                        }
                    }
                }
            };
            ajaxJson(link, data, callback);
        }

        // cambiar fecha comentarios

        //cambiarTiempoComentarios();

        var id_comentario = [];
        var index2 = -1;

        contadorTiempoComentarios += .5;
        /* si hay un elemento div hijo del contenedor div contendorPublicacionesProyectos que contenga el attributo data-tiempo-minutos = M
           	entonces guarda su id de publicacion en el arreglo id_publicacion solo aplica a los comentarios que
           	tienen en su contenido hace 2 minutos
   		*/
        $(".contenedorComentariosPublicaciones > div[data-tiempo-minutos='M']").each(() => {
            index2++;
            id_comentario[index2] = [{
                "id_comentario": $(this).attr("data-idc")
            }, ];
        });

        /*
   			si hay elementos que su el valor de su atributo data-tiempo-minutos-faltantes = 20 con el contadorTiempo declarado
   			arriba se guarda su attributo data-idp  que es el que contiene su id de publicacion, en el arreglo id_publicacion
   			solo aplica para comentarios que tengan en su attributo  data-tiempo-minutos-faltantes = 20 (osea un numero)
           */
        $(".contenedorComentariosPublicaciones > div[data-tiempo-minutos-faltantes='" + contadorTiempoComentarios + "']").each(() => {
            index2++;
            id_comentario[index2] = [{
                "id_comentario": $(this).attr("data-idc")
            }, ];
        });

        if (index2 > -1) {
            var link = "actualizarTiempoComentarios";
            var data = {
                comm: "req",
                id_comentario: id_comentario
            };
            var callback = (info) => {
                for (var x = 0; x < info.informacion_tiempo_comentarios.length; x++) {
                    // hace referencia al elemento que contenga el id_comentario = 3 y lo guarda en la variable elemento
                    var elemento = $(".comentarioPublicado[data-idc='" + info.informacion_tiempo_comentarios[x][0] + "']");
                    // si la hora que trae de la base de datos es diferente a la hora que ya tiene entonces
                    // le pone la hora que que trae de la base de datos
                    if (elemento.attr("data-fecha-publicacion") != info.informacion_tiempo_comentarios[x][1]) {
                        // si el elemento que fue referenciado el cual viene en la variable elemento
                        // tiene el atributo data-tiempo-minutos con valor de M entonces a ese se le coloca la nueva hora
                        // esto solo aplica para los comentarios que tienen como hora minutos
                        if (elemento.attr("data-tiempo-minutos") == "M") {
                            // le pone la nueva fecha en minutos al elemento de la publicacion
                            elemento.find("p").eq(1).text(info.informacion_tiempo_comentarios[x][1]);

                            // le pone la nueva fecha en minutos al atributo del elemento referenciado
                            elemento.attr("data-fecha-publicacion", info.informacion_tiempo_comentarios[x][1]);

                            var horas = parseInt(info.informacion_tiempo_comentarios[x][2]);
                            var minutos = parseInt(info.informacion_tiempo_comentarios[x][3]);
                            if (horas > 0) {
                                elemento.attr("data-tiempo-minutos", "0");

                                var minutos_faltantes = 60 - minutos + contadorTiempoComentarios;

                                elemento.attr("data-tiempo-minutos-faltantes", minutos_faltantes);
                            }
                        } else {
                            var horas = parseInt(info.informacion_tiempo_comentarios[x][2]);
                            var minutos = parseInt(info.informacion_tiempo_comentarios[x][3]);
                            var minutos_faltantes;

                            elemento.find("p").eq(1).text(info.informacion_tiempo_comentarios[x][1]);
                            elemento.attr("data-fecha-publicacion", info.informacion_tiempo_comentarios[x][1]);

                            if (horas >= 24 && horas < 48) {

                                var calculos1 = (48 - horas) * 60;
                                minutos_faltantes = calculos1 + contadorTiempoComentarios - minutos;
                            } else if (horas >= 48) {
                                minutos_faltantes = "S/N";
                            } else {
                                minutos_faltantes = 60 - minutos + contadorTiempoComentarios;
                            }

                            elemento.attr("data-tiempo-minutos-faltantes", minutos_faltantes);
                        }
                    }
                }
            };
            ajaxJson(link, data, callback);
        }
    }, 30000);
};