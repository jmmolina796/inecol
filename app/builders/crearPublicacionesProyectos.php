<?php

    if($mensaje === true)
    {
        function crearContenidoMultimedia($fil,$informacion,$type)
        {
            $htmlFunction = "";
            if($fil == "img")
            {
                $urlFile = ($type == "1") ? URL_SERVER.URL_PUB_IMG : URL_SERVER.URL_PMOD_IMG;
                $htmlFunction .= "<div class='containerImagenesPublicacion' >";

                foreach ($informacion as $key => $value)
                {

                    list($id_foto_publicacion,$id_publicacion_proyecto_docente, $url_foto) = $informacion[$key];

                    $htmlFunction .= "<div class='fotoPublicacion' data-id-foto-publicacion='".$id_foto_publicacion."'>".
                                "<img src='".$urlFile.$url_foto."' class='imgPbMuro'>".
                                       "</div>";
                }
                $htmlFunction .= "</div>";

            }
            else if($fil == "fl")
            {
                $urlFile = ($type == "1") ? URL_SERVER.URL_PUB_FL : URL_SERVER.URL_PMOD_FL;
                $htmlFunction .= "<div class='containerArchivosPublicacion' >";

                foreach ($informacion as $key => $value)
                {

                    list($id_archivo_publicacion,$id_publicacion_proyecto_docente, $nombre_archivo,$url_archivo) = $informacion[$key];


                    $htmlFunction .= "<div class='archivoPublicacion' data-id-archivo-publicacion='".$id_archivo_publicacion."'>".
                                        "<p>".
                                            "<a href='".$urlFile.$url_archivo."' target='_blank'>".$nombre_archivo."</a>".
                                        "</p>".
                                     "</div>";
                }
                $htmlFunction .= "</div>";
            }
            else if($fil == "yb")
            {
                $htmlFunction .= "<div class='containerEnlacesYoutubePublicacion' >";

                foreach ($informacion as $key => $value)
                {

                    list($id_enlace_youtube_publicacion,$id_publicacion_proyecto_docente, $nombre_enlace_youtube) = $informacion[$key];

                    $htmlFunction .= "<div class='youtubePublicacion' data-id-enlace-youtube-publicacion='".$id_enlace_youtube_publicacion."' >".
                                    "<div class='cover-youtube'></div>".
                                    "<iframe allowfullscreen='allowfullscreen' mozallowfullscreen='mozallowfullscreen' msallowfullscreen='msallowfullscreen' oallowfullscreen='oallowfullscreen' webkitallowfullscreen='webkitallowfullscreen' src='".$nombre_enlace_youtube."'>".
                                            $nombre_enlace_youtube.
                                    "</iframe>".
                             "</div>";
                }
                $htmlFunction .= "</div>";
            }
            return $htmlFunction;
        }

        $contentHtml = "";

        foreach ($informacion as $key => $value)
        {
            list($id_proyecto, $id_rel_proyecto_docente, $id_publicacion_proyecto_docente, $nombre_docente, $ape_paterno_docente, $ape_materno_docente, $nombre_usuario, $imagen,$fecha_publicacion,$publicacion,$fecha_completa,$tiempo,$cantidad_videos,$cantidad_fotos,$cantidad_archivos ,$cantidad_comentarios, $cantidad_likes, $css_likes) = $informacion[$key];

            $publicacion = makeLinks($publicacion);

            $nombre_docente_iniciales = $nombre_docente." ".$ape_paterno_docente[0].". ".$ape_materno_docente[0].".";
            $nombre_docente_completo = $nombre_docente." ".$ape_paterno_docente." ".$ape_materno_docente;

            $propietario = ( isset($_SESSION["usuario"]) ? ($nombre_usuario == $_SESSION["usuario"]) : false );

            $time = explode("#", $tiempo);
            $horas = $time[0];
            $minutos = $time[1];
            $minutosFaltantes = 60;

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

            if($tipoBusqueda=='AllImagenes')
            {
                $cantidad_videos=0;
                $cantidad_archivos=0;
            }

            if($tipoBusqueda=='AllArchivos')
            {
                $cantidad_videos=0;
                $cantidad_fotos=0;
            }

            if($tipoBusqueda=='AllLinksYoutube')
            {
                $cantidad_archivos=0;
                $cantidad_fotos=0;
            }

            if($propietario === true)
            {
                $contentHtml .= "<div class='publicacion-proyecto publicacion-proyecto-gestion' data-tiempo-horas='".$horas."' data-tiempo-minutos-faltantes='".$minutosFaltantes."' data-tiempo-minutos='".$minutos."'  data-idp='".$id_publicacion_proyecto_docente."' data-fecha-completa='".$fecha_completa."' data-fecha-publicacion='".$fecha_publicacion."' >".
                                    $loader_section.
                                    "<div class='opcionesPublicacion'>".
                                        "<span class='editarPublicacion'></span>".
                                        "<span class='eliminarPublicacion'></span>".
                                    "</div>";
            }
            else
            {
                $contentHtml .= "<div class='publicacion-proyecto' data-tiempo-horas='".$horas."' data-tiempo-minutos-faltantes='".$minutosFaltantes."' data-tiempo-minutos='".$minutos."'  data-idp='".$id_publicacion_proyecto_docente."' data-fecha-completa='".$fecha_completa."' data-fecha-publicacion='".$fecha_publicacion."' >";
            }

            $contentHtml .= "<div class='headerPublicacion'>".
                                "<img src='".URL_SERVER.URL_DOC_IMG.$imagen."'>".
                                "<div class='nombreFechaPublicacion'>".
                                    "<p class='goToUrl'>".
                                        "<a href='".teacherProfileLink($nombre_usuario)."'>".$nombre_docente_iniciales."</a>".
                                        "<a href='".teacherProfileLink($nombre_usuario)."'>".$nombre_docente_completo."</a>".
                                    "</p>".
                                    "<p title='".$fecha_completa."'>".$fecha_publicacion."</p>".
                                "</div>".
                            "</div>".
                            "<div class='textoPublicacion'>".
                                "<p class='contenido-publicacion'>".$publicacion."</p>".
                            "</div>";

            if($cantidad_videos > 0 || $cantidad_archivos > 0 || $cantidad_fotos > 0)
            {
                $contentHtml .= builder("crearContenidoMultimediaPublicaciones",compact("id_publicacion_proyecto_docente","cantidad_videos","cantidad_archivos","cantidad_fotos","id_usuario","rol","type"));
            }


            $contentHtml .= "<div class='infoPublicacion'>".
                            $loader_section.
                                "<div class='infoContentPublicacion'>".
                                    "<span class='comentariosPub divPaginacionComentarios'><span class='comentariosPublicaciones'>".$cantidad_comentarios."</span></span>".
                                    "<span class='icon-likes likesPub ".$css_likes."'></span>".
                                    "<span class='likesPublicaciones'>".$cantidad_likes."</span>".
                                "</div>".
                            "</div>".
                            "<div class='contenedorComentariosPublicaciones'></div>";

            $contentHtml .=  "</div>";
        }
    }
