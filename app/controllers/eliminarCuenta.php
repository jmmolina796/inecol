<?php

	if(isset($_SESSION["id_usuario"]))
	{
		$rol = $_SESSION["rol"];

		if(!isRoot())
		{
			if(isTeacher())
			{
				$id_docente = $_SESSION["id_usuario"];
				$data = model("eliminarDocentes",compact("id_docente")); 
			}
			else if(isAdministrator())
			{
				$id_administrador = $_SESSION["id_usuario"];
				$data = model("eliminarAdministradores",compact("id_administrador"));
			}
			else 
			{
				exit();
			}

			extract($data);

			if(isset($error))
			{
		        $resultado = "Hubo un error en la base de datos";
		        sendToClient((compact("error","resultado")));
			}
			else
			{
				closeSession();
		        sendToClient((compact("mensaje")));
			}
		}
	}