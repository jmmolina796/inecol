<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_modulo = $_POST["id_modulo"];

	$data = model("buscarModulo",compact("id_modulo"));

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_modulo === false)
	{
		//No hay registros
	}
	else
	{
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
			$data3 = model("conseguirGradosModulos",compact("id_modulo"));

			extract($data3);

			if(isset($error))
			{
				//ERROR
			}
			else if($mensaje_grados_modulo === false)
			{
				//No hay registros
			}
			else
			{
				
				if($imagen_portada == "default.png")
				{
					$imagen_portada = "";
				}
				else
				{
					$imagen_portada = URL_SERVER.URL_MOD_IMG.$imagen_portada;
				}

				$mensaje = $mensaje_grados_niveles_educativos;
				$informacion = $informacion_grados_niveles_educativos;
				$type = "enable";
				$values = $informacion_grados_modulo;
				$checkboxGrados = builder("crearCheckboxGrados",compact("informacion","mensaje","type","values"));

				view("formModificarModulos", compact("id_modulo","nombre_modulo","nombre_administrador","fecha_creacion","descripcion","imagen_portada","estatus","color","informacion_grados_proyectos","checkboxGrados"));
			}
		}
	}