<?php

    try
    {
        $peticion = $mysqli->query("CALL SP_getComentario('".$url_proyecto."','".$id_publicacion."','".$id_comentario_publicacion."','".$rol."','".$type."')");

        $mensaje_comentario_publicacion = false;

        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            if($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                if(!isset($row["mensaje"]))
                {
                    $informacion_comentario_publicacion = array();
                    $i=0;
                    $informacion_comentario_publicacion[$i] = $row;
                    
                    $mensaje_comentario_publicacion = true;
                }
            }
        }
        else
        {
            $mensaje_comentario_publicacion = false;
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
    else if($mensaje_comentario_publicacion)
    {
        $data =  compact("mensaje_comentario_publicacion","informacion_comentario_publicacion");
    }
    else
    {
         $data = compact("mensaje_comentario_publicacion");
    }