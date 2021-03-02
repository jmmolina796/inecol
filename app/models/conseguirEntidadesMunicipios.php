<?php
	if($opt == "entidades")
	{
		try
		{
			$peticion = $mysqli->query("CALL SP_getEntidades()");                
			if(!$peticion)
			{
				throw new Exception($mysqli->error);
			}
	        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
	        {
	            $informacion_entidades = array();
	            $i=0;
	                    
				while($row = $peticion->fetch_array(MYSQLI_NUM))
				{
					$informacion_entidades[$i] = $row;
	                $i++;
					
				}
				$mensaje_entidades = true;
			}
			else
			{
				$mensaje_entidades = false;
			}
		}
		catch(Exception $e) {
	        $error = "@%@#".$e->getMessage();
		}

		if(isset($error))
		{
		   $data = compact("error");
	            
		}
	    else if(isset($mensaje_entidades))
	    {
	         $data = compact("informacion_entidades", "mensaje_entidades");

	    }	
	}
	else if($opt == "municipios")
	{
		try
		{
			$peticion = $mysqli->query("CALL SP_getMunicipios('".$id_entidad."')");                
			if(!$peticion)
			{
				throw new exception($mysqli->error);
			}
	        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
	        {
	            $informacion_municipios = array();
	            $i=0;
	                    
				while($row = $peticion->fetch_array(MYSQLI_BOTH))
				{
					$informacion_municipios[$i] = $row;
	                $i++;
					
				}
				$mensaje_municipios = true;
			}
			else
			{
				$mensaje_municipios = false;
			}
		}
		catch(exception $e) {
	        $error = "@%@#".$e->getMessage();
		}

		if(isset($error))
		{
		   $data = compact("error");
	            
		}
	    else if(isset($mensaje_municipios))
	    {
	         $data = compact("informacion_municipios", "mensaje_municipios");

	    }
	}

