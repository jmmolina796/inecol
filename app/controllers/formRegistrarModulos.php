<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$data2 = model("conseguirGradosConNivelesEducativos");

	extract($data2);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_grados_niveles_educativos === false)
	{
		//No hay registros
	}
	else
	{
		$mensaje = $mensaje_grados_niveles_educativos;
		$informacion = $informacion_grados_niveles_educativos;
		$checkboxGrados = builder("crearCheckboxGrados",compact("informacion","mensaje"));

		view("formRegistrarModulos", compact("checkboxGrados"));
	}