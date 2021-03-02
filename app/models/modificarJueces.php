<?php

    try
    {

        $mysqli->autocommit(false);  // empieza la transaccion 

        $peticion = $mysqli->query("CALL SP_updateJueces('".$id_juez."','".$nombre."','".$ape_paterno."','".$ape_materno."','".$email."','".$passwordNew."','".$nombre_usuario."','".$telefono."','".$imagen."','".$id_ciclo_escolar."','".$color."')");

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

        if ($mensaje === true) {
            // Estas intrucciones son necesarias para poder hacer varias consultas a la vez en un modelo
            
            $mysqli->more_results();
            $mysqli->next_result();
            $mysqli->store_result();
    
            for($x=0;$x<sizeof($proyectos_calificar);$x++)
            {
                $peticion = $mysqli->query("CALL SP_insertRelJuecesProyectos('".$id_juez."','".$proyectos_calificar[$x]."','".$id_ciclo_escolar."')");
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