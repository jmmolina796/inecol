<?php

    try
    {
        $peticion = $mysqli->query("CALL SP_insertComentariosPublicaciones('".$url."','".$id_publicacion_proyecto_docente."','".$comentario."',".$id_usuario.",'".$rol."','".$type."')");

        $mensaje_comentarios_publicaciones = false;

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
                    $informacion_comentarios_publicaciones = array();
                    $i=0;
                    $informacion_comentarios_publicaciones[$i] = $row;
                    
                    $mensaje_comentarios_publicaciones = true;
                }
            }
        }
        else
        {
            $mensaje_comentarios_publicaciones = false;
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
    else if($mensaje_comentarios_publicaciones)
    {
        $data =  compact("mensaje_comentarios_publicaciones","informacion_comentarios_publicaciones");
    }
    else
    {
         $data = compact("mensaje_comentarios_publicaciones");
    }