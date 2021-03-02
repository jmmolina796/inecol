<?php

	$contentHtml = "";

	if($cantidad_fotos>0)
	{

		$data3 = model("conseguirInfoImagenesPublicaciones",compact("id_publicacion_proyecto_docente","type")); 
        extract($data3);

        if(isset($error))
		{
	        // vista error
		}
		else if($mensaje_imagenes_publicaciones === false)
		{

		}
		else
		{
			$contentHtml .= crearContenidoMultimedia("img",$informacion_imagenes_publicaciones,$type);
		}
	}

	if($cantidad_archivos>0)
	{
		$data4 = model("conseguirInfoArchivosPublicaciones",compact("id_publicacion_proyecto_docente","type")); 
	    extract($data4);

	    if(isset($error))
		{
	        // vista error
		}
		else if($mensaje_archivos_publicaciones === false)
		{

		}
		else
		{
			$contentHtml .= crearContenidoMultimedia("fl",$informacion_archivos_publicaciones,$type);
		}
	}
	
	if($cantidad_videos>0)
	{
		$data5 = model("conseguirInfoEnlacesYoutubePublicaciones",compact("id_publicacion_proyecto_docente","type")); 
		extract($data5);

		if(isset($error))
		{
	        // vista error
		}
		else if($mensaje_enlaces_youtube_publicaciones === false)
		{

		}
		else
		{
			$contentHtml .= crearContenidoMultimedia("yb",$informacion_enlaces_youtube_publicaciones,$type);
		}
	}