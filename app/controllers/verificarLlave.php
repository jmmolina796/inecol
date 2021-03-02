<?php

	$llave = $_POST["llave"];

	$data = model("verificarLlave",compact("llave"));

	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos.";
        echo json_encode(compact("error","resultado"));
	}
	else if($mensaje === false)
	{
		$resultado = "La llave es incorrecta.";
        echo json_encode(compact("mensaje","resultado"));
	}
	else if($mensaje === true)
	{
        echo json_encode(compact("mensaje"));
        $_SESSION["enter"] = true;
	}