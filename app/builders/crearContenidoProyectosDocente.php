<?php 

    if($mensaje === true)
    {
        $contentHtml = "";
        $onlyOne = false;
        for($x=0;$x<count($informacion);$x++)
        {
            list($id_rel_proyecto_docente, $id_proyecto, $url_rel_proyecto, $rel_estatus_docente, $rel_estatus_proyecto, $nombre_usuario, $nombre_proyecto, $descripcion, $imagen_portada, $url_proyecto, $estatus_proyecto, $nombre_ciclo_escolar, $nombre_escuela, $nombre_grado, $nombre_grupo) = $informacion[$x];

            if($x == 0 || $informacion[$x - 1][1] != $id_proyecto)
            {
                if(!isset($informacion[$x+1]) || $informacion[$x + 1][1] != $id_proyecto)
                {
                    $onlyOne = true; 
                }
                else
                {
                    $onlyOne = false;
                }

                if($onlyOne)
                {
                    $contentHtml .= "<article class='misProyectos slctPrtMuro goToUrl'>".
                                        "<a class='no-style' href='".userProjectLink($url_rel_proyecto)."'>";
                }
                else
                {
                    $contentHtml .= "<article class='misProyectos slctPrtMuro'>";
                }

                $contentHtml .=     "<h2 title='".$nombre_proyecto."' >".$nombre_proyecto."</h2>".
                                    /*"<h2 title='".$nombre_proyecto."' class='goToUrl'><a class='no-style' href='".projectLink($url_proyecto)."'>".$nombre_proyecto."</a></h2>".*/
                                    "<div class='descripcion'>".$descripcion."</div>".
                                    "<div class='imagen'>".
                                        "<div class='fondo'></div>".
                                        "<img src='".URL_SERVER.URL_PRO_IMG.$imagen_portada."'>".
                                    "</div>";
                if(!$onlyOne)
                {
                    //$onlyOne = false;
                    $contentHtml .= "<div class='infoMisProyectos infMisMuros'>".
                                        "<span class='returnProyectoDocenteRelacionados rtnDocRelMuro'></span>".
                                        "<p>Está participando en este proyecto con estas escuelas:</p>".
                                        "<table class='tableDocentesProyectosRelacionados tblDocRelMuro'>".
                                            "<thead>
                                                <tr>".
                                                    "<th>Escuela</th>".
                                                    "<th>Grado</th>".
                                                    "<th>Grupo</th>".
                                                "</tr>".
                                            "</thead>".
                                            "<tbody>".
                                                "<tr class='goToUrl'>".
                                                    "<td><a class='no-style' href='".userProjectLink($url_rel_proyecto)."'>$nombre_escuela</a></td>".
                                                    "<td><a class='no-style' href='".userProjectLink($url_rel_proyecto)."'>$nombre_grado</a></td>".
                                                    "<td><a class='no-style' href='".userProjectLink($url_rel_proyecto)."'>$nombre_grupo</a></td>".
                                                "</tr>";
                }
            }
            else if($informacion[$x - 1][1] == $id_proyecto)
            {
            	$contentHtml .= "<tr class='goToUrl'>".
                                    "<td><a class='no-style' href='".userProjectLink($url_rel_proyecto)."'>$nombre_escuela</a></td>".
                                    "<td><a class='no-style' href='".userProjectLink($url_rel_proyecto)."'>$nombre_grado</a></td>".
                                    "<td><a class='no-style' href='".userProjectLink($url_rel_proyecto)."'>$nombre_grupo</a></td>".
                                "</tr>";
            }
        
            if( ($x + 1 == count($informacion) || $informacion[$x + 1][1] != $id_proyecto))
            {
                if(!$onlyOne)
                {
                	$contentHtml .= "</tbody></table></div>".
                	               "</article>";
                }
                else
                {
                    $contentHtml .= "</a></article>";   
                }

            }
        }
    }