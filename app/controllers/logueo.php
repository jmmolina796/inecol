<?php

	if(isSessionStarted())
	{
		sessionStarted();
	}

	$error = isset($_SESSION["error"]) ? "Usuario o contraseña incorrecto." : "";
	if( isset($_POST["cerrar"]) &&  $_POST["cerrar"] == "close" )
	{
		$_SESSION = array();
	}
	if( isset($_SESSION["error"]) )
	{
		view("logueo", compact("error"));
		$_SESSION = array();
	}
	else if( isset($_SESSION["user"]) )
	{
		//header("Location: /pasevic_sesion");
	}
	else
	{
		view("logueo");
	}