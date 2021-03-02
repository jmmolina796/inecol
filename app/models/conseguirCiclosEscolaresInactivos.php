<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getCiclosEscolaresInactivos()"); 
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
	        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
	        {
	            $informacion_ciclos_escolares_inactivos = array();
	            $i=0;    
				while($row = $peticion->fetch_array(MYSQLI_NUM))
				{
					$informacion_ciclos_escolares_inactivos[$i] = $row;
	                $i++;
				}
				$mensaje_ciclos_escolares_inactivos = true;
			}
			else
			{
				$mensaje_ciclos_escolares_inactivos = false;
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
    else if($mensaje_ciclos_escolares_inactivos  === true)
    {
         $data = compact("informacion_ciclos_escolares_inactivos",'mensaje_ciclos_escolares_inactivos');
    }
    else
    {
         $data = compact("mensaje_ciclos_escolares_inactivos");
    }