<?php 

    $contentHtml = "";
	foreach ($informacion_escuelas_docentes as $key => $value) 
	{
        list($clave, $escuela, $nivel, $id_nivel, $id_grado_do, $id_grupo_do, $estatus, $grado, $grupo) = $informacion_escuelas_docentes[$key];

        if ($estatus  == 'Inactivo' )
        {
            $estiloFila = " dsbSchool";    
        }
        else
        {
            $estiloFila = "";
        }

        $contentHtml .= "<tr class='goToUrl".$estiloFila."'>".
                    "<td><a href='".schoolLink($clave)."'>".$clave."</a></td>".
                    "<td><a href='".schoolLink($clave)."'>".$escuela."</a></td>".
                    "<td><a href='".schoolLink($clave)."'>".$nivel."</a></td>".
                    "<td><a href='".schoolLink($clave)."'>".$grado."</a></td>".
                    "<td><a href='".schoolLink($clave)."'>".$grupo."</a></td>".
                "</tr>";
	}