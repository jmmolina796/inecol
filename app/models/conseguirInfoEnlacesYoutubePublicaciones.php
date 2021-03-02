<?php

    try
    {
        
        $peticion = $mysqli->query("CALL SP_getInfoEnlacesYoutubePublicaciones('".$id_publicacion_proyecto_docente."','".$type."')");    
        
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_enlaces_youtube_publicaciones = array();
            $i=0;

                while($row = $peticion->fetch_array(MYSQLI_NUM))
                {
                    $informacion_enlaces_youtube_publicaciones[$i] = $row;
                    $i++;

                }
                $mensaje_enlaces_youtube_publicaciones = true;
        }
        else
        {
                $mensaje_enlaces_youtube_publicaciones = false;
        }
    }
    catch(Exception $e) 
    {
        $error = "@%@#".$e->getMessage();
    }

    if(isset($error))
    {
       $data = compact("error");

    }
    else if($mensaje_enlaces_youtube_publicaciones)
    {
         $data = compact("informacion_enlaces_youtube_publicaciones",'mensaje_enlaces_youtube_publicaciones');
    }
    else
    {
         $data = compact("mensaje_enlaces_youtube_publicaciones");
    }

