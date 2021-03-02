<?php

	setPermission("root");
	endPermissions();

	$nombre = $_POST["nombre"];

	view("formEliminarAdministradores",compact("nombre"));