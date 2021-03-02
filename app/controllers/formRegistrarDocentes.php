<?php

    setPermission("administrator");
    setPermission("root");
    endPermissions();
    

    $opt = "entidades";

    $data = model("conseguirEntidadesMunicipios",compact("opt"));

    extract($data);

    if(isset($error))
    {
        //ERRROR
    }
    else if($mensaje_entidades === false)
    {
        //No hay entidades
    }
    else
    {
        $mensaje = $mensaje_entidades;
        $informacion = $informacion_entidades;
        $nombre = "el estado";
        $valor = "none";
        $selectEntidad = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

        view("formRegistrarDocentes",compact("selectEntidad"));  
    }