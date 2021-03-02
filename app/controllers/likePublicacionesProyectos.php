<?php

    setPermission("teacher");
    setPermission("adviser");
    setPermission("administrator");
    setPermission("root");
    endPermissions("@accessRequired");

    $type = $_POST["type"];
    $id_usuario = $_SESSION["id_usuario"];
    $rol = $_SESSION["rol"];
    $urlProyecto = $_POST["urlProyecto"];
    $id_publicacion = $_POST["id_publicacion"];

    if($type == "p")
    {
        $type = "1";
    }
    else
    {
        $type = "0";
    }
        
    $data = model("likePublicacionesProyectos",compact("urlProyecto","id_rel_proyecto_docente","id_usuario","id_publicacion","rol","type"));

     extract($data);
     
    if(isset($error))
    {
        //ERROR
    }
    else if($mensaje_informacion_cantidad_likes_publicacion === false)
    {
        
    }
    else
    {
        $mensaje = $mensaje_informacion_cantidad_likes_publicacion;
        
        sendToClient(compact("mensaje", "cantidad_likes","dar_like"));
    
    }