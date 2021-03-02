<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_carpeta = $_POST["id_carpeta"];
	$nombre_carpeta = $_POST["nombre_carpeta"];

	view("formBajaCarpetas",compact("id_carpeta","nombre_carpeta"));