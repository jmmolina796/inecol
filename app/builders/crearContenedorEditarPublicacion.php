<?php

    if($mensaje === true)
    {

        function crearContenidoMultimediaEditar($fil,$informacion,$type)
        {
            $htmlFunction = "";
            if($fil == "img")
            {
                $urlFile = ($type == "1") ? URL_SERVER.URL_PUB_IMG : URL_SERVER.URL_PMOD_IMG;
                foreach ($informacion as $key => $value) 
                {
                    list($id_foto_publicacion,$id_publicacion_proyecto_docente, $url_foto) = $informacion[$key];
                    
                    $htmlFunction .= "<div class='imagenPost'>
                                        <span data-db=''>X</span>
                                        <img src='".$urlFile.$url_foto."' />
                                    </div>";
                }
            }
            else if($fil == "fl")
            {
                $urlFile = ($type == "1") ? URL_SERVER.URL_PUB_FL : URL_SERVER.URL_PMOD_FL;
                foreach ($informacion as $key => $value) 
                {

                    list($id_archivo_publicacion,$id_publicacion_proyecto_docente, $nombre_archivo,$url_archivo) = $informacion[$key];

                    
                    $htmlFunction .= "<div class='archivoPost'>".
                                        "<p>".
                                            "<span data-link='".$urlFile.$url_archivo."'>X</span>".
                                           "<span>".$nombre_archivo."</span>".
                                        "</p>".
                                   "</div>";
                }
            }
            else if($fil == "yb")
            {
                foreach ($informacion as $key => $value) 
                {

                    list($id_enlace_youtube_publicacion,$id_publicacion_proyecto_docente, $nombre_enlace_youtube) = $informacion[$key];

                    
                    $htmlFunction .= "<div class='linkPost' data-idLink='".$id_enlace_youtube_publicacion."'>".
                                        "<span>X</span>".
                                        "<div class='youtubePublicacion' data-id-enlace-youtube-publicacion='".$id_enlace_youtube_publicacion."' >".
                                            "<iframe allowfullscreen='allowfullscreen' mozallowfullscreen='mozallowfullscreen' msallowfullscreen='msallowfullscreen' oallowfullscreen='oallowfullscreen' webkitallowfullscreen='webkitallowfullscreen' src='".$nombre_enlace_youtube."'>".
                                                    $nombre_enlace_youtube.
                                            "</iframe>".
                                        "</div>".
                                    "</div>";
                }
            }
            return $htmlFunction;
        }

        function crearImagenesEditar($cantidad, $informacion, $type)
        {
            $htmlFunction = "<div class='imagenesPublicacion'".( ($cantidad > 0) ? ("style='display:block'")  : ("") ).">".
                                "<div class='contenedorImagenesPost'>";

            if($cantidad > 0)
            {
                $htmlFunction .= crearContenidoMultimediaEditar("img",$informacion,$type);
            }

            $htmlFunction .=    "</div>".
                                "<div class='botonesImagenesPost'>".
                                    "<div class='agregarImagenPost'>Agregar imagen</div>".
                                    "<div class='eliminarImagenPost'>Eliminar</div>".
                                "</div>".
                            "</div>";
            return $htmlFunction;
        }

        function crearArchivosEditar($cantidad, $informacion, $type)
        {
            $htmlFunction = "<div class='archivosPublicacion'".( ($cantidad > 0) ? ("style='display:block'")  : ("") ).">".
                                "<div class='contenedorArchivosPost'>";

            if($cantidad > 0)
            {
                $htmlFunction .= crearContenidoMultimediaEditar("fl",$informacion,$type);
            }

            $htmlFunction .=    "</div>".
                                "<div class='botonesArchivosPost'>".
                                    "<div class='agregarArchivoPost'>Agregar archivo</div>".
                                    "<div class='eliminarArchivoPost'>Eliminar</div>".
                                "</div>".
                            "</div>";
            return $htmlFunction;
        }

        function crearYoutubeEditar($cantidad, $informacion, $type)
        {
            $htmlFunction = "<div class='linksPublicacion'".( ($cantidad > 0) ? ("style='display:block'")  : ("") ).">".
                               "<div class='contenedorLinksPost'>";
           
           if($cantidad > 0)
           {
               $htmlFunction .= crearContenidoMultimediaEditar("yb",$informacion,$type);
           }

            $htmlFunction .=    "</div>".
                               "<div class='botonesLinksPost'>".
                                    "<div class='agregarLinkPost'>Agregar video</div>".
                                    "<div class='eliminarLinkPost'>Eliminar</div>".
                                "</div>".
                            "</div>";
            return $htmlFunction;
        }

        $contentHtml = "";
        
        foreach ($informacion as $key => $value) 
        {
            list($id_publicacion_proyecto_docente, $publicacion, $cantidad_videos, $cantidad_imagenes, $cantidad_archivos) = $informacion[$key];
            
            $contentHtml .= "<div class='textoPost'>".
                                "<textarea class='mensajePost' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false'>".$publicacion."</textarea>".
                                "<div class='labelMensajePost' style='display:none'>Escribe la nueva publicación</div>".
                            "</div>";

            if($cantidad_videos > 0 || $cantidad_archivos > 0 || $cantidad_imagenes > 0)
            {

                $contentHtml .= builder("crearContenidoEditarMultimedia",compact("id_publicacion_proyecto_docente","cantidad_videos","cantidad_archivos","cantidad_imagenes","type"));
            }
            else
            {
                $contentHtml .= crearImagenesEditar($cantidad_imagenes,"",$type);
                $contentHtml .= crearArchivosEditar($cantidad_archivos,"",$type);
                $contentHtml .= crearYoutubeEditar($cantidad_videos,"",$type);
            }
        }
    }