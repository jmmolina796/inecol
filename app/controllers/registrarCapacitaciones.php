<?php

	setPermission("root");
	endPermissions();

	$capacitacion_nombre = $_POST["capacitacion_nombre"];
    $capacitacion_descripcion = $_POST["capacitacion_descripcion"];
    $capacitacion_proyecto = $_POST["capacitacion_proyecto"];
	$capacitacion_sesiones = $_POST["capacitacion_sesiones"];

    $data = model("registrarCapacitaciones",compact("capacitacion_nombre","capacitacion_descripcion","capacitacion_proyecto","capacitacion_sesiones"));

    extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos.";
        sendToClient(compact("error","resultado"));
	}
	else
	{
		$resultado = "Registro insertado correctamente.";
        sendToClient(compact("mensaje","resultado"));
	}