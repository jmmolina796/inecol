<?php

	try
	{

		$ids_publicaciones = "";

		for($x=0; $x<sizeof($id_publicacion);$x++ )
		{
			if($x < sizeof($id_publicacion)-1 )
			{
				$ids_publicaciones .= "'".$id_publicacion[$x][0]["id_publicacion"]."'".",";
			}
			else
			{
				$ids_publicaciones .= "'".$id_publicacion[$x][0]["id_publicacion"]."'";	
			}
			

			
		}
                //$d = "CALL SP_getTiempoPublicaciones(".$ids_publicaciones.")";
		//$peticion = $mysqli->query("SELECT id_publicacion_proyecto_docente,F_getInfoFechaPublicacion(fecha_publicacion) as tiempo FROM publicaciones_proyectos where id_publicacion_proyecto_docente in(".$ids_publicaciones.") order by id_publicacion_proyecto_docente desc"); 

		$peticion = $mysqli->query("SELECT id_publicacion_proyecto_docente,F_getInfoFechaPublicacion(fecha_publicacion) as tiempo ,EXTRACT(hour from TIMEDIFF(NOW(),fecha_publicacion)) as horas, EXTRACT(minute from TIMEDIFF(NOW(),fecha_publicacion)) as minutos FROM publicaciones_proyectos where id_publicacion_proyecto_docente in(".$ids_publicaciones.") order by id_publicacion_proyecto_docente desc;");
		
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            $informacion_tiempo_publicaciones = array();
            $i=0;    
			while($row = $peticion->fetch_array(MYSQLI_NUM))
			{
				$informacion_tiempo_publicaciones[$i] = $row;
                $i++;
			}
			$mensaje_tiempo_publicaciones = true;
		}
		else
		{
			$mensaje_tiempo_publicaciones = false;
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
    else if($mensaje_tiempo_publicaciones)
    {
         $data = compact("informacion_tiempo_publicaciones",'mensaje_tiempo_publicaciones');
    }
    else
    {
         $data = compact("mensaje_tiempo_publicaciones");
    }