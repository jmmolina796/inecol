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
        

        $tablaEsculasDocente = builder("crearTablaEscuelasDocentes",compact("informacion_escuelas_docentes","arrayGrados","arrayGrupos"));
        
        view("formConsultarDocentes",compact("id_docente","nombre_docente","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","entidad","municipio","nombre_localidad","imagen","tablaEsculasDocente"));
    }