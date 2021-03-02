<?php

    try
    {
        $peticion = $mysqli->query("CALL SP_getInfoEscuelasDocente(".$id_docente.")"); 
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_escuelas_docentes = array();
            $i=0;

            while($row = $peticion->fetch_array(MYSQLI_NUM))
            {
                $informacion_escuelas_docentes[$i] = $row;
                $i++;

            }
            $mensaje_escuelas_docentes = true;
        }
        else
        {
            $mensaje_escuelas_docentes = false;
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
    else if($mensaje_escuelas_docentes)
    {
         $data = compact("informacion_escuelas_docentes",'mensaje_escuelas_docentes');
    }
    else
    {
         $data = compact("mensaje_escuelas_docentes");
    }