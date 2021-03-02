<?php

    $id_proyecto = $_POST["id_proyecto"];

    $data2 = model("validaUnionProyectoFechasConvocatoria",compact("id_proyecto"));
    
    extract($data2);
    
    $valida = false;
    
    if(joinToProyect($fecha_inicio_inscripcion,$fecha_fin_inscripcion))
    {
        $valida = true;
    }

    if(isset($error))
    {
        // Error vista
    }
    else 
    {
        sendToClient(compact("mensaje","valida"));
    }
        
        
     
        
