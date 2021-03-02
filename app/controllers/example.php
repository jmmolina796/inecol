<?php

    $url = 'https://api.siged.sep.gob.mx/servicios//escuela/selectCcts/cct=30DTV0017Q&turno=&nivel=&control=&entidad=&municipio=&localidad=';
    // $data = array();
    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
        // 'header'  => "Content-type: application/json",
        'method'  => 'GET',
        // 'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $json = json_decode($result);
    var_dump($json->Ccts[0]);

    view("example");