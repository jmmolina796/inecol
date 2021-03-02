<?php

    if($mensaje === true)
    {
        $contentHtml = "";
        foreach ($informacion as $key => $value) 
        {
            $contentHtml .= "<tr>";
            if(isset($seleccionable) && $seleccionable === true)
            {
                $contentHtml .= "<td></td>";
            }
            $var = sizeof($informacion[$key]);
            for($x = 0;$x<sizeof($informacion[$key]);$x++)
            {
                $rep = false;
                if(isset($excepcion_col))
                {
                    for($y = 0;$y<sizeof($excepcion_col);$y++)
                    {
                        if($x == $excepcion_col[$y])
                        {
                            $rep = true;
                            break;
                        }
                    } 
                }
                if($rep === false)
                {
                    if( (isset($link) && $link != "") && $x == $positionLink )
                    {
                        switch ($link) 
                        {
                            case "carpetas":
                                    $url = folderLink($informacion[$key][$positionLink]);
                                break;
                            case "proyectos":
                                    $url = projectLink($informacion[$key][$positionLink]);
                                break;
                            case "modulos":
                                    $url = moduleLink($informacion[$key][$positionLink]);
                                break;
                            case "docentes":
                                    $url = teacherProfileLink($informacion[$key][$positionLink]);
                                break;
                            case "escuelas":
                                    $url = schoolLink($informacion[$key][$positionLink]);
                                break;
                            case "administradores":
                                    $url = administratorProfileLink($informacion[$key][$positionLink]);
                                break;
                            default:
                                    $url = folderLink($informacion[$key][$positionLink]);
                                break;
                        }
                        $contentHtml .= "<td>".$url."</td>";
                    }
                    else
                    {
                        $contentHtml .= "<td>".$informacion[$key][$x]."</td>";
                    }
                }
            }
            $contentHtml .= "</tr>";   
        }
    }