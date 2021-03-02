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

  	$proyectos_calificar = ($_POST["proyectos_calificar"] == "") ? array() : $_POST["proyectos_calificar"];

	$imagen = ($_POST["imagen"] != "#" && $_POST["imagen"] != "") ? $_POST["imagen"] : "";

	$color = $_POST["color"];

	$data = model("conseguirCiclosEscolaresActivos");
	extract($data);

	if(isset($error))
	{
		exit();
	}
	else if($mensaje_ciclos_escolares_activos === false)
	{   

	}
	else
	{
		$id_ciclo_escolar_activo = $informacion_ciclos_escolares_activos[0][0];
		
		$data = model("registrarJueces",compact("nombre","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","imagen","proyectos_calificar","color","id_ciclo_escolar_activo"));

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
	}
	
