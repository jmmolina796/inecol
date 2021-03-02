<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_modulo = $_POST["id_modulo"];
	$data = model("buscarModulo",compact("id_modulo"));

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_modulo === false)
	{
		//No hay registros
	}
	else
	{
		$imagenBaseDatos = $imagen_portada; //Del modelo
		$grados = $_POST["grados"];
		$nombre = $_POST["modulo-nombre"];
		$descripcion = $_POST["modulo-descripcion"];
		$imagen_portada = ($_POST["imagen"] != "#" && $_POST["imagen"] != "") ? $_POST["imagen"] : "";
		$color = $_POST["color"];

		$data2 = model("modificarModulos", compact("id_modulo","nombre","descripcion","imagen_portada","grados","color"));
		
		extract($data2);

		if(isset($error))
		{
	        $resultado = "Hubo un error en la base de datos.";
	        sendToClient(compact("error","resultado"));
		}
		else if($mensaje === false)
		{
			$resultado = "Hubo un error en la base de datos.";
	        sendToClient(compact("mensaje","resultado"));
		}
		else
		{
			if($imagen_portada != $imagenBaseDatos)
			{
				$fldr = "imgMod";
				$nameFileToDelete = $imagenBaseDatos;
				load("gestionarArchivos",$fldr,$nameFileToDelete);
			}

			$resultado = "Registro modificado correctamente.";
	        sendToClient(compact("mensaje","resultado"));
		}
	}