<?php

    try
    {
        $peticion = $mysqli->query("CALL SP_getEscuelasUsuarios('".$numero_docentes."','".$tipo."')"); 
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_escuelas_usuarios = array();
            $i=0;

            while($row = $peticion->fetch_array(MYSQLI_NUM))
            {
                $informacion_escuelas_usuarios[$i] = $row;
                $i++;

            }
            $mensaje_escuelas_usuarios = true;
        }
        else
        {
            $mensaje_escuelas_usuarios = false;
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
    else if($mensaje_escuelas_usuarios)
    {
         $data = compact("informacion_escuelas_usuarios",'mensaje_escuelas_usuarios');
    }
    else
    {
         $data = compact("mensaje_escuelas_usuarios");
    }