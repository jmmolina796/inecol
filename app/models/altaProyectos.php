<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_altaProyectos(".$id_proyecto.")");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

		if( $peticion->num_rows > 0)
        {

			while($row = $peticion->fetch_array(MYSQLI_BOTH))
			{

				$result = $row["result"];
			         
			}
			
		}

		

	    $mensaje = true;
	}
	catch(Exception $e) 
	{
	        $error = "@%@#".$e->getMessage();
	}
	if(isset($error))
	{
	   $data = compact("error");    
	}
    else
    {
    	
	   $data = compact("mensaje","result");
    }