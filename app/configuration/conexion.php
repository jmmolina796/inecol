<?php

	$mysqli = new mysqli("127.0.0.1", "root", "password", "pasevic");

	if($mysqli->connect_errno)
	{
	    exit();
	}

	if ( !($mysqli->ping()) )
	{
	    exit();
	}

	$mysqli->set_charset("utf8");
