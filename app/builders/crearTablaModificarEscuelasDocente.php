<?php 

    $contentHtml = "";
    if($mensaje === true)
    {
        $x=0;
        foreach ($informacion_escuelas_docentes as $key => $value) 
        {
            list($clave, $escuela,$nivel,$id_nivel, $id_grado_do, $id_grupo_do,$estatus,$grado,$grupo) = $informacion_escuelas_docentes[$key];

            if($estatus=='Inactivo')
            {
                $contentHtml .= "<tr class='escuela_baja'>";    
            }
            else
            {
             $contentHtml .= "<tr>";       
            }
            

            $contentHtml .= "<td><span class='glyphicon glyphicon-plus-sign iconAgregarEscuela'></span>"
            .$clave."</td>";
            $contentHtml .= "<td>".$escuela."</td>";
            $contentHtml .= "<td>".$nivel."</td>";
            $contentHtml .= "<td>";
            $contentHtml .= "<select class='slgrado' name='slgrado' >";
            $contentHtml .= "<option value='none' disabled='disabled'>Seleccione el grado:</option>";
            for ($e=0 ; $e<sizeof($arrayGrados[$x]);$e++ ) 
            {
                $id_grado = $arrayGrados[$x][$e][0];
                $nombre_grado = $arrayGrados[$x][$e][1];
                
                if($id_grado_do == $id_grado)
                {
                    $contentHtml .= "<option value='".$id_grado."' selected='selected' >".$nombre_grado."</option>";
                }
                else
                {
                    $contentHtml .= "<option value='".$id_grado."' >".$nombre_grado."</option>";
                }
               
               
            }
            $contentHtml .= "</select>";
            $contentHtml .= "</td>";
            $contentHtml .= "<td>";
            $contentHtml .= "<select class='slgrupo' name='slgrupo' >";
            $contentHtml .= "<option value='none' disabled='disabled' >Seleccione el grupo:</option>";
            for ($e=0 ; $e<sizeof($arrayGrupos[$x]);$e++ ) 
            {
                $id_grupo = $arrayGrupos[$x][$e][0];
                $nombre_grupo = $arrayGrupos[$x][$e][1];
                if($id_grupo_do == $id_grupo)
                {
                    $contentHtml .= "<option value='".$id_grupo."' selected='selected'>".$nombre_grupo."</option>"; 
                }
                else
                {
                    $contentHtml .= "<option value='".$id_grupo."'>".$nombre_grupo."</option>";
                }
            }
            $contentHtml .= "</select>";
            $contentHtml .= "</td>";
            $contentHtml .= "<td><span class='glyphicon glyphicon-remove-sign btnEliminarEscuelaDocente'></span> </td>";    
            $contentHtml .= "</tr>";
            $x++;
        }
    }