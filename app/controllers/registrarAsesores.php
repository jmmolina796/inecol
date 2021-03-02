<?php

	setPermission("root");
	endPermissions();

	$nombre = $_POST["nombre"];
	$ape_paterno = $_POST["ape_paterno"];
	$ape_materno = $_POST["ape_materno"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$nombre_usuario = $_POST["nombre_usuario"];
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
    $tipoFuncion = $_POST["tipoFuncion"];

	$imagen = ($_POST["imagen"] != "#" && $_POST["imagen"] != "") ? $_POST["imagen"] : "";

	$color = $_POST["color"];

	$data = model("registrarAsesores",compact("nombre","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","imagen","tipoFuncion","color"));

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
		$resultado = "Registro insertado correctamente.";
        sendToClient(compact("mensaje","resultado"));
	}
	else if($mensaje == "usuario")
	{
		$resultado = "Este nombre de usuario ya ha sido registrado anteriormente, prueba con otro.";
        sendToClient(compact("mensaje","resultado"));
	}
	else if($mensaje == "email")
	{
		$resultado = "Este correo electrónico ya ha sido registrado anteriormente, prueba con otro.";
        sendToClient(compact("mensaje","resultado"));
	}