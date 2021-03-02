<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getAllCiclosEscolares()");                
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_ciclos_escolares = array();
            $i=0;
                    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_ciclos_escolares[$i] = $row;
                $i++;
				
			}
			$mensaje_ciclos_escolares = true;
		}
		else
		{
			$mensaje_ciclos_escolares = false;
		}
	}
	catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
	}

	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if($mensaje_ciclos_escolares === true)
    {
         $data = compact("informacion_ciclos_escolares", "mensaje_ciclos_escolares");
    }
    else
    {
    	$data = compact("mensaje_ciclos_escolares");
    }
