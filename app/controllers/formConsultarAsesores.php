<?php

	setPermission("root");
    endPermissions();

	$id_asesor = $_POST['id_asesor'];

	$data = model("buscarAsesor", compact("id_asesor"));

	extract($data);
	
	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_asesor === false)
	{
		//No hay registro
	}
	else
	{
		if($telefono == null)
		{
		    $telefono="No tiene";
		}

		view("formConsultarAsesores",compact("id_asesor","nombre_asesor","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","imagen","nombre_funcion","estatus"));
		
	}