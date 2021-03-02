<?php

	setPermission("root");
	endPermissions();
	
	if(isset($_POST['id_juez']))
	{
		$id_juez = $_POST['id_juez'];	
		$passwordNew = $_POST["password"];
		
		$dataJuez = model("buscarJuez",compact("id_juez"));
		extract($dataJuez);
	}
	else
	{
		$id_juez = $_SESSION["id_usuario"];
		$passwordNew = "";

		$dataJuez = model("buscarJuez",compact("id_juez"));
		extract($dataJuez);

	}

	$imagenBaseDatos = $imagen; //Del modelo
	$nombre = $_POST["nombre"];
	$ape_paterno = $_POST["ape_paterno"];
	$ape_materno = $_POST["ape_materno"];
	$email = $_POST["email"];
    $nombre_usuario = $_POST["nombre_usuario"];
    $proyectos_calificar = ($_POST["proyectos_calificar"] == "") ? array() : $_POST["proyectos_calificar"];
	$telefono = $_POST["telefono"];
	$imagen = ($_POST["imagen"] != "#" && $_POST["imagen"] != "") ? $_POST["imagen"] : "";
    $color = $_POST["color"];
    
    $data1 = model("conseguirCiclosEscolaresActivos");
    extract($data1);

    if(isset($error))
    {
        // Error
    }
    else if($mensaje_ciclos_escolares_activos === false)
    {   
        $id_ciclo_escolar = "-1";
    }
    else
    {
        $id_ciclo_escolar = $informacion_ciclos_escolares_activos[0][0];
    }

	$data2 = model("modificarJueces",compact("id_juez","nombre","ape_paterno","ape_materno","email","passwordNew","nombre_usuario","proyectos_calificar","telefono","imagen","color", "id_ciclo_escolar"));

	extract($data2);
	

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos.";
        sendToClient(compact("error","resultado"));
	}
	else if($mensaje === false)
	{
		$resultado = "Hubo un error en la base de datos.";
        sendToClient(compact("mensaje","resultado"));
	}
	else if($mensaje === true)
	{
		if($imagen != $imagenBaseDatos)
		{
			$fldr = "imgAdm";
			$nameFileToDelete = $imagenBaseDatos;
			load("gestionarArchivos",$fldr,$nameFileToDelete);
		}

		if(isset($_POST['id_juez']))
		{
			$resultado = "Registro modificado correctamente.";
		}
		else
		{
			$resultado = "Se ha modificado tu información correctamente.";

			$_SESSION["id_usuario"] = $id_juez;
			$_SESSION["rol"] = $_SESSION["rol"];
			$_SESSION["usuario"] = $nombre_usuario;
			$_SESSION["imagen"] = $imagen != "" ? $imagen : $_SESSION["imagen"];

		}
        sendToClient(compact("mensaje","resultado"));
	}
	else if($mensaje == "usuario")
	{
		$resultado = "El nombre de usuario ya ha sido elegido por otra persona.";
	    sendToClient(compact("mensaje","resultado"));
	}
	else if($mensaje == "email")
	{
		$resultado = "El correo electrónico ya ha sido elegido por otra persona.";
	    sendToClient(compact("mensaje","resultado"));
	}