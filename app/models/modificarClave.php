<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_updateClave(".$id_usuario.",'".$password."','".$newPassword."','".$rol."')");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
	    if($row = $peticion->fetch_array(MYSQLI_BOTH))
	    {
	    	$mensaje = $row["mensaje"];
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
    else
    {
	   $data = compact("mensaje");
    }