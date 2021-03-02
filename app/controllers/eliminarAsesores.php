<?php

	setPermission("root");
	endPermissions();

	$id_asesor = $_POST["id_asesor"];
	$data = model("eliminarAsesores",compact("id_asesor"));

	extract($data);

	if(isset($error))
	{
		$resultado = "Hubo un error en la base de datos";
		echo json_encode(compact("error","resultado"));
	}
	else
	{
		$resultado = "Asesor dado de baja correctamente";
		echo json_encode(compact("mensaje","resultado"));
	}