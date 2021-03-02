<?php

	$type = $_POST["mod"];
	$dir = $_SERVER['DOCUMENT_ROOT']."/";
	$flag = false;

	if($type == 1)
	{
		$dir.="public/modulos/preescolar";
		$flag = true;
	}
	else if($type == 2)
	{
		$dir.="public/modulos/especial";
		$flag = true;
	}
	else if($type == 3)
	{
		$dir.="public/modulos/primaria";
		$flag = true;
	}
	else if($type == 4)
	{
		$dir.="public/modulos/secundaria";
		$flag = true;
	}

	if($flag)
	{
		$linksModulos = builder("crearLinkModulos",compact("type","dir"));

		view("modulosFiltro",compact("linksModulos"));

	}
