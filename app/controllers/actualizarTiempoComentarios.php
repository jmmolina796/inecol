<?php

	$id_comentario = $_POST['id_comentario'];

	$data = model("conseguirTiempoComentarios",  compact("id_comentario"));

	extract($data);


	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_tiempo_comentarios === false)
	{
		//No hay registro
	}
	else
	{
            
            echo json_encode(compact("informacion_tiempo_comentarios"));
		
		
	}
	