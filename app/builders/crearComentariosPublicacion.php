<?php

    $contentHtml ="";

    if(isSessionStarted() && $campoComentario == true)
    {
        $contentHtml .= "<div class='contenedorPublicarComentario'>".
                            "<img src='".$imagen_usuario."'/>".
                            "<textarea placeholder='Escribe un comentario' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false'></textarea>".
                            "<div>".
                                "<div class='btnComentar mt-button-blue'>Comentar</div>".
                            "</div>".
                        "</div>";
    }

    if($informacion != "")
    {
        foreach ($informacion as $key => $value)
        {
            list($id_comentario_publicacion,$id_publicacion_proyecto_docente, $comentario_publicacion,$tiempo_comentario,$nombre,$ape_paterno,$ape_materno,$imagen,$id_usuario,$rol,$fecha_comentario,$nombre_usuario,$fecha_publicacion,$fecha_completa,$tiempo) = $informacion[$key];

            $comentario_publicacion = makeLinks($comentario_publicacion);

            $nombre_iniciales = $nombre." ".$ape_paterno[0].". ".$ape_materno[0].".";
            $nombre_completo = $nombre." ".$ape_paterno." ".$ape_materno;

            $time = explode("#", $tiempo);
            $horas = $time[0];
            $minutos = $time[1];
            $minutosFaltantes = 60 - intval($time[1]);

            $perfilLink = "";


            if($horas >= 24 && $horas < 48)
            {

                $calculos1 = (48-$horas)*60;

                $minutosFaltantes = $calculos1-$minutos;
            }
            else
            {
                if($horas >= 48)
                {
                    $minutosFaltantes = "S/N";
                }
            }

            if(isAdministrator($rol))
            {
                $perfilLink = administratorProfileLink($nombre_usuario);
                $imagenCom = URL_SERVER.URL_ADM_IMG.$imagen;
            }
            else if(isAdviser($rol))
            {
                $perfilLink = adviserProfileLink($nombre_usuario);
                $imagenCom = URL_SERVER.URL_ADM_IMG.$imagen;
            }
            else if(isTeacher($rol))
            {
                $perfilLink = teacherProfileLink($nombre_usuario);
                $imagenCom = URL_SERVER.URL_DOC_IMG.$imagen;
            }
            else if(isRoot($rol))
            {
                $imagenCom = URL_SERVER.URL_ADM_IMG.$imagen;
            }

            $contentHtml .= "<div class='comentarioPublicado' data-idc='".$id_comentario_publicacion."' data-tiempo-horas='".$horas."' data-tiempo-minutos-faltantes='".$minutosFaltantes."' data-tiempo-minutos='".$minutos."'  data-idp='".$id_publicacion_proyecto_docente."' data-fecha-completa='".$fecha_completa."' data-fecha-publicacion='".$fecha_publicacion."' >".
                                    "<div>".
                                        "<img src='".$imagenCom."'>".
                                        "<p class='goToUrl'>".
                                            "<a class='nombreIniciales' href='".$perfilLink."'>".$nombre_iniciales."</a>".
                                            "<a class='nombreCompleto' href='".$perfilLink."'>".$nombre_completo."</a>".
                                        "</p>".
                                        "<p>".$tiempo_comentario."</p>".
                                    "</div>".
                                    "<div class='divComentarioPublicado'>".$comentario_publicacion."</div>";

            if( isSessionStarted() && ($nombre_usuario == $_SESSION["usuario"]) )
            {
                $contentHtml .=     "<div class='opcionesComentario'>".
                                        "<span class='editarComentario'></span>".
                                        "<span class='eliminarComentario'></span>".
                                    "</div>";
            }

            $contentHtml .= "</div>";
        }
        if($cargarComentarios == true && $cantidad_comentarios_publicacion > 0)
        {
            $loader_section = builder("loader-section");

            $contentHtml .= "<div class='lblContenedorPaginacionComentarios'>".
                                $loader_section.
                                "<div class='dvPgncn divPaginacionComentarios'>".
                                    "<div class='cntDiPag'>Cargar más".
                                        "<span> + ".$cantidad_comentarios_publicacion."</span>".
                                "</div>".
                            "</div>";
        }
    }
