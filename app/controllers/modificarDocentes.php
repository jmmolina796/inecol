<?php

	setPermission("teacher");
	setPermission("administrator");
	setPermission("root");
	endPermissions();

	if(isset($_SESSION["id_usuario"]))
	{

		if($_SESSION["rol"] == 0 && !isset($_POST["id_docente"]))
		{
			$id_docente = $_SESSION["id_usuario"];
			$password = "";

			$dataDocente = model("buscarDocente",compact("id_docente"));
			extract($dataDocente);

			$imagenBaseDatos = $imagen; //Del modelo
		}
		else
		{
			$id_docente = $_POST["id_docente"];
			$newPassword = $_POST["password"];

			$dataDocente = model("buscarDocente",compact("id_docente"));
			extract($dataDocente);

			$imagenBaseDatos = $imagen; //Del modelo
			$password = $newPassword; //Debido a que en buscarDocente se optiene el password anterior
		}

		$escuelas = $_POST["arreglo"];
		$docente = $_POST["nombre"];
		$ape_paterno = $_POST["ape_paterno"];
		$ape_materno = $_POST["ape_materno"];
		$mail = $_POST["mail"];
		$nombre_usuario = $_POST["nombre_usuario"];
		$telefono = $_POST["telefono"];
		$id_entidad = $_POST["id_entidad"];
		$id_municipio = $_POST["id_municipio"];
		$localidad = $_POST["localidad"];

		$imagen = ($_POST["imagen"] != "#" && $_POST["imagen"] != "") ? $_POST["imagen"] : "";
		$color = $_POST["color"];

		$data1 = model("modificarDocentes",compact("id_docente","docente","ape_paterno","ape_materno","mail","password","nombre_usuario","telefono","id_entidad","id_municipio","localidad","imagen","escuelas","color"));

		extract($data1);

		if(isset($error))
		{
	        $resultado = "Hubo un error en la base de datos.";
	        sendToClient(compact("error","resultado"));
		}
		else if($mensaje === false)
		{
			$resultado = "Hubo un error en la base de datos.";
	        sendToClient(compact("mensaje","resultado"));
		}
		else if($mensaje === true)
		{
			if($imagen != $imagenBaseDatos)
			{
				$fldr = "imgDoc";
				$nameFileToDelete = $imagenBaseDatos;
				load("gestionarArchivos",$fldr,$nameFileToDelete);
			}

			if(isset($_POST['id_docente']))
			{
				$resultado = "Registro modificado correctamente.";
			}
			else
			{	
				$resultado = "Se ha modificado tu información correctamente.";

				$_SESSION["id_usuario"] = $id_docente;
				$_SESSION["rol"] = $_SESSION["rol"];
				$_SESSION["usuario"] = $nombre_usuario;
				$_SESSION["imagen"] = $imagen != "" ? $imagen : $_SESSION["imagen"];

			}
	        sendToClient(compact("mensaje","resultado"));
		}
		else if($mensaje == "usuario")
		{
			$resultado = "El nombre de usuario no está disponible.";
	        sendToClient(compact("mensaje","resultado"));
		}
		else if($mensaje == "email")
		{
			$resultado = "El correo electrónico no está disponible.";
	        sendToClient(compact("mensaje","resultado"));
		}
	}