<?php

	if(isUrlClient())
	{
		return;
	}

	if(isset($_SESSION["id_usuario"]))
	{
		$id_usuario = $_SESSION["id_usuario"];
		view("menuUsuario", compact("id_usuario"));
		load("miCuenta");
	}	
	else
	{      
		/*$requesUrl = explode("/", $_SERVER['REQUEST_URI']);     //Cambiar al subir al servidor
		var_dump(isset($requesUrl[2]));exit();
		if(isset($requesUrl[2]))
		{*/
			view("menu");
		//}
	}