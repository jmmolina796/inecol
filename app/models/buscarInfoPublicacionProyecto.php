<?php

    try
    {
        $peticion = $mysqli->query("CALL SP_getInfoPublicacionProyecto('".$url_proyecto."','".$id_publicacion_proyecto_docente."','".$id_usuario."','".$type."')");     
   
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_publicacion_proyecto = array();
            $i=0;

                while($row = $peticion->fetch_array(MYSQLI_BOTH))
                {
                    $informacion_publicacion_proyecto[$i] = $row;
                    $i++;

                }
                $mensaje_publicacion_proyecto = true;
        }
        else
        {
            $mensaje_publicacion_proyecto = false;
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
    else if($mensaje_publicacion_proyecto)
    {
         $data = compact("informacion_publicacion_proyecto",'mensaje_publicacion_proyecto');
    }
    else
    {
         $data = compact("mensaje_publicacion_proyecto");
    }

