<?php

	try
	{
        $mysqli->autocommit(false);  // empieza la transaccion 

        $peticion = $mysqli->query("CALL SP_insertCiclosEscolares('".$fecha_inicio."','".$fecha_fin."','".$nombre."')");

        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }
            
        $mensaje = true;

        if(isset($peticion->num_rows))
        {

            if($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
            	$id_ciclo_escolar = $row["id_ciclo_escolar"];                                        
            }
            // Estas intrucciones son necesarias para poder hacer varias consultas a la vez en un modelo
            $mysqli->more_results();
            $mysqli->next_result();
            $mysqli->store_result();

            $peticion = $mysqli->query("CALL SP_insertRelNivelEducativoCicloEscolar(".$id_ciclo_escolar.")");
		
            if(!$peticion)
            {
                throw new Exception($mysqli->error);
            }
	                
            $mensaje =true;
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
