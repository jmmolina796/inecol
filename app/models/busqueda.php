<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getMasResultadosBusquedaPrincipal('".$filtroBusqueda."','".$tipoBusqueda."','".$limit1."','".$limit2."')");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

	     if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_busqueda_principal = array();
            $i=0;      
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_busqueda_principal[$i] = $row;
                $i++;
				
			}
			$mensaje_busqueda = true;
		}
		else
		{
			$mensaje_busqueda = false;
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
	else if($mensaje_busqueda === false)
	{
		$data = compact("mensaje_busqueda");
	}
    else
    {
	   $data = compact("mensaje_busqueda","informacion_busqueda_principal");
    }