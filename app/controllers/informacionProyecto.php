<?php

	$urlProyecto = $_POST["urlProyecto"];
        
	$data1 = model("buscarInformacionProyecto", compact("urlProyecto"));

	extract($data1);

	if(isset($error))
	{
		//ERRROR
	}
	else if($mensaje_informacion_proyecto === false)
	{
		//NO hay registros
	}
	else
	{    
        $nombre_docente_completo = $nombre_docente." ".$ape_materno." ".$ape_paterno;
        
        view("informacionProyecto",compact("mensaje_informacion_proyecto","nombre","nombre_docente_completo","descripcion","imagen_portada","fecha_inicio","fecha_fin","ciclo_escolar","nombre_docente","ape_paterno","ape_materno","nombre_usuario","nombre_escuela","clave_escuela","grado","grupo","fecha_ini_tex","fecha_fin_tex","estado","css_estado"));
	}
