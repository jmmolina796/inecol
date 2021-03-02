<?php

	session_start();
	require 'app/configuration/global.php';
	require 'app/helpers/verificar.php';
	require 'app/helpers/files.php';
	require 'app/helpers/principal.php';
	require 'app/helpers/urls.php';
	require 'app/helpers/users.php';
	require 'app/helpers/utilities.php';
	require 'app/helpers/validation.php';

	validationGlobal();
	identifyingUser();

	if( (isset($_FILES) && !empty($_FILES)) || (isset($_GET["url"]) && $_GET["url"] == "descargarModulo" ) )
	{
		$communication = "fil";
	}
	else
	{
		$communication  = isset($_POST["comm"]) ? $_POST["comm"] : "sync";
	}

	if((isset($_POST["ldfl"]) && $_POST["ldfl"] == true))
	{
		if($GLOBALS["USER_REQUESTING"] == "@UNDEFINED")
		{
			mensajeErrorSesion();
		}
		if(isSessionStarted())
		{
			if($GLOBALS["USER_REQUESTING"] == "@FALSE")
			{
				sessionStarted();
			}

			if($GLOBALS["USER_REQUEST"]["informacion_usuario"] == "0" || $GLOBALS["USER_REQUEST"]["informacion_usuario"] == "3")  //Colocarla en permisos
			{
				mensajeCuentaCancelada();
			}
		}

		clientUrl();
		exit();
	}

	if($communication == "sync")
	{
		start();
	}
	else
	{
		if($GLOBALS["USER_REQUESTING"] == "@UNDEFINED")
		{
			mensajeErrorSesion();
		}

		userRequesting();

		if(isSessionStarted())
		{

			if($GLOBALS["USER_REQUESTING"] == "@FALSE")
			{
				sessionStarted();
			}

			if($GLOBALS["USER_REQUEST"]["informacion_usuario"] == "0" || $GLOBALS["USER_REQUEST"]["informacion_usuario"] == "3")  //Colocarla en permisos
			{
				mensajeCuentaCancelada();
			}
		}


		if($communication == "fil")
		{
			$name = isset($_GET["url"]) ? $_GET["url"] : "";
			$name = getNameFile($name);
		}
		else
		{
			$name = getNameFile();
		}
		load($name);
	}