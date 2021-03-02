<?php

    try
    {   
        $peticion = $mysqli->query("CALL SP_updateComentarioPublicacion('".$id_comentario_publicacion."','".$comentario_publicacion."','".$rol."','".$type."')");     
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            if($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                $id_comentario_publicacion = $row["id_comentario_publicacion"];
                $id_publicacion_proyecto_docente = $row["id_publicacion_proyecto_docente"];
                $comentario_publicacion = $row["comentario_publicacion"];
                $tiempo_comentario = $row["fecha_publicacion"];
                $nombre = $row["nombre"];
                $ape_paterno = $row["ape_paterno"];
                $ape_materno = $row["ape_materno"];
                $imagen = $row["imagen"];
                $id_usuario = $row["id_usuario"];
                $rol = $row["rol"];
                $fecha_comentario = $row["fecha_comentario"];
                $nombre_usuario = $row["nombre_usuario"];
                $fecha_completa = $row["fecha_completa"];
                $tiempo = $row["tiempo"];

            }
                $mensaje_comentarios_mod_publicaciones = true;
        }
        else
        {
            $mensaje_comentarios_mod_publicaciones = false;
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
    else if($mensaje_comentarios_mod_publicaciones)
    {
        $data =  compact("mensaje_comentarios_mod_publicaciones","id_comentario_publicacion","id_publicacion_proyecto_docente","comentario_publicacion","tiempo_comentario", "fecha_comentario","nombre","ape_paterno","ape_materno","imagen","id_usuario","rol","fecha_comentario","nombre_usuario","fecha_completa","tiempo");
    }
    else
    {
         $data = compact("mensaje_comentarios_mod_publicaciones");
    }