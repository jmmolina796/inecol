<?php

	$id_comentario_publicacion = $_POST["id_comn"];
	$id_publicacion = $_POST["id_pub"];
	$url_proyecto = $_POST["urlProyecto"];
	$comentario_publicacion = $_POST["comentario_publicacion"];
	$id_usuario = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : "0"; //Es decir ninguno
	$rol = $_SESSION["rol"];
	$type = ($_POST["type"] == "p") ? "1" : "0";

	$data = model("verificarComentarios",compact("id_comentario_publicacion","id_publicacion","url_proyecto","id_usuario","rol","type")); 
	extract($data);


	if(isset($error))
	{
        // vista error
	}
	else if($mensaje_verificar_comentarios === false)
	{
		// no hay nada que borrar (no creo que suceda esto);
	}
	else if($mensaje == '1')
	{
		$data2 = model("modificarComentario",compact("id_comentario_publicacion","comentario_publicacion","rol","type"));
		extract($data2);

		if(isset($error))
		{
	        // vista error
		}
		else if($mensaje_comentarios_mod_publicaciones === false)
		{
			// no hay nada que borrar (no creo que suceda esto);
		}
		else
		{
            $nombre_iniciales = $nombre." ".$ape_paterno[0].". ".$ape_materno[0].".";
            $nombre_completo = $nombre." ".$ape_paterno." ".$ape_materno;

            if($rol == "0")
            {
            	$imagen_usuario = URL_SERVER.URL_DOC_IMG.$imagen;
            }
            else
            {
            	$imagen_usuario = URL_SERVER.URL_ADM_IMG.$imagen;
            }

            $time = explode("#", $tiempo);
            $horas = $time[0]; 
            $minutos = $time[1]; 
            $minutosFaltantes = 60 - $time[1]; 


            if($horas >= 24 && $horas < 48)
            {
                
                $calculos1 = (48-$horas)*60;
                
                $minutosFaltantes = $calculos1-$minutos; 
            }
            else
            {
                if($horas >= 48)
                { 
                    $minutosFaltantes = "S/N"; 
                }
            }

            $comentario_publicacion = makeLinks($comentario_publicacion);

			view("modificarComentario",compact("id_comentario_publicacion", "id_publicacion_proyecto_docente", "comentario_publicacion", "tiempo_comentario", "nombre_iniciales", "nombre_completo", "imagen_usuario", "nombre_usuario","fecha_publicacion","fecha_completa","horas","minutos","minutosFaltantes"));
		}
	}
	else
	{
		//Vacío
	}	