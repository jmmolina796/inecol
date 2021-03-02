<?php

    try
    {
        
            $peticion = $mysqli->query("CALL SP_getInfoArchivosPublicaciones('".$id_publicacion_proyecto_docente."','".$type."')");     

        
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_archivos_publicaciones = array();
            $i=0;

                while($row = $peticion->fetch_array(MYSQLI_NUM))
                {
                    $informacion_archivos_publicaciones[$i] = $row;
                    $i++;

                }
                $mensaje_archivos_publicaciones = true;
        }
        else
        {
                $mensaje_archivos_publicaciones = false;
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
    else if($mensaje_archivos_publicaciones)
    {
         $data = compact("informacion_archivos_publicaciones",'mensaje_archivos_publicaciones');
    }
    else
    {
         $data = compact("mensaje_archivos_publicaciones");
    }

