<?php

	$imagenes = ( isset($_POST["urlsImg"]) ? ($_POST["urlsImg"]) : ("") );
	$archivos = ( isset($_POST["urlsFl"]) ? ($_POST["urlsFl"]) : ("") );
	$type = ($_POST["type"] == "p") ? "1" : "0" ;

	if($imagenes != "")
	{
		$type = ($type == "1") ? "imgPub" : "imgPubMod";
		for($x=0; $x<sizeof($imagenes);$x++)
		{
		    $link = $imagenes[$x][0]["url_imagen"];
		    $data = model("verificarUrlMultimedia",compact("type","link"));
		    extract($data);
			if($existe_url_multimedia == "0")
			{
				$nameFileToDelete = $link;
				$fldr = $type;
				load("gestionarArchivos",$fldr,$nameFileToDelete);
			} 
		}
	}

	if($archivos != "")
	{
		$type = ($type == "1") ? "filPub" : "filPubMod";
		for($x=0; $x<sizeof($archivos);$x++)
		{
		    $link = $archivos[$x][0]["url_archivo"];
		    $data = model("verificarUrlMultimedia",compact("type","link"));
		    extract($data);
			if($existe_url_multimedia == "0")
			{
				$nameFileToDelete = $link;
				$fldr = $type;
				load("gestionarArchivos",$fldr,$nameFileToDelete);
			} 
		}
	}