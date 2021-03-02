<?php
	
	$urlProyecto = $_POST["url"];
	$id_publicacion_proyecto_docente = $_POST["idP"];
	$type = $_POST["tp"];

	if($type == "p")
	{
		$type = "1";
	}
	else
	{
		$type = "0";
	}

    $condicion = "2";
	$ordenamiento = 'desc';
	$limit1 = 0;
	$limit2 = 0;
	$tipoBusqueda = 'AllPublicaciones';

	if(isSessionStarted())
	{
		$id_usuario = $_SESSION["id_usuario"];
		$rol = $_SESSION["rol"];
	}
	else
	{
		$id_usuario = "0";
		$rol = "0";
	}

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


	/*$data2 = model("conseguirInfoPublicacionesProyecto",compact("urlProyecto","id_publicacion_proyecto_docente","condicion","ordenamiento","limit1","limit2","tipoBusqueda","id_usuario","rol")); 
   
    extract($data2);*/

    /*$mensaje = $mensaje_publicaciones_proyectos;
    $informacion = $informacion_publicaciones_proyectos;*/
    $loader_section = builder("loader-section");
    
    $contenidoPublicacion = builder("crearPublicacionesProyectos",compact("mensaje","informacion","tipoBusqueda","loader_section","type"));

    view("publicacionesProyectos",compact("contenidoPublicacion"));