<?php

    try
    {   
        $peticion = $mysqli->query("CALL SP_getInfoImagenesPublicaciones('".$id_publicacion_proyecto_docente."','".$type."')");     
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_imagenes_publicaciones = array();
            $i=0;

                while($row = $peticion->fetch_array(MYSQLI_NUM))
                {
                    $informacion_imagenes_publicaciones[$i] = $row;
                    $i++;

                }
                $mensaje_imagenes_publicaciones = true;
        }
        else
        {
                $mensaje_imagenes_publicaciones = false;
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
    else if($mensaje_imagenes_publicaciones)
    {
         $data = compact("informacion_imagenes_publicaciones",'mensaje_imagenes_publicaciones');
    }
    else
    {
         $data = compact("mensaje_imagenes_publicaciones");
    }

