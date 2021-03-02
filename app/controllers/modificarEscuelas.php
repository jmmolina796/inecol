<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$clave_escuela = $_POST["escuela-clave"];
	$id_nivel_educativo = $_POST["escuela-nivelE"];
	$id_entidad = $_POST["escuela-entidad"];
	$id_municipio = $_POST["escuela-municipio"];
	$nombre_escuela = $_POST["escuela-nombre"];
	$nombre_localidad = $_POST["escuela-localidad"];
	$clave_escuela_old = $_SESSION["clave_escuela_old"];

	$data = model("modificarEscuelas",compact("clave_escuela","id_nivel_educativo","id_entidad","id_municipio","nombre_escuela","nombre_localidad","clave_escuela_old"));

	extract($data);

	if(isset($error))
	{
		$resultado = "Hubo un error en la base de datos.";
        echo json_encode(compact("error","resultado"));
	}
	else if($mensaje === false)
	{
		$resultado = "Hubo un error en la base de datos.";
        echo json_encode(compact("error","resultado"));
	}
	else if($mensaje === true)
	{
		$resultado = "La escuela se ha modificado correctamente.";
		if(isset($_SESSION["clave_escuela_old"]))
		{
			unset($_SESSION["clave_escuela_old"]);
		}
        echo json_encode(compact("mensaje","resultado"));
	}
	else if($mensaje == "clave")
	{
		$resultado = "La clave de la escuela ya está registrada.";
        echo json_encode(compact("mensaje","resultado"));
	}