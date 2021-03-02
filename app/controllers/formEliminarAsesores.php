<?php

	setPermission("root");
	endPermissions();

	$nombre = $_POST["nombre"];

	view("formEliminarAsesores",compact("nombre"));