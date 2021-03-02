<?php

    try
	{
		$mysqli->autocommit(false);  // empieza la transaccion 
                    // se actualizan los datos del docente
		$peticion = $mysqli->query("CALL SP_updateDocentes('".$id_docente."','".$id_entidad."','".$id_municipio."','".$localidad."','".$docente."','".$ape_paterno."','".$ape_materno."','".$mail."','".$password."','".$nombre_usuario."','".$telefono."','".$imagen."','".$color."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		$mensaje = true;
		if(isset($peticion->num_rows))
		{
			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$mensaje = $row["mensaje"];
                $id_docente = $row["id_docente"];                   
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
		else
		{
			$mensaje = false;
		}
                     //Fin de se actualizan los datos del docente
        if($id_docente!="-1") // si docente es diferente de -1 quiere decir que estuvo correcto ye el registro se actualizo, de lo contrario el nombre de usuario o el email se repitieron en la consulta.
        {
        // Estas intrucciones son necesarias para poder hacer varias consultas a la vez en un modelo
			$mysqli->more_results();
			$mysqli->next_result();
			$mysqli->store_result();
        // Nueva cosulta Se eliminan las escuelas con las que el cliente se registró          
            $peticion = $mysqli->query("DELETE FROM rel_docentes_escuelas WHERE id_docente = '".$id_docente."'");
            if(!$peticion)
			{
				throw new Exception($mysqli->error);
			}
	                
            $mensaje = true;
                
           //  Fin de Nueva cosulta Se eliminan las escuelas con las que el cliente se registró
                // Nueva consulta se vuelven a ingresar las nuevas escuelas con las que el cliente se registró
            for($x=0;$x<sizeof($escuelas);$x++)
            {
				$clave = $escuelas[$x][0]["clave"];
				$id_grado = $escuelas[$x][1]["id_grado"];
				$id_grupo = $escuelas[$x][2]["id_grupo"];
				$peticion = $mysqli->query("CALL SP_insertRelDocentesEscuelas('".$id_docente."','".$clave."','".$id_grado."','".$id_grupo."')");
				if(!$peticion)
				{
					throw new Exception($mysqli->error);
				}
            }
        }
        $mysqli->commit();  // si en la transaccion no hubo ningun error se ejetuca el commit                    
	}
	catch(Exception $e) 
	{
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