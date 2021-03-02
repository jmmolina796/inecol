<?php

	if(isset($_SESSION["id_usuario"]))
	{
		$id_usuario = $_SESSION["id_usuario"];
		$rol = $_SESSION["rol"];

		$dataChats = model("mensajes",compact("id_usuario","rol"));
		extract($dataChats);

		if(isset($error))
		{
			//ERRROR
		}
		else if($mensaje_chats === false)
		{
			$contenidoChats = "";
		}
		else
		{
			$mensaje = $mensaje_chats;
			$informacion = $informacion_chats;
			$P_nombre_usuario_consultar = "";

			$contenidoChats = builder("crearChats",compact("mensaje","informacion","P_nombre_usuario_consultar"));
		}
			view("mensajes",compact("contenidoChats"));
	}
	else
	{
		view("notfound");
	}