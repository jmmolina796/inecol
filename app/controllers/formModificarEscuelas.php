<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$clave = $_POST["id_escuela"];

	$data1 = model("buscarEscuela",compact("clave"));
	extract($data1);
	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_escuela === false)
	{
		//No coincide
	}
	else
	{
		$data2 = model("conseguirNivelesEducativos");
		extract($data2);
		if(isset($error))
		{
			//ERRROR
		}
		else
		{
			$opt = "entidades";
			$data3 = model("conseguirEntidadesMunicipios",compact("opt"));
			extract($data3);
			if(isset($error))
			{
				//ERRROR
			}
			else
			{
				$opt = "municipios";
				$data4 = model("conseguirEntidadesMunicipios",compact("opt","id_entidad"));
				extract($data4);
				if(isset($error))
				{
					//ERRROR
				}
				else
				{

					$mensaje = $mensaje_niveles_educativos;
					$informacion = $informacion_niveles_educativos;
					$nombre = "el nivel educativo";
					$valor = $id_nivel_educativo;
					$selectNivel = builder("crearSelect",compact("informacion","mensaje","nombre","valor")); 

					$mensaje = $mensaje_entidades;
					$informacion = $informacion_entidades;
					$nombre = "el estado";
					$valor = $id_entidad;
					$selectEntidad = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

					$mensaje = $mensaje_municipios;
					$informacion = $informacion_municipios;
					$nombre = "el municipio";
					$valor = $id_municipio;
					$selectMunicipio = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

					$_SESSION["clave_escuela_old"] = $clave_escuela;
					view("formModificarEscuelas",compact("clave_escuela","escuela","nivel_educativo","entidad","municipio","localidad","estatus","selectNivel","selectEntidad","selectMunicipio"));
				}
			}
		}
	}