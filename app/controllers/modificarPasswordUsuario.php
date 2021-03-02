<?php

	$password = $_POST['password'];
	$token = $_POST['token'];
	$data = model("verificarTokenUsuario",compact("token"));

	extract($data);

	if(isset($error))
	{
		//ERRROR
	}
	else if($respuesta == "0")
	{
		$resultado = "Se detecto que el enlace o url ya no esta disponible, por favor intenta de nuevo desde olvidaste tu contraseña";
		$mensaje = false;
		sendToClient(compact("mensaje","resultado"));
	}
	else
	{
		$id_usuario = "";

		if($rol == '0')
		{
			$id_usuario = $id_docente;
		}
		else
		{
			$id_usuario = $id_administrador;
		}
		$data = model("modificarClaveUsuario",compact("id_usuario","password","rol","token")); 

		extract($data);

		if(isset($error))
		{
		//ERRROR
		}
		else
		{
			$resultado = "Tu contraseña se ha cambiado correctamente";
			$mensaje = true;
			sendToClient(compact("mensaje","resultado"));
		}
	}