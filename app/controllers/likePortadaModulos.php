<?php

    setPermission("teacher");
    setPermission("adviser");
    setPermission("administrator");
    setPermission("root");
    endPermissions("@accessRequired");

    $id_usuario = $_SESSION["id_usuario"];

    $rol = $_SESSION["rol"];

    $urlModulo = $_POST["urlModulo"];
        
    $data = model("likePortadaModulos",compact("urlModulo","id_rel_proyecto_docente","id_usuario","rol"));

     extract($data);
     
    if(isset($error))
    {
        //ERROR
    }
    else if($mensaje_informacion_cantidad_likes_modulo === false)
    {
    }
    else
    {
        $mensaje = $mensaje_informacion_cantidad_likes_modulo;
        
        echo json_encode(compact("mensaje", "cantidad_likes","dar_like"));
    
    }