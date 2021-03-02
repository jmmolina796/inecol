<?php

	if(isset($_SESSION["id_usuario"]))
	{
		if($_SESSION["id_usuario"] != 0)
		{
			$imagen = URL_SERVER.URL_ADM_IMG."default.png";
		}
		else
		{
			$imagen = URL_SERVER.URL_DOC_IMG."default.png";
		}
		echo $imagen;
	}