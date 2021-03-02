<?php

	$id_proyecto = $_POST["id_proyecto"];
    $id_docente = $_SESSION["id_usuario"];
    $clave_escuela = $_POST["clave_escuela"];
    $id_grado = $_POST["id_grado"];
    $id_grupo = $_POST["id_grupo"];
    
    $data = model("generarLink");
   
    extract($data);
    
    $url = $link_proyecto;

    $data3 = model("registrarUnionDocentesProyectos",compact("id_proyecto","id_docente","clave_escuela","id_grado","id_grupo","url"));

    extract($data3);

    if(isset($error))
    {
        $resultado = "Hubo un error en la base de datos.";
        sendToClient(compact("error","resultado"));
    }
    else if($mensaje === false)
    {
        $resultado = "Hubo un error en la base de datos.";
        sendToClient(compact("mensaje","resultado"));
    }
    else if($mensaje === true)
    {
        $resultado = "Registro insertado correctamente.";
        $link = userProjectLink($url);
        sendToClient(compact("mensaje","resultado","link"));
    }