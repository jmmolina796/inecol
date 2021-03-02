<?php

	$type = $_POST["type"];
	$link = $_POST["url"];

	$message = "false";

	if($link == "default.png")
	{
		sendToClient(compact("message"));
		exit();
	}
	
	$flag = false;

	if($type == "pubImg")
	{
		$type = "imgPub";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}
	else if($type == "pubImgMod")
	{
		$type = "imgPubMod";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}
	else if($type == "pubFl")
	{
		$type = "filPub";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}
	else if($type == "pubFlMod")
	{
		$type = "filPubMod";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}
	else if($type == "admImg")
	{
		$type = "imgAdm";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}
	else if($type == "aseImg")
	{
		$type = "imgAse";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}
	else if($type == "jueImg")
	{
		$type = "imgJue";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}
	else if($type == "capImg")
	{
		$type = "imgCap";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}
	else if($type == "docImg")
	{
		$type = "imgDoc";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}
	else if($type == "proImg")
	{
		$type = "imgPro";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}
	else if($type == "modImg")
	{
		$type = "imgMod";
		$data = model("verificarUrlMultimedia",compact("type","link"));
		$flag = true;
	}


	if($flag === true)
	{
		extract($data);
		if(isset($error))
		{

		}
		else if($mensaje_url_multimedia === false)
		{

		}
		else
		{
			if($existe_url_multimedia == "0")
			{
				$nameFileToDelete = $link;
				$fldr = $type;
				load("gestionarArchivos",$fldr,$nameFileToDelete);

				$message = "true";
			}
		}
	}
	sendToClient(compact("message"));