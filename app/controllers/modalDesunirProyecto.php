<?php

	$type = ($_POST["type"] == "p") ? "1" : "0";

	if($type == "1")
	{
		$mensaje = "¿Desea desunirse de este proyecto? Si lo hace, toda la información de este proyecto se perderá.";
		$boton = "Desunirse";
	}
	else
	{
		$mensaje = "¿Desea abandonar de este módulo? Si lo hace, toda la información de este módulo se perderá.";
		$boton = "Abandonar";
	}

	view("modalDesunirProyecto",compact("mensaje","boton"));