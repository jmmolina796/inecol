<?php

	$id_publicacion = $_POST['id_publicacion'];

	$data = model("conseguirTiempoPublicacion",  compact("id_publicacion"));

	extract($data);


	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_tiempo_publicaciones === false)
	{
		//No hay registro
	}
	else
	{
            
            echo json_encode(compact("informacion_tiempo_publicaciones"));
		
		
	}
	