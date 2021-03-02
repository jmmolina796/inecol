<?php

$filtroBusqueda = $_POST['filtroBusqueda'];
$tipoBusqueda = $_POST['tipoBusqueda'];

$limit1 = $_POST['limit1'];
//$limit2 = 15;
$limit2 = 10;

	$data = model("conseguirCantidadRowsBusquedaPrincipal",  compact("filtroBusqueda","tipoBusqueda"));

	extract($data);

	

	$data = model("verMasResultadosBusquedaPrincipal",  compact("filtroBusqueda","tipoBusqueda","limit1","limit2"));

	extract($data);

	if(isset($error))
	{
		//ERROR
	}
	else if($mensaje_busqueda === false)
	{
		//No hay registros

		//view("crearDatosBusquedaPrincipalVacio");

	}
	else
	{

         $informacion = $informacion_busqueda_principal;
         $mensaje = $mensaje_busqueda;
		
		//$cantidadRows = $cantidadRows - ($limit1 + 15);

		$cantidadRows = $cantidadRows - ($limit1 + 10);

		$datosMasResultadosBusquedaPrincipal = builder("crearDatosMasResultadosBusquedaPrincipal",compact("informacion","mensaje","tipoBusqueda","cantidadRows"));

		echo $datosMasResultadosBusquedaPrincipal;
        

	}
	
