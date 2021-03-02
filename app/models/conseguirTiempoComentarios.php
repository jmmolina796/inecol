<?php

	try
	{

		$ids_comentarios = "";

		for($x=0; $x<sizeof($id_comentario);$x++ )
		{
			if($x < sizeof($id_comentario)-1 )
			{
				$ids_comentarios .= "'".$id_comentario[$x][0]["id_comentario"]."'".",";
			}
			else
			{
				$ids_comentarios .= "'".$id_comentario[$x][0]["id_comentario"]."'";	
			}
			

			
		}
      
		$peticion = $mysqli->query("SELECT id_comentario_publicacion,F_getInfoFechaPublicacion(fecha_comentario) as tiempo ,EXTRACT(hour from TIMEDIFF(NOW(),fecha_comentario)) as horas, EXTRACT(minute from TIMEDIFF(NOW(),fecha_comentario)) as minutos FROM comentarios_publicaciones where id_comentario_publicacion in(".$ids_comentarios.") order by id_comentario_publicacion desc;");
		
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_tiempo_comentarios = array();
            $i=0;    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_tiempo_comentarios[$i] = $row;
                $i++;
			}
			$mensaje_tiempo_comentarios = true;
		}
		else
		{
			$mensaje_tiempo_comentarios = false;
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
    else if($mensaje_tiempo_comentarios)
    {
         $data = compact("informacion_tiempo_comentarios",'mensaje_tiempo_comentarios');
    }
    else
    {
         $data = compact("mensaje_tiempo_comentarios");
    }