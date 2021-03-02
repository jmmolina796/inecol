<?php

	try
	{		
		$peticion = $mysqli->query("CALL SP_getModulosFiltro('".$filtro_modulos."','".$busqueda_nombre_modulo."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_modulos = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_modulos[$i] = $row;
                $i++;
				
			}
			$mensaje_modulos = true;
		}
		else
		{
			$mensaje_modulos = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}


	if(isset($error))
	{
	   $data = compact("error");  
	}
    else if($mensaje_modulos===false)
    {
         $data = compact("mensaje_modulos");
    }
    else
    {
    	 $data = compact("informacion_modulos", "mensaje_modulos");
    }