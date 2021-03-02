<?php

	$id_comentario_publicacion = $_POST["id_comn"];
	$id_publicacion = $_POST["id_pub"];
	$url_proyecto = $_POST["urlProyecto"];
	$id_usuario = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : "0"; //Es decir ninguno
	$rol = $_SESSION["rol"];
	$type = ($_POST["type"] == "p") ? "1" : "0";

	$data3 = model("verificarComentarios",compact("id_comentario_publicacion","id_publicacion","url_proyecto","id_usuario","rol","type")); 
	extract($data3);

	if(isset($error))
	{
        // vista error
	}
	else if($mensaje_verificar_comentarios === false)
	{
		// no hay nada que borrar (no creo que suceda esto);
	}
	else if($mensaje == '1')
	{
		$data5 = model("eliminarComentario",compact("id_comentario_publicacion","type")); 
		extract($data5);

		if(isset($error))
		{
	        // vista error
		}
		else if($mensaje_eliminar_comentarios === true)
		{
			sendToClient(compact("mensaje"));
		}
	}
	else
	{
		sendToClient(compact("mensaje"));
	}	