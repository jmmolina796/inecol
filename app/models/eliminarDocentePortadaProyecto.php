<?php

    try
    
    {                                                                                                                                   
        $peticion = $mysqli->query("CALL SP_deleteDocentePortadaProyecto('".$id_rel_proyecto_docente."','".$type."')");  
       
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

            $mensaje_eliminar_portada_proyecto = true;       
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

      $data = compact("mensaje_eliminar_portada_proyecto");
         
    }

