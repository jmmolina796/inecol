<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$nombre = $_POST["nombre"];

	view("formEliminarCapacitaciones",compact("nombre"));