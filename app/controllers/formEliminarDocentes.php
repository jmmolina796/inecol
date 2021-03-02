<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$nombre = $_POST["nombre"];

	view("formEliminarDocentes",compact("nombre"));