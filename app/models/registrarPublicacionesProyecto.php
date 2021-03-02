<?php
           
	try
    {
        $peticion = $mysqli->query("CALL SP_insertPublicacionesProyectos('".$publicacionCompleta."','".$urlProyecto."','".$type."')"); 
        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }
                
        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            while($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                $id_publicacion_proyecto_docente = $row["id_publicacion_proyecto_docente"];

            }

            if($imagenes !== "" || $archivos !== "" || $iframesYoutube !== "")
            {
                 $mysqli->autocommit(false);  // empieza la transaccion 
                //
                //Estas intrucciones son necesarias para poder hacer varias consultas a la vez en un modelo
                $mysqli->more_results();
                $mysqli->next_result();
                $mysqli->store_result();
            }

            if($imagenes !== "")
            {

                 for($x=0; $x<sizeof($imagenes);$x++)
                {
                    $url_imagen = $imagenes[$x][0]["url_imagen"];
                    
                    $peticion = $mysqli->query("CALL SP_insertFotosPublicaciones(".$id_publicacion_proyecto_docente.",'".$url_imagen."','".$type."')");

                    if(!$peticion)
                    {
                        throw new Exception($mysqli->error);
                    }
                } 
            }

            if($archivos !== "")
            {

                 for($x=0; $x<sizeof($archivos);$x++)
                {
                    $url_archivo = $archivos[$x][0]["url_archivo"];
                    $nombre_archivo = $archivos[$x][0]["nombre_archivo"];
                    
                    $peticion = $mysqli->query("CALL SP_insertArchivosPublicaciones(".$id_publicacion_proyecto_docente.",'".$nombre_archivo."','".$url_archivo."','".$type."')");

                    if(!$peticion)
                    {
                        throw new Exception($mysqli->error);
                    }
                    
                } 
            }

            if($iframesYoutube !== "")
            {

                 for($x=0; $x<sizeof($iframesYoutube);$x++)
                {
                    $iframe_youtube = $iframesYoutube[$x][0]["iframe_youtube"];
                    
                    $peticion = $mysqli->query("CALL SP_insertEnlacesYoutubePublicaciones(".$id_publicacion_proyecto_docente.",'".$iframe_youtube."','".$type."')");

                    if(!$peticion)
                    {
                        throw new Exception($mysqli->error);
                    }
                } 
            }
            
            $mensaje_registro_publicacion =true;
            $mysqli->commit();  // si en la transaccion no hubo ningun error se ejetuca el commit  

        }
        else
        {
            $mensaje_registro_publicacion = false;
        }
            
	}
	catch(Exception $e) 
    {
        $error = "@%@#".$e->getMessage();
         //$mysqli->rollback();  // si hubo error en la trasacion se ejecuta el rolback
	}
	
	if(isset($error))
	{
	   $data = compact("error");
            
	}
    else if($mensaje_registro_publicacion === true)
    {
        $data = compact("mensaje_registro_publicacion","id_publicacion_proyecto_docente");
    }
    else
    {
         $data = compact("mensaje_registro_publicacion");
    }