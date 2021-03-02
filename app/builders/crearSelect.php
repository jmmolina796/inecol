<?php 

	if($mensaje === true)
	{
		$contentHtml = "";
		$x = 1;
		foreach ($informacion as $key => $value) 
		{
			list($id, $val) = $informacion[$key];
			if($x == 1)
			{
				if($valor == "none")
				{
					$contentHtml .= "<option value='none' disabled='disabled' selected='selected'>Seleccione $nombre:</option>";
				}
				else
				{
					$contentHtml .= "<option value='none' disabled='disabled'>Seleccione $nombre:</option>";
				}	
			}
			if($valor == $id)
			{
				$contentHtml .= "<option value='".$id."' selected='selected'>".$val."</option>";
			}
			else
			{
				$contentHtml .= "<option value='".$id."'>".$val."</option>";
			}
			$x++;
		}
	}
	else 
	{
		$contentHtml = "<option value='none' disabled='disabled' selected='selected'>Seleccione $nombre:</option>";;
	}
