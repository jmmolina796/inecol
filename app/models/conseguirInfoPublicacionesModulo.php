<?php

    try
    {
        
        $peticion = $mysqli->query("CALL SP_getInfoPublicacionesModulo('".$urlModulo."','".$id_publicacion_modulo_docente."','".$condicion."','".$ordenamiento."',".$limit1.",".$limit2.",'".$tipoBusqueda."',".$id_usuario.",'".$rol."')");
        
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_publicaciones_modulos = array();
            $i=0;

                while($row = $peticion->fetch_array(MYSQLI_BOTH))
                {
                    $informacion_publicaciones_modulos[$i] = $row;
                    $i++;

                }
                $mensaje_publicaciones_modulos = true;
        }
        else
        {
            $mensaje_publicaciones_modulos = false;
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
    else if($mensaje_publicaciones_modulos)
    {
         $data = compact("informacion_publicaciones_modulos",'mensaje_publicaciones_modulos');
    }
    else
    {
         $data = compact("mensaje_publicaciones_modulos");
    }

