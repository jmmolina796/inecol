<?php
	
	function getTitle($title = "")
	{
		if($title == "")
		{
			$request = getPaths();

			$files = array(
			    "home" => "INECOL",
			    "configuracion" => "Configuración",
			    "descargar-modulos" => "Descargar módulos SEVIC",
			    "seleccionar-proyectos" => "Seleccionar proyectos",
			    "seleccionar-modulos" => "Seleccionar módulos",
			    "soporte" => "Soporte",
			    "mensajes" => "Mensajes",
			    "registro-docentes" => "Registrar un docente",
			    "prensa" => "Prensa",
			    "contacto" => "Contacto - Sitio en desarrollo",
			    "alianzas-y-proyectos" => "Alianzas y proyectos - Sitio en desarrollo"
			);

			if(isset($files[$request]))
			{
				$title = $files[$request];
			}
			else
			{
				$title = "No encontrado";
			}
		}
		else
		{
			$GLOBALS["title"] = $title;
		}
		return $title;
	}