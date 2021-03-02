<?php 

    if($mensaje === true)
    {
        $contentHtml = "";
        $onlyOne = false;
        for($x=0;$x<count($informacion);$x++)
        {
            list($id_rel_modulo_docente, $id_modulo, $url_rel_modulo, $rel_estatus_docente, $rel_estatus_modulo, $nombre_usuario, $nombre_modulo, $descripcion, $imagen_portada, $url_modulo, $estatus_modulo, $nombre_ciclo_escolar, $nombre_escuela, $nombre_grado, $nombre_grupo) = $informacion[$x];

            if($x == 0 || $informacion[$x - 1][1] != $id_modulo)
            {
                if(!isset($informacion[$x+1]) || $informacion[$x + 1][1] != $id_modulo)
                {
                    $onlyOne = true; 
                }
                else
                {
                    $onlyOne = false;
                }

                if($onlyOne)
                {
                    $contentHtml .= "<article class='misModulos slctPrtMuro goToUrl'>".
                                        "<a class='no-style' href='".userModuleLink($url_rel_modulo)."'>";
                }
                else
                {
                    $contentHtml .= "<article class='misModulos slctPrtMuro'>";
                }

                $contentHtml .=     "<h2 title='".$nombre_modulo."' >".$nombre_modulo."</h2>".
                                    "<div class='descripcion'>".$descripcion."</div>".
                                    "<div class='imagen'>".
                                        "<div class='fondo'></div>".
                                        "<img src='".URL_SERVER.URL_MOD_IMG.$imagen_portada."'>".
                                    "</div>";
                if(!$onlyOne)
                {
                    //$onlyOne = false;
                    $contentHtml .= "<div class='misModulos infMisMuros'>".
                                        "<span class='returnModuloDocenteRelacionados rtnDocRelMuro'></span>".
                                        "<p>Está participando en este modulo con estas escuelas:</p>".
                                        "<table class='tableDocentesModulosRelacionados tblDocRelMuro'>".
                                            "<thead>
                                                <tr>".
                                                    "<th>Escuela</th>".
                                                    "<th>Grado</th>".
                                                    "<th>Grupo</th>".
                                                "</tr>".
                                            "</thead>".
                                            "<tbody>".
                                                "<tr class='goToUrl'>".
                                                    "<td><a class='no-style' href='".userModuleLink($url_rel_modulo)."'>$nombre_escuela</a></td>".
                                                    "<td><a class='no-style' href='".userModuleLink($url_rel_modulo)."'>$nombre_grado</a></td>".
                                                    "<td><a class='no-style' href='".userModuleLink($url_rel_modulo)."'>$nombre_grupo</a></td>".
                                                "</tr>";
                }
            }
            else if($informacion[$x - 1][1] == $id_modulo)
            {
            	$contentHtml .= "<tr class='goToUrl'>".
                                    "<td><a class='no-style' href='".userModuleLink($url_rel_modulo)."'>$nombre_escuela</a></td>".
                                    "<td><a class='no-style' href='".userModuleLink($url_rel_modulo)."'>$nombre_grado</a></td>".
                                    "<td><a class='no-style' href='".userModuleLink($url_rel_modulo)."'>$nombre_grupo</a></td>".
                                "</tr>";
            }
        
            if( ($x + 1 == count($informacion) || $informacion[$x + 1][1] != $id_modulo))
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