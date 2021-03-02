<?php

    try
    {   
        $peticion = $mysqli->query("CALL SP_getCantidadComentariosPublicacion('".$id_publicacion_proyecto_docente."','".$type."')");  
        
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            while($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                $cantidad_comentarios_publicacion = $row["cantidad_comentarios_publicacion"];
                
            }
            $mensaje_cantidad_comentarios_publicaciones = true;
        }
        else
        {
                $mensaje_cantidad_comentarios_publicaciones = false;
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
    else if($mensaje_cantidad_comentarios_publicaciones === false )
    {
         
            $data = compact("mensaje_cantidad_comentarios_publicaciones");
    }
    else
    {
        

      $data = compact("cantidad_comentarios_publicacion","mensaje_cantidad_comentarios_publicaciones");
         
    }

