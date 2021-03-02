<?php

	$imagenes = ( isset($_POST["imagenes"]) ? ($_POST["imagenes"]) : ("") );
	$archivos = ( isset($_POST["archivos"]) ? ($_POST["archivos"]) : ("") );
	$iframesYoutube = ( isset($_POST["iframesYoutube"]) ? ($_POST["iframesYoutube"]) : ("") );
	$urlProyecto = $_POST["urlProyecto"];
	$type = $_POST["type"];
    $publicacionCompleta = $_POST["publicacionCompleta"];

    $id_usuario = $_SESSION["id_usuario"];
	$rol = $_SESSION["rol"];

	if($type == "p")
	{
		$type = "1";
	}
	else
	{
		$type = "0";
	}

	$data = model("registrarPublicacionesProyecto",compact("publicacionCompleta","urlProyecto","links","imagenes","archivos","iframesYoutube","type")); 

	extract($data);
        
	if(isset($error))
	{
        $resultado = "<div>Hubo un error</div>";
        echo $resultado;
	}
	else if($mensaje_registro_publicacion === false)
	{

	}
	else
	{
        $condicion = "2";
		$ordenamiento = 'desc';
		$limit1 = 0;
		$limit2 = 0;
		$tipoBusqueda = 'AllPublicaciones';


		if($type == "1")
		{
			$data2 = model("conseguirInfoPublicacionesProyecto",compact("urlProyecto","id_publicacion_proyecto_docente","condicion","ordenamiento","limit1","limit2","tipoBusqueda","id_usuario","rol")); 
	        extract($data2);
	        $mensaje = $mensaje_publicaciones_proyectos;
	        $informacion = $informacion_publicaciones_proyectos;

		}
		else
		{
			$urlModulo = $urlProyecto;
			$id_publicacion_modulo_docente = $id_publicacion_proyecto_docente;
			$data2 = model("conseguirInfoPublicacionesModulo",compact("urlModulo","id_publicacion_modulo_docente","condicion","ordenamiento","limit1","limit2","tipoBusqueda","id_usuario","rol")); 
	        extract($data2);
	        $mensaje = $mensaje_publicaciones_modulos;
	        $informacion = $informacion_publicaciones_modulos;
		}


        $loader_section = builder("loader-section");
        
        $pub = builder("crearPublicacionesProyectos",compact("mensaje","informacion","tipoBusqueda","loader_section","type"));
        $idP = $id_publicacion_proyecto_docente;

        sendToClient(compact("pub","idP"));
     }