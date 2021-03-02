<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_ciclo = $_POST["id_ciclo"];

	$data = model("buscarCicloEscolar",compact("id_ciclo")); 

	extract($data);

	if(isset($error))
	{
	    // aqui el codigo de Error 
	}
	else if($mensaje_ciclo_escolar === false)
	{
		//No hay registros
	}
	else
	{
		view("formConsultarCiclosEscolares",compact("fecha_inicio_ciclo_escolar","fecha_fin_ciclo_escolar","nombre_ciclo_escolar"));
	}