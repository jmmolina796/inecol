<?php

	setPermission("root");
	setPermission("administrator");
	setPermission("adviser");
	endPermissions();
	
	if(isset($_POST['id_asesor']))
	{
		$id_asesor = $_POST['id_asesor'];	
		$passwordNew = $_POST["password"];
		
		$dataAsesor = model("buscarAsesor",compact("id_asesor"));
		extract($dataAsesor);
	}
	else
	{
		$id_asesor = $_SESSION["id_usuario"];
		$passwordNew = "";

		$dataAsesor = model("buscarAsesor",compact("id_asesor"));
		extract($dataAsesor);

	}

	$imagenBaseDatos = $imagen; //Del modelo
	$nombre = $_POST["nombre"];
	$ape_paterno = $_POST["ape_paterno"];
	$ape_materno = $_POST["ape_materno"];
	$email = $_POST["email"];
    $nombre_usuario = $_POST["nombre_usuario"];
    $func_asesor = $_POST["func_asesor"];
	$telefono = $_POST["telefono"];
	$imagen = ($_POST["imagen"] != "#" && $_POST["imagen"] != "") ? $_POST["imagen"] : "";
	$color = $_POST["color"];

	$data = model("modificarAsesores",compact("id_asesor","nombre","ape_paterno","ape_materno","email","passwordNew","nombre_usuario","func_asesor","telefono","imagen","rol","color"));

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

		if(isset($_POST['id_asesor']))
		{
			$resultado = "Registro modificado correctamente.";
		}
		else
		{
			$resultado = "Se ha modificado tu información correctamente.";

			$_SESSION["id_usuario"] = $id_asesor;
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