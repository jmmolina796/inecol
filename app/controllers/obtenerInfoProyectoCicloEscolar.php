<?php

	
	$urlProyecto = $_POST["urlProyecto"];
	$id_ciclo_escolar = $_POST["id_ciclo_escolar"];


	$data = model("buscarProyectoByCicloEscolar",compact("urlProyecto","id_ciclo_escolar"));
	extract($data);

	if(isset($error))
	{
		// view("notfound");
	}
	else if($mensaje_proyecto === false)
	{
		// view("notfound");
	}
	else
	{

		$url = projectLink($url);

		sendToClient(compact("url"));
		
	}