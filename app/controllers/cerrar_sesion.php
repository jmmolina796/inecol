<?php
	
	closeSession();

	$message = "true";
	sendToClient(compact($message));