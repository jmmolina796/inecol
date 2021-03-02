<?php

	$session;

	if(isset($_SESSION["id_usuario"]))
	{
		$session = true;
	}
	else
	{
		$session = false;
	}
	
	sendToClient(compact("session"));