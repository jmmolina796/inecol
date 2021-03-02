<?php

	setPermission("root");
	endPermissions();

	$nombre = $_POST["nombre"];

	view("formEliminarJueces",compact("nombre"));