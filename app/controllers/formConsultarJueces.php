<?php

	setPermission("root");
    endPermissions();

	$id_juez = $_POST['id_juez'];

	$data = model("buscarJuez", compact("id_juez"));

    extract($data);
	
	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_juez === false)
	{
		//No hay registro
	}
	else
	{
		if($telefono == null)
		{
		    $telefono="No tiene";
        }
        
        $data2 = model("conseguirProyectosCicloEscolarActual");

        extract($data2);

        if(isset($error))
        {
            //ERRROR
        }
        else 
        {

            $data3 = model("conseguirCiclosEscolaresActivos");
            extract($data3);

            if(isset($error))
            {
                // Error
            }
            else if($mensaje_ciclos_escolares_activos === false)
            {   
                // No ciclo escolar activo
            }
            else
            {
                $id_ciclo_escolar = $informacion_ciclos_escolares_activos[0][0];

                $data4 = model("conseguirProyectosCalificarJuez",compact("id_juez","id_ciclo_escolar"));
                extract($data4);

                if(isset($error))
                {
                    // Error
                }
                else
                {
                    $proyectos_calificar = array();

                    if($mensaje_proyectos_calificar_juez === true)
                    {   
                        foreach($informacion_proyectos_calificar_juez as $value) {
                            array_push($proyectos_calificar, $value[0]);
                        }
                    }

                    $proyectos_calificar = implode(",", $proyectos_calificar);

                    $mensaje = $mensaje_proyectos_ciclo_escolar;
                    $informacion = $mensaje_proyectos_ciclo_escolar ? $informacion_proyectos_ciclo_escolar : array();
                    $nombre = "una opción";
                    $valor = "none";
                    $selectProyectos = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

                    view("formConsultarJueces",compact("id_juez","nombre_juez","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","selectProyectos","proyectos_calificar","imagen","estatus"));
                }
            }
        }
		
	}