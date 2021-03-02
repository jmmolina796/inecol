<?php

	$nombre = $_POST["name"];
	$link = $_POST["link"];

	view("archivoPublicacion",compact("nombre","link"));