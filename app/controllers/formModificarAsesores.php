<?php

	setPermission("root");
	endPermissions();

	$id_asesor = $_POST['id_asesor'];
	$data = model("buscarAsesor",  compact("id_asesor"));
	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_asesor === false)
	{
		//No hay registro
	}
	else
	{
		
		if($telefono == null)
		{
		    $telefono = "";
		}
		
		if($imagen == "default.png")
		{
			$imagen = "";
		}
		else
		{
			$imagen = URL_SERVER.URL_ASE_IMG.$imagen;
        }
        
        $data = model("conseguirFuncionesAsesor");

        extract($data);

        if(isset($error))
        {
            //ERRROR
        }
        else if($mensaje_adviser_functions === false)
        {
            //NO hay registro
        }
        else
        {
            $mensaje = $mensaje_adviser_functions;
            $informacion = $informacion_adviser_functions;
            $nombre = "una opción";
            $valor = $id_funcion;
            $selectTipoAsesor = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));
            
            view("formModificarAsesores",compact("id_asesor","nombre_asesor","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","imagen","selectTipoAsesor","estatus","color"));
        }

	}