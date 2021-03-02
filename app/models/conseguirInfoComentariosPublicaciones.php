<?php

    try
    {
        $peticion = $mysqli->query("CALL SP_getInfoComentariosPublicaciones('".$url."','".$id_publicacion_proyecto_docente."','".$limit1."','".$limit2."','".$type."')");

        $mensaje_comentarios_publicaciones = false;

        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_comentarios_publicaciones = array();
            $i=0;
            while($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                if(isset($row["mensaje"]))
                {
                    break;
                }

                $informacion_comentarios_publicaciones[$i] = $row;
                $i++;
                $mensaje_comentarios_publicaciones = true;
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
    else if($mensaje_comentarios_publicaciones === false )
    {
        $data = compact("mensaje_comentarios_publicaciones");
    }
    else
    {
        $data = compact("informacion_comentarios_publicaciones","mensaje_comentarios_publicaciones");
    }
