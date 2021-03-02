<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoCicloEscolar(".$id_ciclo.")"); 
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
                    
			while($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_ciclo_escolar = $row["id_ciclo_escolar"];
				$fecha_inicio_ciclo_escolar = $row["fecha_inicio"];
				$fecha_fin_ciclo_escolar = $row["fecha_fin"];
				$nombre_ciclo_escolar = $row["nombre"];
			}
			$mensaje_ciclo_escolar = true;
		}
		else
		{
			$mensaje_ciclo_escolar = false;
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
    else if($mensaje_ciclo_escolar === true)
    {
        $data = compact("mensaje_ciclo_escolar","id_ciclo_escolar","fecha_inicio_ciclo_escolar","fecha_fin_ciclo_escolar","nombre_ciclo_escolar");
    }
    else
    {
         $data = compact("mensaje_ciclo_escolar");
    }