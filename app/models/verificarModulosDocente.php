<?php
	
	try
	{
		$peticion = $mysqli->query("CALL SP_verifyDocentesModulosCicloEscolar('".$id_modulo."','".$id_docente."','".$id_ciclo_escolar."')");
        if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows))
		{

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_modulo_docente = $row["id_rel_modulo_docente"];
			}
			$mensaje_modulo_docente = true;
		}
		else
		{
			$mensaje_modulo_docente = false;
		}
	}
	catch(Exception $e) 
    {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
		$data = compact("error");
	}
	else if($mensaje_modulo_docente)
	{
		$data = compact("mensaje_modulo_docente","id_modulo_docente");
	}
	else
	{
		$data = compact("mensaje_modulo_docente");
	}
