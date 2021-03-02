<?php 
	$x=0;
    $contentHtml = "";
	foreach ($informacion_escuelas_docentes as $key => $value) 
	{
        list($clave, $escuela,$nivel,$id_nivel, $id_grado_do, $id_grupo_do) = $informacion_escuelas_docentes[$key];
        $contentHtml .= "<tr>".
                "<td>".$clave."</td>".
                "<td>".$escuela."</td>".
                "<td>".$nivel."</td>".
                "<td>".
                "<select class='slgrado' name='slgrado' disabled='disabled'>";
                                
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
        $contentHtml .= "</select>".
            "</td>".
            "<td>".
            "<select class='slgrupo' name='slgrupo' disabled='disabled'>";                  
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
        $contentHtml .= "</select>".
            "</td>".
            "</tr>";
        $x++;
	}