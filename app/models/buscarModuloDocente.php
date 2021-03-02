<?php

	try
	{
		$peticion = $mysqli->query("CALL SP_getInfoPortadaModuloDocente('".$url."','".$id_usuario."','".$rol."')");


		if(!$peticion)
		{
			throw new Exception($mysqli->error);
		}

            if(isset($peticion->num_rows) && $peticion->num_rows > 0)
            {

			if($row = $peticion->fetch_array(MYSQLI_ASSOC))
			{
				$id_rel_modulo_docente = $row["id_rel_modulo_docente"];
				$id_modulo = $row["id_modulo"];
				$url_rel_modulo = $row["url_rel_modulo"];
				$rel_estatus_modulo_docente = $row["rel_estatus_modulo_docente"];
				$rel_estatus_modulo = $row["rel_estatus_modulo"];
				$cant_likes = $row["cant_likes"];
				$css_likes = $row["css_likes"];
				$nombre_docente = $row["nombre_docente"];
				$ape_paterno_docente = $row["ape_paterno_docente"];
				$ape_materno_docente = $row["ape_materno_docente"];
				$nombre_usuario = $row["nombre_usuario"];
				$imagen_docente = $row["imagen_docente"];
				$nombre_modulo = $row["nombre_modulo"];
				$descripcion = $row["descripcion"];
				$imagen_portada = $row["imagen_portada"];
				$url_modulo = $row["url_modulo"];
				$estatus_modulo = $row["estatus_modulo"];
				$id_ciclo_escolar = $row["id_ciclo_escolar"];
				$nombre_ciclo_escolar = $row["nombre_ciclo_escolar"];
				$clave_escuela = $row["clave_escuela"];
				$nombre_escuela = $row["nombre_escuela"];
				$nombre_grado = $row["nombre_grado"];
				$nombre_grupo = $row["nombre_grupo"];
				$color = $row["color"];
			}
			$mensaje_modulo_docente = true;
		}
		else
		{
			$mensaje_modulo_docente = false;
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
        if($mensaje_modulo_docente === true)
        {
            $data = compact("mensaje_modulo_docente","id_rel_modulo_docente", "id_modulo", "url_rel_modulo", "rel_estatus_modulo_docente", "rel_estatus_modulo", "cant_likes", "css_likes", "nombre_docente", "ape_paterno_docente", "ape_materno_docente", "nombre_usuario", "imagen_docente", "nombre_modulo", "descripcion", "imagen_portada", "url_modulo", "estatus_modulo", "id_ciclo_escolar","nombre_ciclo_escolar","clave_escuela" ,"nombre_escuela", "nombre_grado", "nombre_grupo", "color"); 
        }
        else
        {
            $data = compact("mensaje_modulo_docente");
        }
    }	