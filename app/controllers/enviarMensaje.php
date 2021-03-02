<?php

	setPermission("teacher");
	setPermission("administrator");
	setPermission("adviser");
	setPermission("root");
	endPermissions();

	$id_emisor = $_SESSION["id_usuario"];
	$rol_emisor = $_SESSION["rol"];
	$nombre_usuario = $_POST["nombre_usuario"];
	$mensaje = $_POST["mensaje"];

	$data = model("enviarMensaje",compact("id_emisor","rol_emisor","nombre_usuario","mensaje"));

	extract($data);

	if(isset($error))
	{
        //Error
	}
	else if($mensaje == false)
	{
		//No va a pasar siempre responderá con algo
	}
	else
	{
        $men = builder("crearMensajeChat",compact("id_comentario","comentario","css_mensaje","fecha_comentario","dia","ultimo_dia_mensaje","visto_receptor"));
        $text = $comentario;
        $date = $dia;
        $idM = $id_comentario;

        sendToClient(compact("men","idM","text","date"));
	}