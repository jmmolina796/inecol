<?php

	$imagenes = ( isset($_POST["imagenes"]) ? ($_POST["imagenes"]) : ("") );
	$archivos = ( isset($_POST["archivos"]) ? ($_POST["archivos"]) : ("") );
	$iframesYoutube = ( isset($_POST["iframesYoutube"]) ? ($_POST["iframesYoutube"]) : ("") );
	$urlProyecto = $_POST["urlProyecto"];
    $publicacionCompleta = $_POST["publicacionCompleta"];
    $id_publicacion_proyecto_docente = $_POST["idPub"];
    $type = $_POST["type"];
   
    $id_docente = $_SESSION["id_usuario"];
	$rol = $_SESSION["rol"];

	if($type == "p")
	{
		$type = "1";
	}
	else
	{
		$type = "0";
	}

    $dataImagenes = model("conseguirInfoImagenesPublicaciones",compact("id_publicacion_proyecto_docente","type"));
    extract($dataImagenes);
    if(isset($error))
    {
    	$informacion_imagenes_publicaciones = array();
    }
    else if($mensaje_imagenes_publicaciones === false)
    {
		$informacion_imagenes_publicaciones = array();
    }

    $dataArchivos = model("conseguirInfoArchivosPublicaciones",compact("id_publicacion_proyecto_docente","type"));
    extract($dataArchivos);
    if(isset($error))
    {
    	$informacion_archivos_publicaciones = array();
    }
    else if($mensaje_archivos_publicaciones === false)
    {
		$informacion_archivos_publicaciones = array();
    }

    $dataIframes = model("conseguirInfoEnlacesYoutubePublicaciones",compact("id_publicacion_proyecto_docente","type"));
    extract($dataIframes);
	if(isset($error))
    {
    	$informacion_enlaces_youtube_publicaciones = array();
    }
    else if($mensaje_enlaces_youtube_publicaciones === false)
    {
		$informacion_enlaces_youtube_publicaciones = array();
    }



          
	$data2 = model("modificarPublicacionesProyecto",compact("publicacionCompleta","urlProyecto","informacion_imagenes_publicaciones","informacion_archivos_publicaciones","informacion_enlaces_youtube_publicaciones","imagenes","archivos","iframesYoutube","id_publicacion_proyecto_docente","id_docente","type"));

	extract($data2);
        
	if(isset($error))
	{
        $resultado = "<div>Hubo un error</div>";
        echo $resultado;
	}
	else if($mensaje_modificacion_publicacion === false)
	{

	}
	else
	{
	    
		if(!empty($informacion_imagenes_publicaciones))
		{
		    $imagenesCliente = array();
		    if($imagenes != "")
		    {
			    for($x = 0;$x<count($imagenes);$x++)
			    {
			    	$imagenesCliente[$x] = $imagenes[$x][0]["url_imagen"];
			    }
		    }
		    $imagenesBaseDatos = array();
			for($x = 0;$x<count($informacion_imagenes_publicaciones);$x++)
		    {
		    	$imagenesBaseDatos[$x] = $informacion_imagenes_publicaciones[$x][2];
		    }    

		    $imagenesBorrar = array_diff($imagenesBaseDatos, $imagenesCliente);
		}


		if(!empty($informacion_archivos_publicaciones))
		{
		    $archivosCliente = array();
		    if($archivos != "")
		    {
			    for($x = 0;$x<count($archivos);$x++)
			    {
			    	$archivosCliente[$x] = $archivos[$x][0]["url_archivo"];
			    }
		    }
		    $archivosBaseDatos = array();
			for($x = 0;$x<count($informacion_archivos_publicaciones);$x++)
		    {
		    	$archivosBaseDatos[$x] = $informacion_archivos_publicaciones[$x][3];
		    }

		    $archivosBorrar = array_diff($archivosBaseDatos, $archivosCliente);
		}

		$imagenesBorrar = isset($imagenesBorrar) ? $imagenesBorrar : "";
		$archivosBorrar = isset($archivosBorrar) ? $archivosBorrar : "";

		if($imagenesBorrar != "")
		{	
			$fldr = ($type == 1) ? "imgPub" : "imgPubMod";
			foreach($imagenesBorrar as $link) 
			{
				$nameFileToDelete = $link;
				load("gestionarArchivos",$fldr,$nameFileToDelete);
			}
		}

		if($archivosBorrar != "")
		{
			$fldr = ($type == 1) ? "filPub" : "filPubMod";
			foreach($archivosBorrar as $link) 
			{
				$nameFileToDelete = $link;
				load("gestionarArchivos",$fldr,$nameFileToDelete);
			}
		}

        $condicion = "2";
		$ordenamiento = 'desc';
		$limit1 = 0;
		$limit2 = 0;
		$tipoBusqueda = 'AllPublicaciones';
		$id_usuario = $_SESSION["id_usuario"];

		if($type == "1")
		{
	        $data3 = model("conseguirInfoPublicacionesProyecto",compact("urlProyecto","id_publicacion_proyecto_docente","condicion","ordenamiento","limit1","limit2","tipoBusqueda","id_usuario","rol")); 
	        extract($data3);
	        $mensaje = $mensaje_publicaciones_proyectos;
	        $informacion = $informacion_publicaciones_proyectos;
		}
		else
		{
			$urlModulo = $urlProyecto;
			$id_publicacion_modulo_docente = $id_publicacion_proyecto_docente;
			$data3 = model("conseguirInfoPublicacionesModulo",compact("urlModulo","id_publicacion_modulo_docente","condicion","ordenamiento","limit1","limit2","tipoBusqueda","id_usuario","rol")); 
	        extract($data3);
	        $mensaje = $mensaje_publicaciones_modulos;
	        $informacion = $informacion_publicaciones_modulos;
		}

        $loader_section = builder("loader-section");
        
        $contenidoPublicacion = builder("crearPublicacionesProyectos",compact("mensaje","informacion","tipoBusqueda","loader_section","type"));

        view("publicacionesProyectos",compact("contenidoPublicacion"));

     }