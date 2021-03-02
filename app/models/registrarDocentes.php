<?php

	$id_docente="-1";
    try
	{
		$mysqli->autocommit(false);  // empieza la transaccion 
		$peticion = $mysqli->query("CALL SP_insertDocentes('".$id_entidad."','".$id_municipio."','".$localidad."','".$docente."','".$ape_paterno."','".$ape_materno."','".$mail."','".$password."','".$nombre_usuario."','".$telefono."','".$imagen."','".$color."')");
		
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
		if($id_docente!="-1")
		{
	        $mysqli->more_results();
	        $mysqli->next_result();
	        $mysqli->store_result();
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