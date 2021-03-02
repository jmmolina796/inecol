<?php 

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$clave = $_POST["escuela-clave"];
	$escuela = $_POST["escuela-nombre"];
	$nivel = $_POST["escuela-nivelE"];
	$entidad = $_POST["escuela-entidad"];
	$municipio = $_POST["escuela-municipio"];
	$localidad = $_POST["escuela-localidad"];

	$data = model("registrarEscuelas",compact("clave", "escuela", "nivel", "entidad", "municipio", "localidad"));

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
	else if($mensaje == "clave")
	{
		$resultado = "La clave de la escuela ya está registrada.";
        sendToClient(compact("mensaje","resultado"));
	}