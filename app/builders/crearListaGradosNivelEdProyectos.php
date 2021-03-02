<?php

	if($mensaje === true)
	{
		$contentHtml = "";
	    foreach ($informacion as $key => $value) 
	    {
			if($key == 0 || ( $informacion[$key][0] != $informacion[$key-1][0]) )
			{
		        $contentHtml .= "<div class='gradosElem'>
									<p class='title'>".$informacion[$key][0]."</p>";
				
			}

			$contentHtml .= "<p class='element'>".$informacion[$key][1]."</p>";

			if(!isset($informacion[$key+1][0]) || $informacion[$key][0] != $informacion[$key+1][0])
			{
		        $contentHtml .= "</div>";
				
			}
	    }

	}