 <?php

 	setPermission("administrator");
	setPermission("root");
	endPermissions();
 
	$nombre = $_POST["nombre"];

	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_inicio_partes = explode("/", $fecha_inicio);
	$fecha_inicio = $fecha_inicio_partes[2]."/".$fecha_inicio_partes[1]."/".$fecha_inicio_partes[0];


	$fecha_fin = $_POST["fecha_fin"];
	$fecha_fin_partes = explode("/", $fecha_fin);
	$fecha_fin = $fecha_fin_partes[2]."/".$fecha_fin_partes[1]."/".$fecha_fin_partes[0];

	$id_ciclo = $_POST["id_ciclo"];

	$data = model("modificarCiclosEscolares",compact("nombre","fecha_inicio","fecha_fin","id_ciclo")); 

	extract($data);

	if(isset($error))
	{
        $resultado = "Hubo un error en la base de datos";
        sendToClient(compact("error","resultado"));
	}
	else
	{
        $resultado = "Registro Modificado correctamente";
        sendToClient(compact("mensaje","resultado"));
	}