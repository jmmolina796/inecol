<?php 

    if($mensaje === true)
    {
        $contentHtml = "<table class='tblDocRelMuro'>";

        $contentHtml .= "<thead><tr>".
                    "<th>Escuela</th>".
                    "<th>Grado</th>".
                    "<th>Grupo</th>".
                "</tr></thead><tbody>";

        for($x=0;$x<count($informacion);$x++)
        {
            list($id_docente, $id_proyecto, $nombre_docente, $ape_paterno, $ape_materno, $nombre_usuario, $nombre_escuela, $grado, $grupo, $url) = $informacion[$x];


            if($element == "p")
            {
                $contentHtml .= "<tr class='goToUrl'>".
                            "<td><a class='no-style' href='".userProjectLink($url)."'>$nombre_escuela</a></td>".
                            "<td><a class='no-style' href='".userProjectLink($url)."'>$grado</a></td>".
                            "<td><a class='no-style' href='".userProjectLink($url)."'>$grupo</a></td>".
                        "</tr>";
            }
            else if($element == "m")
            {
               $contentHtml .= "<tr class='goToUrl'>".
                            "<td><a class='no-style' href='".userModuleLink($url)."'>$nombre_escuela</a></td>".
                            "<td><a class='no-style' href='".userModuleLink($url)."'>$grado</a></td>".
                            "<td><a class='no-style' href='".userModuleLink($url)."'>$grupo</a></td>".
                        "</tr>"; 
            }
        }
    }

    $contentHtml .= "</tbody></table>";