<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInformacionProyecto('".$urlProyecto."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
                $nombre = $row["nombre"];
                $descripcion = $row["descripcion"];
                $imagen_portada = $row["imagen_portada"];
                $fecha_inicio = $row["fecha_inicio"];
                $fecha_fin = $row["fecha_fin"];
                $ciclo_escolar = $row["ciclo_escolar"];
                $nombre_docente = $row["nombre_docente"];
                $ape_paterno = $row["ape_paterno"];
                $ape_materno = $row["ape_materno"];
                $nombre_usuario = $row["nombre_usuario"];
                $nombre_escuela = $row["nombre_escuela"];
                $clave_escuela = $row["clave_escuela"];
                $grado = $row["grado"];
                $grupo = $row["grupo"];
                $fecha_ini_tex = $row["fecha_ini_tex"];
                $fecha_fin_tex = $row["fecha_fin_tex"];
                $estado = $row["estado"];
                $css_estado = $row["css_estado"];
                
			}
			$mensaje_informacion_proyecto = true;
		}
		else
		{
			$mensaje_informacion_proyecto = false;
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
        if($mensaje_informacion_proyecto === true)
        {
             $data = compact("mensaje_informacion_proyecto","nombre","descripcion","imagen_portada","fecha_inicio","fecha_fin","ciclo_escolar","nombre_docente","ape_paterno","ape_materno","nombre_usuario","nombre_escuela","clave_escuela","grado","grupo","fecha_ini_tex","fecha_fin_tex","estado","css_estado");
        }
        else
        {
             $data = compact("mensaje_informacion_proyecto");
        }
    }	