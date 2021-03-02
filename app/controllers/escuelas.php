<?php

	$numero_docentes = "0";
	$tipo = "0";

	if(isSessionStarted())
	{
		if(isAdviser())
		{
			$tipo = $_SESSION["id_funcion"];
		}
	}

	$data = model("conseguirEscuelasUsuarios",compact("numero_docentes","tipo"));
	extract($data);

	if(isset($error))
	{
		//ERRROR
	}
	else if($mensaje_escuelas_usuarios === false)
	{
		$htmlTabla = "<p class='noEscuelas'>No se encontraron escuelas.</p>";
	}
	else
	{
		$mensaje = $mensaje_escuelas_usuarios;
		$informacion = $informacion_escuelas_usuarios;
		$seleccionable = false;
		$excepcion_col = array("7");
		$link = "escuelas";
		$positionLink = "8";

		$contenidoTablaEscuelas = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col","link","positionLink"));

		$htmlTabla = builder("crearTablaEscuelas",compact("contenidoTablaEscuelas"));

	}
        $informacion_tipo_escuelas = array();
		$informacion_tipo_escuelas[] = array(0,"Todas");
		$informacion_tipo_escuelas[] = array(1,"Preescolar estatal");
		$informacion_tipo_escuelas[] = array(2,"Preescolar federal");
		$informacion_tipo_escuelas[] = array(3,"Educación especial estatal");
		$informacion_tipo_escuelas[] = array(4,"Educación especial federal");
		$informacion_tipo_escuelas[] = array(5,"Primaria estatal");
		$informacion_tipo_escuelas[] = array(6,"Primaria federal");
		$informacion_tipo_escuelas[] = array(7,"Educación indígena");
		$informacion_tipo_escuelas[] = array(8,"Secundarias generales");
		$informacion_tipo_escuelas[] = array(9,"Secundarias técnicas");
		$informacion_tipo_escuelas[] = array(10,"Secundarias estatales");
		$informacion_tipo_escuelas[] = array(11,"Telesecundarias");

		$mensaje = true;
		$informacion = $informacion_tipo_escuelas;
		$nombre = "una opción";
		$valor = "12";

		if(isSessionStarted())
		{
			if(isAdviser())
			{
				$valor = $_SESSION["id_funcion"];
			}
		}

		$selectTipoEscuela = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

	view("escuelas",compact("htmlTabla","selectTipoEscuela"));