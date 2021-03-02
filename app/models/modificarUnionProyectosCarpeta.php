<?php

	try
	{

		if($joinProyects=="1")
        {
            $mysqli->autocommit(false);  // empieza la transaccion 
            
        }


	 	$peticion = $mysqli->query("CALL SP_updateNombreCarpeta(".$id_carpeta.",'".$nombre_carpeta."')");
	    if(!$peticion)
	    {
	        throw new Exception($mysqli->error);
	    }


		if($joinProyects=="1")
        {

			for($x=0;$x<sizeof($array_ids_proyectos);$x++)
	        {

	        	$id_proyecto = $array_ids_proyectos[$x]["id_proyecto"];

	            $peticion = $mysqli->query("CALL SP_updateUnionProyectosCarpeta(".$id_proyecto.",".$id_carpeta.")");
	            if(!$peticion)
	            {
	                throw new Exception($mysqli->error);
	            }		

	        }

    	}


        if($joinProyects=="1")
        {
            
            $mysqli->commit();  // si en la transaccion no hubo ningun error se ejetuca el commit        
            
        }

        $mensaje_update_carpetas = true;
       
	}
	catch(Exception $e) 
    {
        $error = "@%@#".$e->getMessage();

        if($joinProyects=="1")
        {
            $mysqli->rollback();  // si hubo error en la trasacion se ejecuta el rolback       
        }
	}
	
	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else
    {
         $data = compact("mensaje_update_carpetas");
    }






