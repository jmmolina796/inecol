<?php

	try
	{

        if($joinProyects=="1")
        {
            $mysqli->autocommit(false);  // empieza la transaccion 
            
        }

        $id_carpeta =0;

        $peticion = $mysqli->query("CALL SP_insertCarpetasProyectos('".$nombre_carpeta."','".$url."')");

       // var_dump($peticion);

        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows) && $peticion->num_rows > 0)
        {
            while($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                $id_carpeta = $row["id_carpeta"];
                
            }
            $mensaje_carpetas = true;
        }
        else
        {
            $mensaje_carpetas = false;
        }
        
        
        if($joinProyects=="1")
        {

                // Estas intrucciones son necesarias para poder hacer varias consultas a la vez en un modelo
                $mysqli->more_results();
                $mysqli->next_result();
                $mysqli->store_result();

                for($y=0;$y<sizeof($array_ids_proyectos);$y++)
                {

                    $peticion = $mysqli->query("CALL SP_insertRelCarpetasProyectos('".$array_ids_proyectos[$y]["id_proyecto"]."','".$id_carpeta."')");
                    //var_dump("CALL SP_insertRelCarpetasProyectos(".$array_ids_proyectos[$y].",".$id_carpeta.")");
                    if(!$peticion)
                    {
                        throw new Exception($mysqli->error);
                    }
                } 
            
        }

        
        if($joinProyects=="1")
        {
            
            $mysqli->commit();  // si en la transaccion no hubo ningun error se ejetuca el commit        
            
        }

    }
    catch(Exception $e) 
    {
        $error = "@%@#".$e->getMessage();

        if($joinProyects=="1")
        {
            $mysqli->rollback();  // si hubo error en la trasacion se ejecuta el rolback       
        }

	}


	if(isset($error))
	{

        $data = compact("error"); 

    }
     else if($mensaje_carpetas === false)
    {
        $data = compact("mensaje_carpetas");
    }
    else
    {
        $data = compact("id_carpeta", "mensaje_carpetas");
    }
