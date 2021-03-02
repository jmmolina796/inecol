<?php

	if(isset($_SESSION["id_usuario"]))
	{
		if(isTeacher())
		{
			$id_docente = $_SESSION["id_usuario"];
			$data = model("buscarDocente",compact("id_docente"));
			extract($data);
			if(isset($error))
			{
				//ERROR
			}
			else if($mensaje_docente === false)
			{
				//No se encontró el registro
			}
			else
			{

			    $opt = "entidades";

				$data2 = model("conseguirEntidadesMunicipios",compact("opt"));

				extract($data2);

				$opt = "municipios";

				$data3 = model("conseguirEntidadesMunicipios",compact("opt",'id_entidad'));

				extract($data3);

			    $mensaje = $mensaje_entidades;
			    $informacion = $informacion_entidades;
			    $nombre = "el estado";
			    $valor = $id_entidad;
			    $selectEntidad = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

			    $mensaje = $mensaje_municipios;
			    $informacion = $informacion_municipios;
			    $nombre = "el municipio";
			    $valor = $id_municipio;
			    $selectMunicipio = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));

			    $data4 = model("conseguirEscuelasDocentes",compact("id_docente")); 

			    extract($data4);
			    
			    $arrayGrados=[];
			    $arrayGrupos=[];

			    if(isset($error))
			    {

			    }
			    else if($mensaje_escuelas_docentes == false)
			    {
			        $informacion_escuelas_docentes = array();
			    }
			    
			    for($x=0; $x < sizeof($informacion_escuelas_docentes);$x++)
			    {
			        $id_nivel_educativo = $informacion_escuelas_docentes[$x][3];
			        
			        $data5 = model("conseguirGrados",  compact("id_nivel_educativo"));
			        
			        $data6 = model("conseguirGrupos");
			        
			        extract($data5);
			        
			        extract($data6);
			        
			        $arrayGrados[$x] = $informacion_grados;
			        $arrayGrupos[$x] = $informacion_grupos;
			    }

			    $mensaje = $mensaje_escuelas_docentes;
			    $tablaEscuelasDocentes = builder("crearTablaModificarEscuelasDocente",compact("informacion_escuelas_docentes","arrayGrados","arrayGrupos","mensaje"));

				$css_class = "";
				if($imagen == "default.png")
				{
					$css_class = "default";
				}
				view("configuracionDocente",compact("nombre_docente","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","imagen","selectEntidad","selectMunicipio","nombre_localidad","tablaEscuelasDocentes","css_class","color"));
			}
		}
		else if(isRoot() || isAdministrator())
		{
			$cerrar_sesion = "";
			if(isRoot())
			{
				$cerrar_sesion = "<p><span class='cancelarCuenta'>-Desactivar mi cuenta.</span></p>";
			}
			$id_administrador = $_SESSION["id_usuario"];
			$data = model("buscarAdministrador",compact("id_administrador"));
			extract($data);
			if(isset($error))
			{
				//ERROR
			}
			else if($mensaje_administrador === false)
			{
				//No se encontró el registro
			}
			else
			{
				$css_class = "";
				if($imagen == "default.png")
				{
					$css_class = "default";
				}
				view("configuracion",compact("nombre_administrador","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","imagen","color","css_class","cerrar_sesion"));
			}
		}
		else if(isAdviser()) 
		{
			$id_asesor = $_SESSION["id_usuario"];
			$data = model("buscarAsesor",compact("id_asesor"));
			extract($data);

			if(isset($error))
			{
				//ERROR
			}
			else if($mensaje_asesor === false)
			{
				//No se encontró el registro
			}
			else
			{

				$data2 = model("conseguirFuncionesAsesor");

				extract($data2);

				if(isset($error))
				{
					//ERRROR
				}
				else if($mensaje_adviser_functions === false)
				{
					//NO hay registro
				}
				else 
				{
					$mensaje = $mensaje_adviser_functions;
					$informacion = $informacion_adviser_functions;
					$nombre = "una opción";
					$valor = $id_funcion;
					$selectTipoAsesor = builder("crearSelect",compact("informacion","mensaje","nombre","valor"));
		
					$css_class = "";
					if($imagen == "default.png")
					{
						$css_class = "default";
					}
					view("configuracionAsesor",compact("nombre_asesor","ape_paterno","ape_materno","email","password","nombre_usuario","telefono","imagen","color","css_class","selectTipoAsesor"));
				}
			}
		}
	}
	else
	{
		view("notfound");
	}
