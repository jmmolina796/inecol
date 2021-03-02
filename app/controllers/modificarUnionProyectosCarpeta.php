<?php

	$id_carpeta = $_POST["id_carpeta"];
	$nombre_carpeta = $_POST["nombre_carpeta"];
	$joinProyects = $_POST["joinProyects"]; 

	if($joinProyects=="1")
	{
		$array_ids_proyectos = $_POST["array_ids_proyectos"];
	}
	else
	{
		$array_ids_proyectos="";
	}

	
	$data = model("modificarUnionProyectosCarpeta",compact("id_carpeta","array_ids_proyectos","nombre_carpeta","joinProyects"));
	
	extract($data);
	
	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        echo json_encode(compact("error","resultado"));
	}
	else
	{
        $resultado = "Carpeta modificada correctamente";
        $mensaje = $mensaje_update_carpetas;
        echo json_encode(compact("mensaje","resultado"));
	}
