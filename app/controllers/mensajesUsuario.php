<?php

	if(isset($_SESSION["id_usuario"]))
	{
		$id_usuario = $_SESSION["id_usuario"];
		$rol = $_SESSION["rol"];
		$nombre_usuario = $P_nombre_usuario_consultar;

		$auxChat = ( isset($_POST["auxChat"]) ) ? true : false; //JavaScript
		$loadNew = ( isset($_POST["loadNew"]) ) ? $_POST["loadNew"] : false; //popstate JavaScript

		$dataChats = model("mensajesUsuario",compact("id_usuario","rol","nombre_usuario"));
		extract($dataChats);

		if(isset($error))
		{
			//ERRROR
		}
		else
		{
			$mensaje = $mensaje_mensajes;
			$informacion = $informacion_mensajes;

			$contenidoMensajes = builder("crearMensajes",compact("mensaje","informacion"));
			$contenidoHeaderMensajes = builder("crearHeaderMensajes",compact("mensaje","P_nombre_completo","P_nombre_usuario","P_imagen","P_rol"));
			$contenidoFooterMensajes = builder("crearFooterMensajes",compact("mensaje"));
		}

		//var_dump($contenidoMensajes);exit();

		if($mensaje_mensajes == "nuevoChat")
		{
			$contenidoChatsNuevo = $contenidoMensajes;
			$contenidoMensajes = "";
		}
		else
		{
			$contenidoChatsNuevo = "";
		}

		if(isUrlClient() && !$auxChat) //Petición sin chats
		{
			if(!$loadNew && $mensaje_mensajes == "nuevoChat")
			{
				$contenidoMensajes = "";
				$contenidoChatsNuevo = "";
			}
			view("mensajesUsuario",compact("contenidoChatsNuevo","contenidoMensajes","contenidoHeaderMensajes","contenidoFooterMensajes"));
		}
		else
		{
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

					$contenidoChats = builder("crearChats",compact("mensaje","informacion","P_nombre_usuario_consultar"));
				}
			view("mensajesUsuarioChats",compact("contenidoChatsNuevo","contenidoChats","contenidoMensajes","contenidoHeaderMensajes","contenidoFooterMensajes"));
		}
	}
	else
	{
		view("notfound");
	}