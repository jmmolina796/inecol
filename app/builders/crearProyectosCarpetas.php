<?php 

    if($mensaje === true)
    {
        $contentHtml = "";
        for($x=0;$x<count($informacion);$x++)
        {
            list($id_proyecto, $nombre_proyecto, $fecha_inicio_inscripcion, $fecha_fin_inscripcion, $fecha_inicio, $fecha_fin, $nombre_ciclo_escolar, $nombre_administrador, $fecha_creacion, $descripcion, $imagen_portada, $numero_participantes, $link, $estatus) = $informacion[$x];

            $contentHtml .= "<article class='misProyectos slctPrtMuro'>".
                                "<h2 title='".$nombre_proyecto."'><a href='".projectLink($link)."'>".$nombre_proyecto."</a></h2>".
                                "<div class='descripcion'>".$descripcion."</div>".
                                "<div class='imagen'>".
                                    "<div class='fondo'></div>".
                                    "<img src='".URL_SERVER.URL_PRO_IMG.$imagen_portada."'>".
                                "</div>".
                            "</article>";
        }
    }