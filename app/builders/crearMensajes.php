<?php 
	
	$contentHtml = "";
	
	/*$loader = "<div id='loader-chatMessage'>".
				"<div class='spinner'>".
				  "<div class='bounce1'></div>".
				  "<div class='bounce2'></div>".
				  "<div class='bounce3'></div>".
				"</div>".
			"</div>";*/

	if($mensaje == "true") //Se toma como string debido a que hay varios posibles valores
	{

		/*$contentHtml .= "<div class='contenido'>".
							"<div class='contInt'>";*/
		$flag = true;
		for($x=0;$x<count($informacion);$x++)
		{
			list($id_comentario, $comentario, $css_mensaje, $fecha_comentario, $hora, $dia, $visto_receptor) = $informacion[$x];

			if($flag)
			{
				$contentHtml .= "<div class='day'>".
										"<p>".$dia."</p>".
									"</div>";
				$flag = false;
			}
			else
			{
				/*if( (isset($informacion[$x+1])) && ($informacion[$x][5] != $informacion[$x+1][5]) )
				{
					$contentHtml .= "<div class='day'>".
										"<p>".$dia."</p>".
									"</div>";
				}
				else*/ 
				if( (isset($informacion[$x-1])) && ($informacion[$x][5] != $informacion[$x-1][5]) )
				{
					$contentHtml .= "<div class='day'>".
										"<p>".$dia."</p>".
									"</div>";
				}
			}

			$contentHtml .= "<div class='".$css_mensaje."'>".
								"<p>".
									"<span class='texto'>".$comentario."</span>".
									"<span class='hora'>".$hora."</span>".
								"</p>".
							"</div>";
		}

		/*$contentHtml .=		"</div>".
						"</div>";
						/*"<div class='footer'>".
							$loader.
							"<textarea placeholder='Escribe tu mensaje' class='message' id='chatMessage'></textarea>".
							"<span class='sendButton' id='sendMessage'></span>".
						"</div>";*/
	}
	else if($mensaje == "false")
	{
		/*$contentHtml .=	"<div class='contenido'>".
							"<div class='contInt'>".
							"</div>".
						"</div>";*/
						/*"<div class='footer'>".
							$loader.
							"<textarea placeholder='Escribe tu mensaje' class='message' id='chatMessage'></textarea>".
							"<span class='sendButton' id='sendMessage'></span>".
						"</div>";*/
	}
	else if($mensaje == "user")
	{
		$contentHtml .=	"<div class='noSelected'>".
							"<p class='note'>Ese usuario no existe</p>".
						"</div>";
	}
	else if($mensaje == "nuevoChat")
	{
		for($x=0;$x<count($informacion);$x++)
		{
			list($mensaje, $nombre, $ape_paterno, $ape_materno, $nombre_usuario, $imagen, $rol) = $informacion[$x];

			$nombre_completo = $nombre." ".$ape_paterno." ".$ape_materno;


			if(isTeacher($rol))
			{
				$imagen = URL_SERVER.URL_DOC_IMG.$imagen;
			}
			else
			{
				$imagen = URL_SERVER.URL_ADM_IMG.$imagen;
			}

			$contentHtml .= "<article class='goToUrl seleccionado'>".
								"<a href='".chatsLink($nombre_usuario)."' class='no-style'>".
									"<div class='imagen'>".
										"<img src='".$imagen."'>".
									"</div>".
									"<div class='informacion'>".
										"<p class='nombre'>".$nombre_completo."</p>".
										"<p class='fecha'></p>".
										"<p class='cantidad'>".
											"<span></span>".
										"</p>".
										"<p class='mensaje'></p>".
									"</div>".
								"</a>".
							"</article>";
		}
	}

