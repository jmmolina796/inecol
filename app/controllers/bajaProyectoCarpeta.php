<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();
	
	$id_proyecto = $_POST['id_proyecto'];
	$id_carpeta = $_POST['id_carpeta'];
	$nombre_carpeta = $_POST['nombre_carpeta'];

	$data = model("bajaProyectoCarpeta",compact("id_carpeta","id_proyecto"));
	extract($data);
	
    if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        echo json_encode(compact("error","resultado"));
	}
	else
	{
        $resultado = "proyecto dado de baja de la carpeta ".$nombre_carpeta." correctamente";
        $mensaje = $mensaje_baja_proyectos_carpetas;
        echo json_encode(compact("mensaje","resultado"));
	}
	
