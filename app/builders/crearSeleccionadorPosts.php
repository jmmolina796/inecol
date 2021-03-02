<?php 

    if($mensaje === true)
    {
        $contentHtml = "";
        for($x=0;$x<count($informacion);$x++)
        {
            list($id_proyecto, $nombre_proyecto, $fecha_inicio_inscripcion, $fecha_fin_inscripcion, $fecha_inicio, $fecha_fin, $nombre_ciclo_escolar, $nombre_administrador, $fecha_creacion, $descripcion, $imagen_portada, $numero_participantes, $link, $estatus) = $informacion[$x];
            $contentHtml .= "<article class='selectorProyecto slctPrtMuro'>".
                    "<h2 title='".$nombre_proyecto."'>".$nombre_proyecto."</h2>".
                    "<div class='descripcion'>".$descripcion."</div>".
                    "<div class='imagen'>".
                        "<div class='fondo'></div>".
                        "<img src='".URL_SERVER.URL_PRO_IMG.$imagen_portada."'>".
                    "</div>".
                    "<div class='botones'>".
                        "<div class='mt-button-magenta ver-proyecto goToUrl'><a href='".projectLink($link)."'>Ver más</a></div>".
                        "<div class='mt-button-magenta unirse-proyecto' data-IdProyecto='".$id_proyecto."' >Unirse</div>".
                    "</div>".
                    "<div class='informacion'>".
                        "<div class='participantes'>".
                            "<p>Participantes</p>".
                            "<span>".$numero_participantes."</span>".
                        "</div>".
                        "<div class='convocatoria'>".
                            "<p>Fecha de registro</p>".
                            "<span>".$fecha_inicio_inscripcion." - ".$fecha_fin_inscripcion."</span>".
                        "</div>".
                    "</div>".
                "</article>";
        }
    }