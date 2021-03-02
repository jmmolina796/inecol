<?php

	function projectLink($project)
	{
		return URL_SERVER."proyectos/".$project;
	}

	function moduleLink($module)
	{
		return URL_SERVER."modulos/".$module;
	}

	function administratorProfileLink($user)
	{
		return URL_SERVER."administradores/".$user;
	}

	function adviserProfileLink($user)
	{
		return URL_SERVER."asesores/".$user;
	}

	function judgeProfileLink($user)
	{
		return URL_SERVER."jueces/".$user;
	}

	function trainerProfileLink($user)
	{
		return URL_SERVER."capacitadores/".$user;
	}

	function teacherProfileLink($user)
	{
		return URL_SERVER."docentes/".$user;
	}

	function schoolLink($key)
	{
		return URL_SERVER."escuelas/".$key;
	}

	function userModules($user)
	{
		return "docentes/".$user."/modulos";
	}

	function userProjects($user)
	{
		return "docentes/".$user."/proyectos";
	}

	function userModuleLink($module)
	{
		return URL_SERVER."modulos-participantes/".$module;
	}

	function userProjectLink($project)
	{
		return URL_SERVER."proyectos-participantes/".$project;
	}

	function folderLink($folder)
	{
		return URL_SERVER."carpetas/".$folder;
	}

	function searchLink($type,$filter)
	{
		return URL_SERVER."busqueda/".$type."/".$filter;
	}

	function messagesLink()
	{
		return URL_SERVER."mensajes";
	}

	function chatsLink($user)
	{
		return URL_SERVER."mensajes/".$user;
	}

	function modulesLink($type,$module,$file,$fol = "",$comp = true)
	{
		$file = rawurlencode($file);
		$module = rawurlencode($module);
		$url = "";

		if($fol != "")
		{
			$fol = rawurlencode($fol);
			$fol .= "/";
		}

		if($comp)
		{
			$url .= URL_SERVER."public/modulos/";
		}

		if($type == "1")
		{

			$url .= "preescolar/".$module."/".$fol.$file;
		}
		else if($type == "2")
		{
			$url .= "especial/".$module."/".$fol.$file;
		}
		else if($type == "3")
		{
			$url .= "primaria/".$module."/".$fol.$file;
		}
		else if($type == "4")
		{
			$url .= "secundaria/".$module."/".$fol.$file;
		}

		return $url;
	}