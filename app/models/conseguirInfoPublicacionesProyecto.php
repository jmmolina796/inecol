<?php

    try
    {
        $peticion = $mysqli->query("CALL SP_getInfoPublicacionesProyecto('".$urlProyecto."','".$id_publicacion_proyecto_docente."','".$condicion."','".$ordenamiento."','".$limit1."','".$limit2."','".$tipoBusqueda."','".$id_usuario."','".$rol."')");
        
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_publicaciones_proyectos = array();
            $i=0;

                while($row = $peticion->fetch_array(MYSQLI_BOTH))
                {
                    $informacion_publicaciones_proyectos[$i] = $row;
                    $i++;

                }
                $mensaje_publicaciones_proyectos = true;
        }
        else
        {
            $mensaje_publicaciones_proyectos = false;
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
    else if($mensaje_publicaciones_proyectos)
    {
         $data = compact("informacion_publicaciones_proyectos",'mensaje_publicaciones_proyectos');
    }
    else
    {
         $data = compact("mensaje_publicaciones_proyectos");
    }

