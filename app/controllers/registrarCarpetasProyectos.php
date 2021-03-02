<?php
	
	setPermission("administrator");
	setPermission("root");
	endPermissions();

	//$array_ids_proyectos = $_POST['array_ids_proyectos'];
	$nombre_carpeta = $_POST['nombre_carpeta'];
	$joinProyects = $_POST["joinProyects"]; 

	if($joinProyects=="1")
	{
		$array_ids_proyectos = $_POST["array_ids_proyectos"];
	}
	else
	{
		$array_ids_proyectos="";
	}

	$data = model("generarLink");
   
    extract($data);
    
    $url = $link_proyecto;

	$data = model("registrarCarpetasProyectos",compact("nombre_carpeta","array_ids_proyectos","url","joinProyects"));
	extract($data);

	if(isset($error))
	{
		$resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));

    }
    else
    {
        $resultado = "Registro insertado correctamente";
        $mensaje = $mensaje_carpetas;
        sendToClient(compact("resultado","mensaje"));
    }
	
