<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_ciclo_escolar = $_POST["id_ciclo_escolar"];

	$data = model("altaCiclosEscolares",compact("id_ciclo_escolar"));

	extract($data);

	if(isset($error))
	{
		$resultado = "Hubo un error en la base de datos";
		sendToClient(compact("error","resultado"));
	}
	else
	{
		$resultado = "Ciclo escolar dado de alta correctamente";
		sendToClient(compact("mensaje","resultado"));
	}