<?php 
	
	$contentHtml = "";

	if($mensaje != "user")
	{
		if(isTeacher($P_rol))
		{
			$imagen = URL_SERVER.URL_DOC_IMG.$P_imagen;
			$link = teacherProfileLink($P_nombre_usuario);
		}
		else if(isAdviser($P_rol))
		{
			$imagen = URL_SERVER.URL_ADM_IMG.$P_imagen;
			$link = adviserProfileLink($P_nombre_usuario);
		}
		else
		{
			$imagen = URL_SERVER.URL_ADM_IMG.$P_imagen;
			$link = administratorProfileLink($P_nombre_usuario);
		}

		$contentHtml .= "<div class='header'>".
							"<div class='return'></div>".
							"<div class='usuario'>".
								"<span class='nombre goToUrl'><a class='no-style' href='".$link."'>".$P_nombre_completo."</a></span>".
								/*"<span class='hora'>2:47 AM</span>".*/
							"</div>".
							"<div class='imagen goToUrl'>".
								"<a class='no-style' href='".$link."'><img src='".$imagen."' alt='".$P_nombre_completo."'></a>".
							"</div>".
						"</div>";

	}

	/*if($mensaje == "true") //Se toma como string debido a que hay varios posibles valores
	{
		for($x=0;$x<count($informacion);$x++)
		{
			list($id_comentario, $comentario, $css_mensaje, $fecha_comentario, $visto_receptor) = $informacion[$x];

			$contentHtml .= "<div class='".$css_mensaje."'>".
								"<p>".
									"<span class='texto'>".$comentario."</span>".
									"<span class='hora'>".$fecha_comentario."</span>".
								"</p>".
							"</div>";
		}
	}
	else if($mensaje == "user")
	{
		
	}*/


