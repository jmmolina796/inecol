<?php

	if(isSessionStarted())
	{
		sessionStarted();
	}

	$logueoUsuario = $_POST["logueoUsuario"];
	$logueoPassword = $_POST["logueoPassword"];
	
	$data = model("iniciar_sesion",compact("logueoUsuario","logueoPassword"));

	extract($data);

	if(isset($error))
	{
		$resultado = "Hubo un error en la base de datos.";
        sendToClient(compact("error","resultado"));
	}
	else if($mensaje === false)
	{
		$resultado = "Usuario o contraseña inválidos.";
        sendToClient(compact("mensaje","resultado"));
	}
	else if($mensaje === true)
	{
		$_SESSION["id_usuario"] = $id_usuario;
		$_SESSION["rol"] = $rol;
		$_SESSION["usuario"] = $nombre_usuario;
		$_SESSION["imagen"] = $imagen;

		$USR_SESS = md5(SALT . $id_usuario) . "_" . $rol;
        
        sendToClient(compact("mensaje","USR_SESS"));
	}