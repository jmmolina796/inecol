<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoProyecto('".$id_proyecto."')");
		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_BOTH))
			{
				$id_proyecto = $row["id_proyecto"];
				$nombre_proyecto = $row["nombre_proyecto"];
				$fecha_inicio_inscripcion = $row["fecha_inicio_inscripcion"];
				$fecha_fin_inscripcion = $row["fecha_fin_inscripcion"];
                $fecha_inicio = $row["fecha_inicio"];
                $fecha_fin = $row["fecha_fin"];
                $fecha_ini_ins_tex = $row["fecha_ini_ins_tex"];
                $fecha_fin_ins_tex = $row["fecha_fin_ins_tex"];
                $fecha_ini_tex = $row["fecha_ini_tex"];
                $fecha_fin_tex = $row["fecha_fin_tex"];
                $fecha_inicio_ciclo_escolar = $row["fecha_inicio_ciclo_escolar"];
				$fecha_fin_ciclo_escolar = $row["fecha_fin_ciclo_escolar"];
                $nombre_ciclo_escolar = $row["nombre_ciclo_escolar"];
                $nombre_administrador = $row["nombre_administrador"];
                $fecha_creacion = $row["fecha_creacion"];
                $descripcion = $row["descripcion"];
                $imagen_portada = $row["imagen_portada"];
                $estatus = $row["estatus"];
                $estado = $row["estado"];
                $css_estado = $row["css_estado"];
                $id_ciclo_escolar = $row["id_ciclo_escolar"];
                $color = $row["color"];
			}
			$mensaje_proyecto = true;
		}
		else
		{
			$mensaje_proyecto = false;
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
        if($mensaje_proyecto === true)
        {
             $data = compact("mensaje_proyecto", "id_proyecto","nombre_proyecto","fecha_inicio_inscripcion","fecha_fin_inscripcion","fecha_inicio","fecha_fin","fecha_ini_ins_tex","fecha_fin_ins_tex","fecha_ini_tex","fecha_fin_tex","nombre_ciclo_escolar","nombre_administrador","fecha_creacion","descripcion","imagen_portada","estatus","fecha_inicio_ciclo_escolar","fecha_fin_ciclo_escolar","estado","css_estado","id_ciclo_escolar","color");
        }
        else
        {
             $data = compact("mensaje_proyecto");
        }
    }	