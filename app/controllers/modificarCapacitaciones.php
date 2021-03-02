<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$id_capacitacion = $_POST['id_capacitacion'];
	$capacitacion_nombre = $_POST["capacitacion_nombre"];
    $capacitacion_descripcion = $_POST["capacitacion_descripcion"];
    $capacitacion_proyecto = $_POST["capacitacion_proyecto"];
	$capacitacion_sesiones = $_POST["capacitacion_sesiones"];

    $data = model("modificarCapacitaciones",compact("id_capacitacion","capacitacion_nombre","capacitacion_descripcion","capacitacion_proyecto","capacitacion_sesiones"));
    
	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos.";
        sendToClient(compact("error","resultado"));
	}
	else
	{
		$resultado = "Registro modificado correctamente.";
        sendToClient(compact("mensaje","resultado"));
	}