<?php

	setPermission("root");
	setPermission("administrator");
	endPermissions();
	
	if(isset($_POST['id_administrador']))
	{
		$id_administrador = $_POST['id_administrador'];	
		$passwordNew = $_POST["password"];
		
		$dataAdministrador = model("buscarAdministrador",compact("id_administrador"));
		extract($dataAdministrador);
	}
	else
	{
		$id_administrador = $_SESSION["id_usuario"];
		$passwordNew = "";

		$dataAdministrador = model("buscarAdministrador",compact("id_administrador"));
		extract($dataAdministrador);

	}

	$imagenBaseDatos = $imagen; //Del modelo
	$nombre = $_POST["nombre"];
	$ape_paterno = $_POST["ape_paterno"];
	$ape_materno = $_POST["ape_materno"];
	$email = $_POST["email"];
	$nombre_usuario = $_POST["nombre_usuario"];
	$telefono = $_POST["telefono"];
	$imagen = ($_POST["imagen"] != "#" && $_POST["imagen"] != "") ? $_POST["imagen"] : "";
	$color = $_POST["color"];

	$data = model("modificarAdministradores",compact("id_administrador","nombre","ape_paterno","ape_materno","email","passwordNew","nombre_usuario","telefono","imagen","rol","color"));

	extract($data);
	

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
			$fldr = "imgAdm";
			$nameFileToDelete = $imagenBaseDatos;
			load("gestionarArchivos",$fldr,$nameFileToDelete);
		}

		if(isset($_POST['id_administrador']))
		{
			$resultado = "Registro modificado correctamente.";
		}
		else
		{
			$resultado = "Se ha modificado tu información correctamente.";

			$_SESSION["id_usuario"] = $id_administrador;
			$_SESSION["rol"] = $_SESSION["rol"];
			$_SESSION["usuario"] = $nombre_usuario;
			$_SESSION["imagen"] = $imagen != "" ? $imagen : $_SESSION["imagen"];

		}
        sendToClient(compact("mensaje","resultado"));
	}
	else if($mensaje == "usuario")
	{
		$resultado = "El nombre de usuario ya ha sido elegido por otra persona.";
	    sendToClient(compact("mensaje","resultado"));
	}
	else if($mensaje == "email")
	{
		$resultado = "El correo electrónico ya ha sido elegido por otra persona.";
	    sendToClient(compact("mensaje","resultado"));
	}