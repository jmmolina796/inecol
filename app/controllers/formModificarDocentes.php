<?php

    setPermission("administrator");
    setPermission("root");
    endPermissions();

    $id_docente = $_POST["id_docente"];

    $data = model("buscarDocente",compact("id_docente")); 

    extract($data);

    if(isset($error))
    {
        // aqui el codigo de Error 
    }
    else if($mensaje_docente === false)
    {
        //NO hay registros
    }
    else
    {
        $data2 = model("conseguirEscuelasDocentes",compact("id_docente")); 

        extract($data2);

        if(isset($error))
        {

        }
        else if($mensaje_escuelas_docentes == false)
        {
            $informacion_escuelas_docentes = array();
        }
        
        $arrayGrados=[];
        $arrayGrupos=[];
        
        for($x=0; $x < sizeof($informacion_escuelas_docentes);$x++)
        {
            $id_nivel_educativo = $informacion_escuelas_docentes[$x][3];
            
            $data3 = model("conseguirGrados",  compact("id_nivel_educativo"));
            
            $data4 = model("conseguirGrupos");
            
            extract($data3);
            
            extract($data4);
            
            $arrayGrados[$x] = $informacion_grados;
            $arrayGrupos[$x] = $informacion_grupos;
        }

        $opt = "entidades";

    	$data5 = model("conseguirEntidadesMunicipios",compact("opt"));

    	extract($data5);

    	$opt = "municipios";

    	$data6 = model("conseguirEntidadesMunicipios",compact("opt",'id_entidad'));

    	extract($data6);

        if($imagen == "default.png")
        {
            $imagen = "";
        }
        else
        {
            $imagen = URL_SERVER.URL_DOC_IMG.$imagen;
        }

        $mensaje = $mensaje_entidades;
        $informacion = $informacion_entidades;
        $nombre = "el estado";
        $valor = $id_entidad;
        $selectEntidad = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

        $mensaje = $mensaje_municipios;
        $informacion = $informacion_municipios;
        $nombre = "el municipio";
        $valor = $id_municipio;
        $selectMunicipio = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

        
        $mensaje = $mensaje_escuelas_docentes;
        $tablaEscuelasDocentes = builder("crearTablaModificarEscuelasDocente",compact("informacion_escuelas_docentes","arrayGrados","arrayGrupos","mensaje"));

        view("formModificarDocentes",compact("id_docente","nombre_docente","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","entidad","municipio","nombre_localidad","imagen","selectEntidad","selectMunicipio","tablaEscuelasDocentes","color"));
    }