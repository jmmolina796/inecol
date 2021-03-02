<?php

    try
    {   
        $peticion = $mysqli->query("CALL SP_verifyDeletePublicacionProyectos('".$id_publicacion_proyecto_docente."','".$url_proyecto."','".$id_usuario."','".$type."')");
       
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

       if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
                    
            while($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                $mensaje = $row["mensaje"];
                
            }
            $mensaje_valida_eliminar_publicaciones = true;
        }
        else
        {
                $mensaje_valida_eliminar_publicaciones = false;
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
    else if($mensaje_valida_eliminar_publicaciones === false )
    {
         
            $data = compact("mensaje_valida_eliminar_publicaciones");
    }
    else
    {

      $data = compact("mensaje","mensaje_valida_eliminar_publicaciones");
         
    }

