<?php 

    if($mensaje === true)
    {
        $contentHtml = "";
        for($x=0;$x<count($informacion);$x++)
        {
            list($id_modulo, $nombre_modulo, $nombre_administrador, $fecha_creacion, $descripcion, $imagen_portada, $numero_participantes, $link, $estatus) = $informacion[$x];
            $contentHtml .= "<article class='selectorModulo slctPrtMuro'>".
                    "<h2 title='".$nombre_modulo."'>".$nombre_modulo."</h2>".
                    "<div class='descripcion'>".$descripcion."</div>".
                    "<div class='imagen'>".
                        "<div class='fondo'></div>".
                        "<img src='".URL_SERVER.URL_MOD_IMG.$imagen_portada."'>".
                    "</div>".
                    "<div class='botones'>".
                        "<div class='mt-button-magenta ver-modulo goToUrl'><a href='".moduleLink($link)."'>Ver más</a></div>".
                        "<div class='mt-button-magenta unirse-modulo' data-IdModulo='".$id_modulo."' >Participar</div>".
                    "</div>".
                    "<div class='informacion'>".
                        "<div class='participantes'>".
                            "<p>Participantes</p>".
                            "<span>".$numero_participantes."</span>".
                        "</div>".
                    "</div>".
                "</article>";
        }
    }