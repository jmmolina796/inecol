<?php

	$correo = $_POST['correo'];
	$to = $correo;


	$data = model("getInfoUsuario",compact("correo"));

	extract($data);

	if(isset($error))
	{
	//ERRROR
	}
	else
	{
		if($mensaje_usuario==false)
		{
			$resultado = "El correo ingresado no corresponde a ninguna cuenta de Pasevic";
			$mensaje = $mensaje_usuario;
	        sendToClient(compact("mensaje","resultado"));
		}
		else
		{
		
			$token = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());
			$data1 = model("registrarTokenUsuario",compact("token","rol","id_usuario"));

			extract($data1);

			if(isset($error))
			{
				//ERRROR
			}
			else
			{
				$subject = "Pasevic solicitud de cambio de contraseña";
				$message = builder("crearMensajeMail",compact("correo","token"));

				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				//mail($to,$subject,$message,$headers);

				if(mail($to,$subject,$message,$headers))
				{
					
					$resultado = "Te hemos enviado un correo para verificar tu cambio de contraseña";
					$mensaje = $mensaje_token_usuario;
			        sendToClient(compact("mensaje","resultado"));
				}
				else
				{
					$resultado = "Ocurrio un error al enviar el correo de cambio de contraseña, intenta de nuevo";
					$mensaje = $mensaje_token_usuario;
			        sendToClient(compact("mensaje","resultado"));
				}
			}
		}
	}