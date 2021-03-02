<?php

	$nombre_proyecto = $_POST["nombre_proyecto"];
	$nombre_carpeta = $_POST["nombre_carpeta"];

	view("formBajaProyectoCarpeta",compact("nombre_proyecto","nombre_carpeta"));