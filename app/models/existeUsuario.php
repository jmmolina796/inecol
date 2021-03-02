<?php

	$user_name = $action1;
	try
	{
		$peticion = $mysqli->query("CALL SP_verifyUrlUsuario('".$user_name."','".$rol."')");

		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
		if(isset($peticion->num_rows))
		{
			if($row = $peticion->fetch_array(MYSQLI_ASSOC))
			{
				$id = $row["mensaje"];
				$title = $row["title"];
			}
		}
		else
		{
			$id = "-1";
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
	else if(isset($id))
	{
		$data = compact("id","title");
	}