<?php

	if(isset($_SESSION["id_usuario"]))
	{
		$id_usuario = $_SESSION["id_usuario"];
		$password = $_POST["claveActual"];
		$newPassword = $_POST["claveNueva"];
		$rol = $_SESSION["rol"];

		$newPassword2 = $_POST["claveNueva2"];

		if($newPassword == $newPassword2)
		{
			$data = model("modificarClave",compact("id_usuario","password","newPassword","rol")); 

			extract($data);

			if(isset($error))
			{
		        $resultado = "Hubo un error en la base de datos";
		        echo json_encode(compact("error","resultado"));
			}
			else if($mensaje == "0")
			{
				$resultado = "La contraseña actual es incorrecta";
		        echo json_encode(compact("mensaje","resultado"));
			}
			else if($mensaje == "1")
			{
				$resultado = "Tu contraseña se ha modficiado correctamente";
		        echo json_encode(compact("mensaje","resultado"));
			}
		}
	}