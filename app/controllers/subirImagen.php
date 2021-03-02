<?php

    function getNameImage($extencion)
    { 
        $num1 = rand(1000000000,99999999999);
        $num2 = rand(1000000000,99999999999);
        $letras = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',9)),0,9);
        $nombreImg = $num1."_".$num2."_".$letras;
        //$porciones = explode("/", $type);
        //$extencion = $porciones[1];
        $Destino = $nombreImg.".".$extencion;
        return $Destino;
    }

    function compress($source, $destination) {
        $info = getimagesize($source);
        $calculate = $info[0] * $info[1];
        if ($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/jpg')
        {
            $image = imagecreatefromjpeg($source);
        } 
        elseif ($info['mime'] == 'image/gif') 
        {
            $image = imagecreatefromgif($source);
        }
        elseif ($info['mime'] == 'image/png') 
        {
            $image = imagecreatefrompng($source);
        }

        if($calculate < 200000) //<480
        {
            $quality = 65;
        }
        if($calculate < 300000) //480 - 640x480
        {
            $quality = 55;
        }
        else if($calculate < 900000) //720 - 1280x720 
        {
            $quality = 45;
        }
        else if($calculate < 1500000) //1080 - 1920×1080
        {
            $quality = 35;
        }
        else if($calculate < 200000) //2k - 2048×1080
        {
            $quality = 20;
        }
        else if($calculate < 300000) //4k - 3840x2160
        {
            $quality = 15;
        }
        else //>4k
        {
            $quality = 10;
        }

        imagejpeg($image, $destination, $quality);

        return $destination;
    }

    $error = false;//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.

    if($_GET["type"] == "FPub" || $_GET["type"] == "FPubMod")  //Archivos
    {
        $ifSize = $_FILES["file0"]["size"] > 15*(1024*1024);
        $mimeTypes = array('doc' => true,
                            'docx' => true,
                            'xls' => true,
                            'xlsx' => true,
                            'ppt' => true,
                            'pptx' => true,
                            'pdf' => true,
                            'pages' => true,
                            'numbers' => true,
                            'keynote' => true);
    }
    else                                    //Imágenes
    {
        $ifSize = $_FILES["file0"]["size"] > 10*(1024*1024);
        $mimeTypes = array('jpg' => true,
                            'jpeg' => true,
                            'gif' => true,
                            'png' => true);
    }



    $link = URL_SERVER."public/";

    if($_GET["type"] == "pub")
    { 
       $ruta = './public/imagenes-publicaciones/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
       $link .= "imagenes-publicaciones/";
    }
    else if($_GET["type"] == "pubMod")
    {
        $ruta = './public/imagenes-publicaciones-mod/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
        $link .= "imagenes-publicaciones-mod/";
    }
    else if($_GET["type"] == "administradores")
    {
       $ruta = './public/imagenes-administrador/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
       $link .= "imagenes-administrador/";
    }
    else if($_GET["type"] == "asesores")
    {
       $ruta = './public/imagenes-asesor/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
       $link .= "imagenes-asesor/";
    }
    else if($_GET["type"] == "jueces")
    {
       $ruta = './public/imagenes-juez/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
       $link .= "imagenes-juez/";
    }
    else if($_GET["type"] == "capacitadores")
    {
       $ruta = './public/imagenes-capacitador/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
       $link .= "imagenes-capacitador/";
    }
    else if($_GET["type"] == "docentes")
    {
       $ruta = './public/imagenes-docente/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
       $link .= "imagenes-docente/";
    }
    else if($_GET["type"] == "modulos")
    {
        $ruta = './public/imagenes-modulo/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
        $link .= "imagenes-modulo/";
    }
    else if($_GET["type"] == "proyectos")
    {
        $ruta = './public/imagenes-proyecto/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
        $link .= "imagenes-proyecto/";
    }
    else if($_GET["type"] == "FPub")
    {
        $ruta = './public/archivos-publicaciones/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
        $link .= "archivos-publicaciones/";
    }
    else if($_GET["type"] == "FPubMod")
    {
        $ruta = './public/archivos-publicaciones-mod/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
        $link .= "archivos-publicaciones-mod/";
    }
    else
    {
        exit();
    }


    if( $ifSize ) 
    {
        $error = true;
        $size = true;
    }
    else
    {
        foreach ($_FILES as $key) //Iteramos el arreglo de archivos
        {
            $extName = $key['name'];
            $position = strripos($extName, ".") === false ? 0 : strripos($extName, ".") + 1;  // +1 para no tomar en cuenta la /
            $extName = substr($extName, $position, strlen($extName));
            $type = strtolower($extName);

            if( isset($mimeTypes[$type]) )
            {
                if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
                {
                    $NombreOriginal = $key['name'];//Obtenemos el nombre original del archivo
                    $temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
                    //$type = $key['type']; //Obtenemos la ruta Original del archivo
                    //$Destino = $ruta.$NombreOriginal; //Creamos una ruta de destino con la variable ruta y el nombre original del archivo       
                    $name = getNameImage($type);
                    $info = $ruta.$name;
                    //$info = "imagenes/974017333_458986511_hss7sid0.jpeg";
                    if(file_exists($info))
                    {
                        // hay error y se tiene que generar otro nombre de la imagen.
                        $info = getNameImage($type);
                        //$info = "imagenes/974017333_458986511_hss7sid0.jpeg";
                        $conta = 0;
                        while($conta == 0)
                        {
                            if(file_exists($info))
                            {
                                $info = getNameImage($type);
                            }
                            else
                            {
                              $conta = 1;  
                            }
                        }

                        if($_GET["type"] == "FPub" || $_GET["type"] == "FPubMod")  //Archivos
                        {
                            move_uploaded_file($temporal, $info); //Movemos el archivo temporal a la ruta especificada
                            //move_uploaded_file($temporal, $destination); //Movemos el archivo temporal a la ruta especificada	
                        }
                        else //Imágenes
                        {
                            compress($temporal, $info);  //Comprimir
                        }

                    }
                    else
                    {
                        // el nombre de la imagen no se repite y todo esta OK
                        if($_GET["type"] == "FPub" || $_GET["type"] == "FPubMod")  //Archivos
                        {
                            move_uploaded_file($temporal, $info); //Movemos el archivo temporal a la ruta especificada
                            //move_uploaded_file($temporal, $destination); //Movemos el archivo temporal a la ruta especificada	
                        }
                        else //Imágenes
                        {
                            compress($temporal, $info);  //Comprimir
                        }
                    }	
        		}
        		if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
        		{
        			$error = false;
        		}
        		if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
        		{
        			$error = true;
        		}
            }
            else
            {
                $format = true;
            }
        }
    }
    if(isset($size))
    {
	  sendToClient(compact("error","size"));  
    }
    else if(isset($format))
    {
        sendToClient(compact("error","format"));  
    }
    else if(!$error)
    {
        $link .= $name;
        sendToClient(compact("error","link","name"));
    }
    else
    {
        sendToClient(compact("error"));
    }