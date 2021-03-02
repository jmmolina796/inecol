<?php

	date_default_timezone_set('Mexico/General');

	//Show errors
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	mb_internal_encoding('UTF-8');
	mb_http_output('UTF-8');

	//Hide errors
	// error_reporting(0);
	// ini_set('display_errors', 0);

	define("SALT","Q=0&l#oP,!Z>N?5k<s%fAJ8@D_9Wm$");

	define("URL_SERVER","http://localhost:8080/");

	define("URL_ADM_IMG", "public/imagenes-administrador/");
	define("URL_ASE_IMG", "public/imagenes-asesor/");
	define("URL_JUE_IMG", "public/imagenes-juez/");
	define("URL_DOC_IMG", "public/imagenes-docente/");
	define("URL_CAP_IMG", "public/imagenes-capacitador/");
	define("URL_MOD_IMG", "public/imagenes-modulo/");
	define("URL_PRO_IMG", "public/imagenes-proyecto/");
	define("URL_PUB_IMG", "public/imagenes-publicaciones/");
	define("URL_PMOD_IMG", "public/imagenes-publicaciones-mod/");

	define("URL_PUB_FL", "public/archivos-publicaciones/");
	define("URL_PMOD_FL", "public/archivos-publicaciones-mod/");

	//$GLOBALS["USER_REQUESTING"] = ( !isset($_POST["USR_SESS"]) || empty($_POST["USR_SESS"]) ) ? ("") : ($_POST["USR_SESS"]);

	if( (isset($_FILES) && !empty($_FILES)) )
	{
		$GLOBALS["USER_REQUESTING"] = ( !isset($_GET["USR_SESS"]) ) ? ("@FALSE") : ($_GET["USR_SESS"]);
	}
	else
	{
		$GLOBALS["USER_REQUESTING"] = ( !isset($_POST["USR_SESS"]) ) ? ("@FALSE") : ($_POST["USR_SESS"]);
	}

	$GLOBALS["USER_REQUEST"] = array();
	$GLOBALS["AUTHENTICATION"] = false;
	$GLOBALS["USER_ACCESS"] = false;
	$GLOBALS["PERMISSION_SET"] = "";


	$GLOBALS["vars"] = array();
	$GLOBALS["exists"] = false;
	$GLOBALS["file"] = "";
	$GLOBALS["title"] = "";

	$URL_CLIENT = (isset($_POST["ldfl"]) && $_POST["ldfl"] == true) ? true : false;


	function emptyGlobals()
	{
		$GLOBALS["vars"] = array();
		$GLOBALS["exists"] = false;
		$GLOBALS["file"] = "";
		$GLOBALS["title"] = "";
	}
