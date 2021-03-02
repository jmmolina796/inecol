 <?php

	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_ciclo = $_POST["id_ciclo"];

	$data = model("eliminarCiclosEscolares",compact("id_ciclo")); 

	extract($data);

	if(isset($error))
	{
		$resultado = "Hubo un error en la base de datos";
		sendToClient(compact("error","resultado")); 
	}
	else
	{
		$resultado = "Ciclo escolar dado de baja correctamente";
		sendToClient(compact("mensaje","resultado")); 
	}