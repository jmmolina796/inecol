<?php

	try
	{
        $mysqli->autocommit(false);  // empieza la transaccion 

		$peticion = $mysqli->query("CALL SP_insertJueces('".$nombre."','".$ape_paterno."','".$ape_materno."','".$email."','".$password."','".$nombre_usuario."','".$telefono."','".$imagen."','".$color."')");

        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows))
        {

            if($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                $id_juez = $row["id_juez"]; // Revisar cuando ya existe el email y el nombre de usuario.                                     
            }

            // Estas intrucciones son necesarias para poder hacer varias consultas a la vez en un modelo
            $mysqli->more_results();
            $mysqli->next_result();
            $mysqli->store_result();

            for($x=0;$x<sizeof($proyectos_calificar);$x++)
            {
                $peticion = $mysqli->query("CALL SP_insertRelJuecesProyectos('".$id_juez."','".$proyectos_calificar[$x]."','".$id_ciclo_escolar_activo."')");
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
            }
                    
            $mensaje = true;
        }
        else
        {
            $mensaje = false;
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