<?php

    $clave = $_POST["clave"];

    $data = model("buscarEscuela",compact("clave")); 

    extract($data);

    if(isset($error))
    {
        //ERROR
    }
    else if($mensaje_escuela === false)
    {
        view("consultarEscuelaDocenteVacio");
    }
    else
    {
        view("consultarEscuelaDocente",compact("clave_escuela","escuela","nivel_educativo","entidad","municipio","id_nivel_educativo"));  
    }