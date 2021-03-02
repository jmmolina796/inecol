<?php

	$id_proyecto = isset($_POST["id_proyecto"]) ? $_POST["id_proyecto"] : $_POST["id_modulo"] ;
    $id_docente = $_SESSION["id_usuario"];
    $clave_escuela = $_POST["clave_escuela"];
    $id_grado = $_POST["id_grado"];
    $id_grupo = $_POST["id_grupo"];
    $tipo = $_POST["tipo"];

    $data2 = model("verifyDocentesGradosCoincidencias",compact("id_proyecto","id_docente","id_grado","clave_escuela","tipo"));
    
    extract($data2);
    
    if(isset($error))
    {
        // Error vista
    }
    else 
    {
        sendToClient(compact("mensaje"));    
    }
        
        
     
        
