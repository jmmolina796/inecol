<?php

    try
    {   
        $peticion = $mysqli->query("CALL SP_verifyComentariosPublicacion('".$id_comentario_publicacion."','".$id_publicacion."','".$url_proyecto."','".$id_usuario."','".$rol."','".$type."')");  

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
            $mensaje_verificar_comentarios = true;
        }
        else
        {
            $mensaje_verificar_comentarios = false;
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
    else if($mensaje_verificar_comentarios === false )
    { 
        $data = compact("mensaje_verificar_comentarios");
    }
    else
    {

      $data = compact("mensaje","mensaje_verificar_comentarios");
         
    }

