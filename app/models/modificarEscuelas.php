<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_updateEscuelas('".$clave_escuela."',".$id_nivel_educativo.",".$id_entidad.",".$id_municipio.",'".$nombre_escuela."','".$nombre_localidad."','".$clave_escuela_old."')"); 
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
		}
		else
		{
			$mensaje = false;
		}
	}
	catch(Exception $e) 
    {
    	$error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data= compact("error");   
	}
	else
	{
		$data =compact("mensaje");       
    }