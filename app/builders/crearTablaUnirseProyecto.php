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
                if(isset($excepcion))
                {
                    for($y = 0;$y<sizeof($excepcion);$y++)
                    {
                        if($x == $excepcion[$y])
                        {
                            $rep = true;
                            break;
                        }
                    } 
                }
                if($rep === false)
                {
                    $contentHtml .= "<td>".$informacion[$key][$x]."</td>";
                }
            }
            $contentHtml .= "</tr>";   
        }
    }