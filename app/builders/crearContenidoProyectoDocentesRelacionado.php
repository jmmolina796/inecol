<?php 

    if($mensaje === true)
    {
        $contentHtml = "";
        for($x=0;$x<count($informacion);$x++)
        {
            list($id_proyecto, $id_docente, $nombre_docente, $ape_paterno, $ape_materno, $imagen, $nombre_usuario, $url) = $informacion[$x];

            $nombre_iniciales = $nombre_docente." ".$ape_paterno[0].". ".$ape_materno[0].".";

            if(!empty($url))
            {
                $contentHtml .= "<figure class='goToUrl'>".
                        "<a href='".userProjectLink($url)."'>".
                            "<img src = '".URL_SERVER.URL_DOC_IMG.$imagen."' >".
                            "<figcaption class='nombre-iniciales'>$nombre_iniciales</figcaption>".
                            "<figcaption class='nombre-completo'>$nombre_docente $ape_paterno $ape_materno</figcaption>".
                        "</a>".
                    "</figure>";
            }
            else
            {
                $contentHtml .= "<figure data-docente='".$id_docente."'>".
                        "<img src = '".URL_SERVER.URL_DOC_IMG.$imagen."' >".
                        "<figcaption class='nombre-iniciales'>$nombre_iniciales</figcaption>".
                        "<figcaption class='nombre-completo'>$nombre_docente $ape_paterno $ape_materno</figcaption>".
                    "</figure>";
                
            }
        }
    }