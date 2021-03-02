<?php

	/*setPermission("administrator");
	setPermission("root");
	endPermissions();*/ //Habilitar el registro sin iniciar sesión

	$escuelas = $_POST["arreglo"];
	$docente= $_POST["nombre"];
	$ape_paterno= $_POST["ape_paterno"];
	$ape_materno= $_POST["ape_materno"];
	$mail= $_POST["mail"];
	$password= $_POST["password"];
	$nombre_usuario= $_POST["nombre_usuario"];
	$telefono= $_POST["telefono"];
	$id_entidad= $_POST["id_entidad"];
	$id_municipio= $_POST["id_municipio"];
	$localidad= $_POST["localidad"];

	$imagen = ($_POST["imagen"] != "#" && $_POST["imagen"] != "") ? $_POST["imagen"] : "";
	$color = $_POST["color"];

	$data1 = model("registrarDocentes",compact("docente","ape_paterno","ape_materno","mail","password","nombre_usuario","telefono","id_entidad","id_municipio","localidad","imagen","escuelas","color"));

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
		$resultado = "Registro guardado correctamente.";
        sendToClient(compact("mensaje","resultado"));
	}
	else if($mensaje == "usuario")
	{
		$resultado = "El nombre de usuario no esta disponible.";
        sendToClient(compact("mensaje","resultado"));
	}
	else if($mensaje == "email")
	{
		$resultado = "El correo electrónico no esta disponible.";
        sendToClient(compact("mensaje","resultado"));
	}