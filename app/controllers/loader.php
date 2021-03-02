<?php

	if($varAux2 != "false")
	{
		if(isUrlClient())
		{
			return;
		}
	}

	$type = "";
	$class = "";
	if($varAux == "modal")
	{
		$type = "loader-modal";
	}
	else if($varAux == "principal")
	{
		$type = "loader-principal";
		$class = "ldr-global";
	}
	else if($varAux == "content")
	{
		if(!isSessionStarted())
		{
			return;
		}

		$type = "loader-content";
		$class = "ldr-global";
	}
	else if($varAux == "chat")
	{
		$type = "loader-chat";
		$class = "ldr-global";
	}
	else if($varAux == "docModules")
	{
		$type = "loader-docModules";
		$class = "ldr-global ldr-per";
	}
	else if($varAux == "docProjects")
	{
		$type = "loader-docProjects";
		$class = "ldr-global ldr-per";
	}
	else if($varAux == "searchPrl")
	{
		$type = "loader-searchPrl";
		$class = "ldr-global";
	}
	else if($varAux == "fltrMrRsltAux")
	{
		$type = "loader-fltrMrRsltAux";
		$class = "ldr-global";
	}

	view("loader", compact("type","class"));