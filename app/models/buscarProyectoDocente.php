<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoPortadaProyectoDocente('".$url."','".$id_usuario."','".$rol."')");


		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_ASSOC))
			{
				$id_rel_proyecto_docente = $row["id_rel_proyecto_docente"];
				$id_proyecto = $row["id_proyecto"];
				$url_rel_proyecto = $row["url_rel_proyecto"];
				$rel_estatus_proyecto_docente = $row["rel_estatus_proyecto_docente"];
				$rel_estatus_proyecto = $row["rel_estatus_proyecto"];
				$cant_likes = $row["cant_likes"];
				$css_likes = $row["css_likes"];
				$nombre_docente = $row["nombre_docente"];
				$ape_paterno_docente = $row["ape_paterno_docente"];
				$ape_materno_docente = $row["ape_materno_docente"];
				$nombre_usuario = $row["nombre_usuario"];
				$imagen_docente = $row["imagen_docente"];
				$nombre_proyecto = $row["nombre_proyecto"];
				$descripcion = $row["descripcion"];
				$rel_estatus_fecha_proyecto = $row["rel_estatus_fecha_proyecto"];
				$css_estatus_proyecto = $row["css_estatus_proyecto"];
				$imagen_portada = $row["imagen_portada"];
				$url_proyecto = $row["url_proyecto"];
				$estatus_proyecto = $row["estatus_proyecto"];
				$nombre_ciclo_escolar = $row["nombre_ciclo_escolar"];
				$clave_escuela = $row["clave_escuela"];
				$nombre_escuela = $row["nombre_escuela"];
				$nombre_grado = $row["nombre_grado"];
				$nombre_grupo = $row["nombre_grupo"];
				$color = $row["color"];
			}
			$mensaje_proyecto_docente = true;
		}
		else
		{
			$mensaje_proyecto_docente = false;
		}
	}
	catch(Exception $e) 
    {
        $error = "@%@#".$e->getMessage();
	}
	
	if(isset($error))
	{
	   $data = compact("error");
	   echo $error;
	}
    else
    {
        if($mensaje_proyecto_docente === true)
        {
            $data = compact("mensaje_proyecto_docente", "id_rel_proyecto_docente", "id_proyecto", "url_rel_proyecto", "rel_estatus_proyecto_docente", "rel_estatus_proyecto", "cant_likes", "css_likes" ,"nombre_docente", "ape_paterno_docente", "ape_materno_docente", "nombre_usuario", "imagen_docente", "nombre_proyecto", "descripcion", "rel_estatus_fecha_proyecto", "css_estatus_proyecto", "imagen_portada", "url_proyecto", "estatus_proyecto", "nombre_ciclo_escolar", "clave_escuela" ,"nombre_escuela", "nombre_grado", "nombre_grupo","color"); 
        }
        else
        {
            $data = compact("mensaje_proyecto_docente");
        }
    }	