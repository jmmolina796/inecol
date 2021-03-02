<?php

	if(isSessionStarted())
	{
		$imagen = $_SESSION["imagen"];

	    if(isTeacher())
	    {
	        $imagen = URL_SERVER.URL_DOC_IMG.$imagen;
	    }
	    else
	    {
	    	$imagen = URL_SERVER.URL_ADM_IMG.$imagen;
	    }

		view("botonMiCuenta",compact("imagen"));
	}
