<?php

	function start()
	{
		$file = "app/controllers/index.php";
		require $file;
	}

	function clientUrl()
	{
		userRequesting();
		verify();
		setTitle();
		controller();
	}

	function builder($name, $vars = array())
	{
		extract($vars);
		require "app/builders/$name.php";
		return $contentHtml;
	}

	function model($name, $vars = array())
	{
		require 'app/configuration/conexion.php';
		extract($vars);
		require "app/models/$name.php";
    	
    	$mysqli->close();

		return $data;
	}
	function view($template, $vars = array())
	{
		extract($vars);
		$file = "app/views/$template.".(file_exists("app/views/$template.sync.php") ? "sync" : "async").".php";

		include $file;

		/*ob_start();
		include $file;
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;*/
	}

	function controller()
	{
		if($GLOBALS["exists"])
		{
			$name = $GLOBALS["file"];
			extract($GLOBALS["vars"]);
			require "app/controllers/$name.php";
		}
		else
		{
			require "app/controllers/notfound.php";
		}
		emptyGlobals();
	}

	function load($name, $varAux = "", $varAux2 = "")
	{

		$file = "app/controllers/$name.php";
		if(file_exists($file))
		{
			require "app/controllers/$name.php";
		}
	}

	function sendToClient($vars = array())
	{
        echo json_encode($vars);
	}

	function setUrlClient($val)
	{
		$GLOBALS["URL_CLIENT"] = $val;
	}

	function isUrlClient()
	{
		return $GLOBALS["URL_CLIENT"];
	}
	function setTitle()
	{
		echo "<div id='cntWpgUrl'>".urldecode($GLOBALS["title"])."</div>";
	}

	function setClassPrincipal()
	{

		if($GLOBALS["file"] == "home" && !isSessionStarted())
		{
			return "home";
		}
	}