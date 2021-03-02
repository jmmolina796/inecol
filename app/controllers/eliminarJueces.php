<?php

	setPermission("root");
	endPermissions();

	$id_juez = $_POST["id_juez"];
	$data = model("eliminarJueces",compact("id_juez"));

	extract($data);

	if(isset($error))
	{
		$resultado = "Hubo un error en la base de datos";
		echo json_encode(compact("error","resultado"));
	}
	else
	{
		$resultado = "Juez dado de baja correctamente";
		echo json_encode(compact("mensaje","resultado"));
	}