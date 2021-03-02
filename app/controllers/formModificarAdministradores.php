<?php

	setPermission("root");
	endPermissions();

	$id_administrador = $_POST['id_administrador'];
	$data = model("buscarAdministrador",  compact("id_administrador"));
	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_administrador === false)
	{
		//No hay registro
	}
	else
	{
		
		if($telefono == null)
		{
		    $telefono = "";
		}
		
		if($imagen == "default.png")
		{
			$imagen = "";
		}
		else
		{
			$imagen = URL_SERVER.URL_ADM_IMG.$imagen;
		}

		view("formModificarAdministradores",compact("id_administrador","nombre_administrador","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","imagen","estatus","color"));
	}