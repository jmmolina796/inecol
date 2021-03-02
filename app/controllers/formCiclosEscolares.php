<?php

    setPermission("administrator");
    setPermission("root");
    endPermissions();

    $cssClassElements = "";

    $data = model("conseguirCiclosEscolaresActivos");
    extract($data);

    if(isset($error))
    {
        exit();
        // aqui el codigo de Error
    }
    else if($mensaje_ciclos_escolares_activos === false)
    {   
        $contenidoTablaCiclos = "";
        $cssClassElements = "noActive";
    }
    else
    {
        $mensaje = $mensaje_ciclos_escolares_activos;
        $informacion = $informacion_ciclos_escolares_activos;
        $seleccionable = true;
        $excepcion_col = array("4");

        $contenidoTablaCiclos = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
    }

    $data2 = model("conseguirCiclosEscolaresInactivos");
    extract($data2);

    if(isset($error))
    {
        exit();
        // aqui el codigo de Error
    }
    else if($mensaje_ciclos_escolares_inactivos === false)
    {
        $contenidoTablaCiclosBaja = "";
        $cssClassElements .= " noInactive";
    }
    else
    {
        $mensaje = $mensaje_ciclos_escolares_inactivos;
        $informacion = $informacion_ciclos_escolares_inactivos;
        $seleccionable = true;
        $excepcion_col = array("4");

        $contenidoTablaCiclosBaja = builder("crearContenidoTablaGestion",compact("mensaje","informacion","seleccionable","excepcion_col"));
    }

    view("formCiclosEscolares",compact("contenidoTablaCiclos","contenidoTablaCiclosBaja","cssClassElements"));