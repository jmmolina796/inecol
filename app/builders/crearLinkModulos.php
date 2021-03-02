<?php

	$contentHtml = "";
	$ignoreArray = array('..', '.','.DS_Store');

	if(is_dir($dir))
	{
		$scanned_directory = array_diff(scandir($dir), $ignoreArray);
		natcasesort($scanned_directory);
		if(sizeof($scanned_directory) > 0)
		{
			foreach($scanned_directory as $valor=>$module) 
			{
				$folders = array();
				$contentHtml .= "<table>".
									"<thead>".
										"<th colspan='2'>".$module."</th>".
									"</thead>".
									"<tbody>";
				$directory = $dir."/".$module;
				$scanned_directory2 = array_diff(scandir($directory), $ignoreArray);
				natcasesort($scanned_directory2);
				foreach($scanned_directory2 as $valor) 
				{
					$file = $dir."/".$module."/".$valor;
					$urlComp = modulesLink($type,$module,$valor);
					$urlInc = modulesLink($type,$module,$valor,"",false);
					if(is_dir($file))
					{
						$folders[$valor] = $file;
					}
					else
					{
						$valorW = substr($valor, 0, strrpos($valor, "."));
						$contentHtml .= "<tr>".
											"<td>".
												"<a href='".$urlComp."' target='_blank'>".$valorW."</a>".
											"</td>".
											"<td>".
												"<a href='".$urlInc."' class='download'>".
													"<span>".$valor."</span>".
												"</a>".
											"</td>".
										"</tr>";
					}
				}
				foreach($folders as $valor2=>$file) 
				{
					$contentHtml .= "<tr><td colspan='2' class='subtitle'>".$valor2."</td></tr>";
					$scanned_directory2 = array_diff(scandir($file), $ignoreArray);
					natcasesort($scanned_directory2);
					foreach($scanned_directory2 as $valor3) 
					{
						$urlComp2 = modulesLink($type,$module,$valor3,$valor2);
						$urlInc2 = modulesLink($type,$module,$valor3,$valor2,false);
						$valorW3 = substr($valor3, 0, strrpos($valor3, "."));
						$contentHtml .= "<tr>".
											"<td>".
												"<a href='".$urlComp2."' target='_blank'>".$valorW3."</a>".
											"</td>".
											"<td>".
												"<a href='".$urlInc2."' class='download'>".
													"<span>".$valor3."</span>".
												"</a>".
											"</td>".
										"</tr>";
					}	
				}
				$contentHtml .= "</tbody></table>";
			}
		}
		else
		{
			var_dump("NO hay");
		}
	}
	else
	{
		var_dump("No existe el fichero");
	}