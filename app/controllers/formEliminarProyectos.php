<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$nombre = $_POST["nombre"];
	$fecha = $_POST["fecha"];

	view("formEliminarProyectos",compact("nombre","fecha"));