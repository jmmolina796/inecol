<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$nombre = $_POST["nombre"];

	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_inicio_partes = explode("/", $fecha_inicio);
	$fecha_inicio = $fecha_inicio_partes[2]."/".$fecha_inicio_partes[1]."/".$fecha_inicio_partes[0];

	$fecha_fin = $_POST["fecha_fin"];
	$fecha_fin_partes = explode("/", $fecha_fin);
	$fecha_fin = $fecha_fin_partes[2]."/".$fecha_fin_partes[1]."/".$fecha_fin_partes[0];

	$data = model("registrarCiclosEscolares",compact("nombre","fecha_inicio","fecha_fin")); //Enviar las variables a mi modelo y después recuperarlas.

	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Registro insertado correctamente";
        sendToClient(compact("mensaje","resultado"));
	}