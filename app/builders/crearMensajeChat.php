<?php

	$contentHtml = "";

	if($dia != $ultimo_dia_mensaje)
	{
		$contentHtml .= "<div class='day'>".
							"<p>".$dia."</p>".
						"</div>";

	}
	
	$contentHtml .= "<div class='".$css_mensaje."'>".
						"<p>".
							"<span class='texto'>".$comentario."</span>".
							"<span class='hora'>".$fecha_comentario."</span>".
						"</p>".
					"</div>";