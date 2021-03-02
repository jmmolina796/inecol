<?php

    $id_modulo = $_POST["id_modulo"];
    $id_docente = $_SESSION["id_usuario"];
    $clave_escuela = $_POST["clave_escuela"];
    $id_grado = $_POST["id_grado"];
    $id_grupo = $_POST["id_grupo"];
    
    $data = model("generarLink");
    extract($data);
    $url = $link_proyecto;

    $data2 = model("conseguirCiclosEscolaresActivos");
    extract($data2);

    if(isset($error))
    {
        exit();
        // aqui el codigo de Error
    }
    else if($mensaje_ciclos_escolares_activos === false)
    {   
        $resultado = "No hay ciclo escolar activo.";
        sendToClient(compact("resultado"));
    }
    else
    {

        $id_ciclo_escolar = $informacion_ciclos_escolares_activos[0][0];
      
        $data4 = model("registrarUnionDocentesModulos",compact("id_modulo","id_docente","id_ciclo_escolar","clave_escuela","id_grado","id_grupo","url"));
        extract($data4);

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
            $link = userModuleLink($url);
            sendToClient(compact("mensaje","resultado","link"));
        }
    }