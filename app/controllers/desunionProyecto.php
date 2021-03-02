<?php

	$password = $_POST["password"];
	$urlProyecto = $_POST["urlProyecto"];
	$id_usuario = isset($_SESSION["id_usuario"]) ? $_SESSION["id_usuario"] : "0";
	$type = ($_POST["type"] == "p") ? "1" : "0";

	$data1 = model("verificarPasswordDesunionProyecto", compact("password","id_usuario","urlProyecto","type"));

	extract($data1);

	if(isset($error))
	{
		//ERRROR
	}
	else if($mensaje_verificar_password === false)
	{
		//NO hay registros
	}
	else
	{
		if($id_rel_proyecto_docente !== "-1")
		{
			$data2 = model("conseguirArchivosPortadaProyecto", compact("id_rel_proyecto_docente","type"));

			extract($data2);

			if(isset($error))
			{
				//ERRROR
				var_dump($data2);
			}
			else
			{
				$data3 = model("conseguirImagenesPortadaProyecto", compact("id_rel_proyecto_docente","type"));

				extract($data3);

				if(isset($error))
				{
					//ERRROR
				}
				else
				{
					$data4 = model("eliminarDocentePortadaProyecto", compact("id_rel_proyecto_docente","type"));

					extract($data4);

					if(isset($error))
					{
						//ERRROR
						var_dump($error);
					}
					else
					{
						if(isset($informacion_imagenes_portada_proyecto))
						{
							$fldr = ($type == 1) ? "imgPub" : "imgPubMod";
							for($x = 0;$x<count($informacion_imagenes_portada_proyecto);$x++)
					        {
					           $nameFileToDelete = $informacion_imagenes_portada_proyecto[$x][0];
					           load("gestionarArchivos",$fldr,$nameFileToDelete);
					        }
						}
						if(isset($informacion_archivos_portada_proyecto))
						{
							$fldr = ($type == 1) ? "filPub" : "filPubMod";
							for($x = 0;$x<count($informacion_archivos_portada_proyecto);$x++)
					        {
					           $nameFileToDelete = $informacion_archivos_portada_proyecto[$x][0];
					           load("gestionarArchivos",$fldr,$nameFileToDelete);
					        }
						}
						$mensaje = true;
						$resultado = ($type == 1) ? "Te has desunido del proyecto." : "Has abandonado el módulo.";
						sendToClient(compact("mensaje","resultado"));
					}	
				}
			}
		}
		else  
		{
			$mensaje = false;
			$resultado = "La contraseña ingresada no es correcta.";
			sendToClient(compact("mensaje","resultado"));
		}
	}