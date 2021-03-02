 <?php

 	setPermission("administrator");
	setPermission("root");
	endPermissions();

	$id_docente = $_POST["id_docente"];

	$data = model("eliminarDocentes",compact("id_docente")); 

	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Docente dado de baja correctamente";
        sendToClient(compact("mensaje","resultado"));
	}