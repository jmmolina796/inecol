<?php 

	$contentHtml = "";

	$x = 0;
	foreach($elementos as $clave=>$valor) 
	{
		if(isSessionStarted())
		{
			if(strrpos($clave,"@go") === false)
			{
				if(!isTeacher())
				{
					$contentHtml .= "<li class='openFile' data-file='".URL_SERVER.$clave."'>$valor</li>";
				}
				else
				{
					$contentHtml .= "<li class='goToUrl'><a class='no-style' href='".URL_SERVER.$clave."'>$valor</a></li>";
				}
			}
			else
			{
				$clave = substr($clave,4);
				$contentHtml .= "<li class='goToUrl'><a class='no-style' href='".$clave."'>$valor</a></li>";
			}
		}
		else
		{
			if(strrpos($clave,"@go") === false)
			{
				$contentHtml .= "<li class='goToUrl'><a class='no-style' href='".URL_SERVER.$clave."'>$valor</a></li>";	
			}
			else
			{
				$clave = substr($clave,4);
				$contentHtml .= "<li><a class='no-style' href='".$clave."' target='_blank'>$valor</a></li>";	
			}
		}
		$x++;
	}