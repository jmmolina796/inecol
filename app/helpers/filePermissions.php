<?php

	if(isRoot())
	{
		$files = array(
			"head",
			"body",
			"loader",
			"home",
			"header",
			"menu",
			"elementosMenu",
			"logueo",
			"iniciar_sesion",
			"cerrar_sesion",
			"seleccionar-proyectos",
			"configuracion",
			"footer"
		);	
	}

[-1][0] -> true = invitado

[0][0] -> true = docente inactivo
[0][1] -> true = docente activo con escuelas
[0][2] -> true = docente activo sin escuelas

[1][0] -> true = administrador inactivo
[1][1] -> true = administrador activo

[2][1] -> true = root

[3][0] -> true = asesor inactivo
[3][1] -> true = asesor activo


$files["head"] = array()

$file["configuracion"] = array(
	"0,2",
	"0,1",
	"1,2"
	);


if(isset($file["configuracion"]["3,1"]))







