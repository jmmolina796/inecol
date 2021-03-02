<?php

	try
	{
        $mysqli->autocommit(false);  // empieza la transaccion 

		$peticion = $mysqli->query("CALL SP_updateCapacitaciones('".$id_capacitacion."','".$capacitacion_nombre."','".$capacitacion_descripcion."', '".$capacitacion_proyecto."')");

        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows))
		{
			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
                $mensaje = $row["mensaje"];
			}                   
			if($mensaje == "true")
			{
				$mensaje = true;
			}
			else if($mensaje == "false")
			{
				$mensaje = false;
			}
		}

        if ($mensaje === true) 
        {
            // Estas intrucciones son necesarias para poder hacer varias consultas a la vez en un modelo
            $mysqli->more_results();
            $mysqli->next_result();
            $mysqli->store_result();

            for($x=0;$x<sizeof($capacitacion_sesiones);$x++)
            {
                $peticion = $mysqli->query("CALL SP_insertRelCapacitacionesSesiones('".$id_capacitacion."','".$capacitacion_sesiones[$x]["cap_sesion_nombre"]."','".$capacitacion_sesiones[$x]["cap_sesion_descripcion"]."')");
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
            }
        }

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