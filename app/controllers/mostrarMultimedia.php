<?php

	$link = $_POST["src"];
	$type = $_POST["type"];

	if($type == 0)
	{
		$content = "<div style='background-image: url(\"".$link."\")' class='img'></div>";
	}
	else if($type == 1)
	{
		$content = "<div class='cnt-ytb'>".
						"<div class='ytb'>".
							"<div class='cnt-iframe'>".
								"<iframe allowfullscreen='allowfullscreen' mozallowfullscreen='mozallowfullscreen' msallowfullscreen='msallowfullscreen' oallowfullscreen='oallowfullscreen' webkitallowfullscreen='webkitallowfullscreen' src='".$link."?autoplay=1'>".
										$link.
								"</iframe>".
							"</div>".
						"</div>".
					"</div>";
	}
	else
	{
		$content = "<div>No hay</div>";
	}

	view("mostrarMultimedia",compact("content"));