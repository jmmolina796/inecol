<?php 

	if($mensaje === true)
	{
		$contentHtml = "";
		for($x=0;$x<count($informacion);$x++)
		{
			list($id_grado, $id_nivel_educativo, $grado, $nivel_educativo) = $informacion[$x];
			if($x == 0)
			{
				$contentHtml .= "<div class='mt-form seleccionar-grados'>".
						"<p>$nivel_educativo</p>";
			}
			else if($informacion[$x-1][1] != $id_nivel_educativo)
			{
				$contentHtml .= "</div>".
					"<div class='mt-form seleccionar-grados'>".
						"<p>$nivel_educativo</p>";
			}

			$contentHtml .= "<input type='checkbox' data-name='$grado' id='check-proyecto-$id_grado' data-require='false' ";

			if(isset($type) && $type == "disabled")
			{
				$contentHtml .= "disabled='disabled'"; 
			}

			if(isset($values))
			{
				for($y=0;$y<sizeof($values);$y++)
                {
                    if($id_grado == $values[$y])
                    {
                    	$contentHtml .= "checked='checked'";
                        break;
                    }
                } 
			}
			$contentHtml .= ">";
		}
		$contentHtml .= "</div>";
	}