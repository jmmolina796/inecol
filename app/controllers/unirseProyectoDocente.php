<?php

    setPermission("teacher");
    endPermissions("@accessRequired");

	$id_proyecto = $_POST["id_proyecto"];
	$id_docente = $_SESSION["id_usuario"];
    $nombre_proyecto = $_POST["nombre_proyecto"];
    
    $data = model("conseguirGradosDocentesEscuelasUnionProyecto",compact("id_proyecto","id_docente"));
	
	extract($data);
        
    if(isset($error))
	{
		//ERROR
	}
    else if($mensaje_registro_docente === false)
    {
        view("formMostrarTablaGradosUnionProyectosVacio");
    }
    else
    {
         $data3 = model("conseguirGradosProyecto",compact("id_proyecto"));
         
         extract($data3);
         
        if(isset($error))
        {
            // Error vista
        }
        else 
        {

            $mensaje = $mensaje_grados_proyecto;
            $informacion = $informacion_grados_proyecto;
            $listaGradosNivelEdu = builder("crearListaGradosNivelEdProyectos",compact("mensaje","informacion"));

            $mensaje = $mensaje_registro_docente;
            $informacion = $informacion_registro_docente;
            $seleccionable = true;
            $excepcion = array("0","1");
            $contenidoTabla = builder("crearTablaUnirseProyecto",compact("mensaje","informacion","seleccionable","excepcion"));

            view("formMostrarTablaGradosUnionProyectos",compact("nombre_proyecto","id_proyecto","listaGradosNivelEdu","contenidoTabla"));   
        }
    }

	