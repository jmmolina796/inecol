<?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_capacitacion = $_POST["id_capacitacion"];

	$data1 = model("buscarCapacitaciones",compact("id_capacitacion"));

    extract($data1);

	if(isset($error))
	{
        //ERROR
	}
	else if($mensaje_capacitacion === false)
	{
        //Registro no encontrado
	}
	else
	{

        $data2 = model("conseguirProyectosCicloEscolarActual");

        extract($data2);

        if(isset($error))
        {
            //ERRROR
        }
        else 
        {
            $data3 = model("conseguirCapSesiones",compact("id_capacitacion"));
            
            extract($data3);
            
            if(isset($error))
            {
                //ERROR
            }
            else if($mensaje_cap_sesiones === false)
            {
                //Registro no encontrado
            }
            else
            {

                $mensaje = $mensaje_proyectos_ciclo_escolar;
                $informacion = $mensaje_proyectos_ciclo_escolar ? $informacion_proyectos_ciclo_escolar : array();
                $nombre = "una opción";
                $valor = $id_capacitacion;
                $selectProyectos = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

                $mensaje = $mensaje_cap_sesiones;
                $informacion = $mensaje_cap_sesiones ? $informacion_cap_sesiones : array();
                $editable = true;
                $capSesiones = builder("nuevaSesionCapacitacion",compact("informacion","mensaje","editable"));

                view("formModificarCapacitaciones",compact("id_capacitacion","nombre_capacitacion","descripcion_capacitacion","selectProyectos","capSesiones"));
            }
        }

	}