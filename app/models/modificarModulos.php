<?php

	try
	{

        $mysqli->autocommit(false);  // empieza la transaccion 

        $peticion = $mysqli->query("CALL SP_updateModulos('".$id_modulo."','".$nombre."','".$descripcion."','".$imagen_portada."','".$color."')");

        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        for($x=0;$x<sizeof($grados);$x++)
        {
            $id_grado = $grados[$x]["grado"];
            $peticion = $mysqli->query("CALL SP_insertRelGradosModulos('".$id_modulo."','".$id_grado."')");
            if(!$peticion)
            {
                throw new Exception($mysqli->error);
            }
        }
	                
        $mensaje = true;
        
        $mysqli->commit();  // si en la transaccion no hubo ningun error se ejetuca el commit
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
        $mysqli->rollback();  // si hubo error en la trasacion se ejecuta el rolback
	}

	if(isset($error))
	{
		$data = compact("error");
    }
    else if(isset($mensaje))
    {
        $data = compact("mensaje");
	}