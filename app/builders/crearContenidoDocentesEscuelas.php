<?php 

    if($mensaje === true)
    {
        $contentHtml = "";
        for($x=0;$x<count($informacion);$x++)
        {
            list($id_docente, $nombre_docente, $ape_paterno, $ape_materno, $nombre_usuario, $imagen) = $informacion[$x];

            $nombre_iniciales = $nombre_docente." ".$ape_paterno[0].". ".$ape_materno[0].".";

            $contentHtml .= "<figure class='goToUrl'>".
                    "<a href='".teacherProfileLink($nombre_usuario)."'>".
                        "<img src = '".URL_SERVER.URL_DOC_IMG.$imagen."' >".
                        "<figcaption class='nombre-iniciales'>$nombre_iniciales</figcaption>".
                        "<figcaption class='nombre-completo'>$nombre_docente $ape_paterno $ape_materno</figcaption>".
                    "</a>".
                "</figure>";
    
        }
    }