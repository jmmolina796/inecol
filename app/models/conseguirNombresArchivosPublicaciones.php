<?php

    try
    
    {   
        $peticion = $mysqli->query("CALL SP_getNombresArchivosPublicaciones('".$id_publicacion_proyecto_docente."','".$type."')");  

        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {

            $informacion_nombres_files_publicaciones = array();
            $i=0;

                while($row = $peticion->fetch_array(MYSQLI_NUM))
                {
                    $informacion_nombres_files_publicaciones[$i] = $row;
                    $i++;

                }
                $mensaje_nombres_files_publicaciones = true;
        }
        else
        {
                $mensaje_nombres_files_publicaciones = false;
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
    else if($mensaje_nombres_files_publicaciones === false )
    {
         
            $data = compact("mensaje_nombres_files_publicaciones");
    }
    else
    {

      $data = compact("informacion_nombres_files_publicaciones","mensaje_nombres_files_publicaciones");
         
    }

