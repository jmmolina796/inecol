<?php 
	
	$contentHtml = "";

	$loader = "<div id='loader-chatMessage' class='ldr-global'>".
				"<div class='spinner'>".
				  "<div class='bounce1'></div>".
				  "<div class='bounce2'></div>".
				  "<div class='bounce3'></div>".
				"</div>".
			"</div>";

	if($mensaje == "true" || $mensaje == "false" || $mensaje == "nuevoChat")
	{
		$contentHtml .= "<div class='footer'>".
								$loader.
								"<textarea placeholder='Escribe tu mensaje' class='message' id='chatMessage'></textarea>".
								"<span class='sendButton' id='sendMessage'></span>".
							"</div>";
	}