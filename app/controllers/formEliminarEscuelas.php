<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$nombre = $_POST["nombre"];
	$clave = $_POST["clave"];

	view("formEliminarEscuelas",compact("nombre","clave"));