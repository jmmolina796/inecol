<?php

	$data = model("buscarAdministrador",compact("id_administrador"));

	extract($data);

	if(isset($error))
	{

	}
	else if($mensaje_administrador === false)
	{

	}
	else
	{
		$nombre_completo = $nombre_administrador." ".$ape_paterno." ".$ape_materno;

		if(empty($telefono))
		{
			$telefono = "Ninguno";
		}

		$tipoUsuario = "Administrador";

		if(isSessionStarted() && ($_SESSION["usuario"] == $nombre_usuario) )
		{
			view("administrador",compact("nombre_completo","nombre_usuario","email","telefono","imagen","tipoUsuario","color"));
		}
		else
		{
			view("administrador_invitado",compact("nombre_completo","nombre_usuario","email","telefono","imagen","tipoUsuario","color"));
		}
	}