<?php 

	$contentHtml = "";
	for($x=0;$x<count($informacion);$x++)
	{
		list($id_comentario, $comentario, $nombre, $ape_paterno, $ape_materno, $nombre_usuario, $imagen, $rol, $fecha_comentario, $dia, $css_visto_receptor, $cantidad) = $informacion[$x];

		$nombre_completo = $nombre." ".$ape_paterno." ".$ape_materno;


		if(isTeacher($rol))
		{
			$imagen = URL_SERVER.URL_DOC_IMG.$imagen;
		}
		else
		{
			$imagen = URL_SERVER.URL_ADM_IMG.$imagen;
		}

		$contentHtml .= "<article class='goToUrl ".$css_visto_receptor." ".($P_nombre_usuario_consultar == $nombre_usuario ? 'seleccionado' : '')."'>".
							"<a href='".chatsLink($nombre_usuario)."' class='no-style'>".
								"<div class='imagen'>".
									"<img src='".$imagen."'>".
								"</div>".
								"<div class='informacion'>".
									"<p class='nombre'>".$nombre_completo."</p>".
									"<p class='fecha'>".$dia."</p>".
									"<p class='cantidad'>".
										"<span>".$cantidad."</span>".
									"</p>".
									"<p class='mensaje'>".$comentario."</p>".
								"</div>".
							"</a>".
						"</article>";
	}


	