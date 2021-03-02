<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_administrador = $_SESSION["id_usuario"];
	$grados = $_POST["grados"];
	$nombre	= $_POST["modulo-nombre"];
	$descripcion = $_POST["modulo-descripcion"];

	$imagen_portada = ($_POST["imagen"] != "#" && $_POST["imagen"] != "") ? $_POST["imagen"] : "";
	$color = $_POST["color"];

	$data3 = model("generarLink");

	extract($data3);
	
	$link_modulo = $link_proyecto;

	$data2 = model("registrarModulos",compact("id_administrador","nombre","descripcion","imagen_portada","grados","link_modulo","color"));
	
	extract($data2);

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
	else
	{
		$resultado = "Registro insertado correctamente.";
        sendToClient(compact("mensaje","resultado"));
	}