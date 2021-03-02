<?php

    setPermission("teacher");
    endPermissions("@accessRequired");

	$id_modulo = $_POST["id_modulo"];
	$id_docente = $_SESSION["id_usuario"];
    $nombre_modulo = $_POST["nombre_modulo"];

    $data = model("conseguirGradosDocentesEscuelasUnionModulo",compact("id_modulo","id_docente"));
    
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


        $data3 = model("conseguirGradosModulo",compact("id_modulo"));

        extract($data3);
         
        if(isset($error))
        {
            // Error vista
        }
        else
        {

            $mensaje = $mensaje_grados_modulo;
            $informacion = $informacion_grados_modulo;
            $listaGradosNivelEdu = builder("crearListaGradosNivelEdProyectos",compact("mensaje","informacion"));

            $mensaje = $mensaje_registro_docente;
            $informacion = $informacion_registro_docente;
            $seleccionable = true;
            $excepcion = array("0","1");
            $contenidoTabla = builder("crearTablaUnirseProyecto",compact("mensaje","informacion","seleccionable","excepcion"));

            view("formMostrarTablaGradosUnionModulos",compact("nombre_modulo","id_modulo","listaGradosNivelEdu","contenidoTabla"));   
        }
    }