<?php

    try
    {
        $peticion = $mysqli->query("CALL SP_getDocentesEscuelas('".$clave."')"); 
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_docentes_escuelas = array();
            $i=0;

            while($row = $peticion->fetch_array(MYSQLI_NUM))
            {
                $informacion_docentes_escuelas[$i] = $row;
                $i++;

            }
            $mensaje_docentes_escuelas = true;
        }
        else
        {
            $mensaje_docentes_escuelas = false;
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
    else if($mensaje_docentes_escuelas)
    {
         $data = compact("informacion_docentes_escuelas",'mensaje_docentes_escuelas');
    }
    else
    {
         $data = compact("mensaje_docentes_escuelas");
    }