<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_ciclo = $_POST["id_ciclo_escolar"];
	
	$data = model("buscarCicloEscolar",compact("id_ciclo"));

	extract($data);

	$hoy = date("Y-m-d");

	$fecha_inicio_ciclo_escolar = str_replace('/', '-',$fecha_inicio_ciclo_escolar);
	$fecha_fin_ciclo_escolar = str_replace('/', '-',$fecha_fin_ciclo_escolar);

	$valida = false;

	if( strtotime($hoy) >= strtotime($fecha_inicio_ciclo_escolar) &&  strtotime($hoy) <= strtotime($fecha_fin_ciclo_escolar))
    {
        $valida = true;
    }

	if($valida===true)
	{
        sendToClient(compact("valida"));
	}
	else
	{
        sendToClient(compact("valida"));
	}