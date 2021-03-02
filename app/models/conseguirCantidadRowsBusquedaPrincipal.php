<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getCantidadRowsBusquedaPrincipal('".addslashes($filtroBusqueda)."','".$tipoBusqueda."')");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

	     if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {

           if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$cantidadRows = $row["cantidad"];

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
	   $data = compact("mensaje_busqueda","cantidadRows");
    }