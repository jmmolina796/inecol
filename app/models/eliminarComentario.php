<?php

    try
    {                                                                                                                                   
        $peticion = $mysqli->query("CALL SP_deleteComentariosPublicacion('".$id_comentario_publicacion."','".$type."')");  
       
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        $mensaje_eliminar_comentarios = true;       
    }
    catch(Exception $e) 
    {
        $error = "@%@#".$e->getMessage();
    }

    if(isset($error))
    {
       $data = compact("error");

    }
    else
    {

      $data = compact("mensaje_eliminar_comentarios");
         
    }

