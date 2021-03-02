<?php

    $fecha = time();

    $letras = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',9)),0,7);

    $milliseconds = round(microtime(true) * 1000);

    $mili = substr($milliseconds,10,strlen($milliseconds));

    $link_proyecto = $letras.$mili.$fecha;

    $data = compact("link_proyecto");