<?php

	try
	{
        $mysqli->autocommit(false);  // empieza la transaccion 

        $peticion = $mysqli->query("CALL SP_insertProyectos('".$id_administrador."','".$id_ciclo."','".$nombre."','".$descripcion."','".$fecha_inicio_inscripcion."','".$fecha_fin_inscripcion."','".$fecha_inicio."','".$fecha_fin."','".$imagen_portada."','".$link_proyecto."','".$tipo_proyecto ."','".$id_proyecto_renovacion."','".$color."')");


        if(!$peticion)
        {
            throw new Exception($mysqli->error);
        }

        if(isset($peticion->num_rows))
        {

            if($row = $peticion->fetch_array(MYSQLI_BOTH))
            {
                $id_proyecto = $row["id_proyecto"];                                        
            }

            // Estas intrucciones son necesarias para poder hacer varias consultas a la vez en un modelo
            $mysqli->more_results();
            $mysqli->next_result();
            $mysqli->store_result();

            for($x=0;$x<sizeof($grados);$x++)
            {
                $id_grado = $grados[$x]["grado"];
                $peticion = $mysqli->query("CALL SP_insertRelGradosProyectos('".$id_proyecto."','".$id_grado."')");
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
            }

            for($x=0;$x<sizeof($alianzas);$x++)
            {
                $peticion = $mysqli->query("CALL SP_insertRelAlianzasProyectos('".$id_proyecto."','".$alianzas[$x]."')");
                if(!$peticion)
                {
                    throw new Exception($mysqli->error);
                }
            }
                    
            $mensaje = true;
        }
        else
        {
            $mensaje = false;
        }
        $mysqli->commit();  // si en la transaccion no hubo ningun error se ejetuca el commit        
    }
    catch(Exception $e) {
        $error = "@%@#".$e->getMessage();
        $mysqli->rollback();  // si hubo error en la trasacion se ejecuta el rolback
	}

	if(isset($error))
	{
		$data = compact("error");
    }
    else if(isset($mensaje))
    {
        $data = compact("mensaje");
	}