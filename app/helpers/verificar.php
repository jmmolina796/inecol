<?php

	function verify()
	{
		$name = getPaths();
		$url = explode("/",$name);
		$action1 = isset($url[0]) ? $url[0] : "";
		$action2 = isset($url[1]) ? $url[1] : "";
		$action3 = isset($url[2]) ? $url[2] : "";
		
		if(!empty($action3))
		{
				
			if($action3 == "proyectos")
			{
				if(isOwnerUserName($action2,"0"))
				{
					$user = verifyUsuarios($action2,"0");
					if($user["exists"])
					{
						$id_docente = $user["id"];
						//$title = "Proyectos - ".$user["title"];
						$title = "Mis proyectos";
						setVerificar(true,"proyectosDocente",$title,compact("id_docente"));
					}
					else
					{
						setVerificar(false);
					}
				}
				else
				{
					setVerificar(false);
				}
			}
			else if($action3 == "modulos")
			{
				if(isOwnerUserName($action2,"0"))
				{
					$user = verifyUsuarios($action2,"0");
					if($user["exists"])
					{
						$id_docente = $user["id"];
						//$title = "Módulos - ".$user["title"];
						$title = "Mis módulos";
						setVerificar(true,"modulosDocente",$title,compact("id_docente"));
					}
					else
					{
						setVerificar(false);
					}
				}
				else
				{
					setVerificar(false);
				}
			}
			else if($action1 == "busqueda")  //busqueda
			{
				$flag = false;
				$title = urldecode($action3)." - ";

				switch ($action2) {
					case 'proyectos':
						$flag = true;
						$title .= "Búsqueda de proyectos";
						break;
					case 'modulos':
						$flag = true;
						$title .= "Búsqueda de módulos";
						break;
					case 'docentes':
						$flag = true;
						$title .= "Búsqueda de docentes";
						break;
					case 'escuelas':
						$flag = true;
						$title .= "Búsqueda de escuelas";
						break;
					default:
						$flag = false;
						break;
				}
				if($flag)
				{
					$tipoBusqueda = $action2;
					$filtroBusqueda = urldecode($action3);
					setVerificar(true,"busqueda",$title,compact("tipoBusqueda","filtroBusqueda"));
				}
				else
				{
					setVerificar(false);
				}
			}
			else
			{
				setVerificar(false);
			}
		}
		else if(!empty($action2))
		{	
			if($action1 == "docentes")
			{
				$rolUsuario = "0";

				$user = verifyUsuarios($action2,$rolUsuario);
				if($user["exists"])
				{
					$id_docente = $user["id"];
					$title = "Docente - ".$user["title"];
					setVerificar(true,"docente",$title,compact("id_docente"));
				}
				else
				{
					setVerificar(false);
				}
			}
			else if($action1 == "administradores")
			{
				if(isSessionStarted())
				{
					$rolUsuario = "1";

					$user = verifyUsuarios($action2,$rolUsuario);
					if($user["exists"])
					{
						$id_administrador = $user["id"];
						$title = "Administrador - ".$user["title"];
						setVerificar(true,"administrador",$title,compact("id_administrador"));
					}
					else
					{
						setVerificar(false);
					}
				}
				else
				{
					setVerificar(false);
				}
			}
			else if($action1 == "asesores")
			{
				if(isSessionStarted())
				{
					$rolUsuario = "3";

					$user = verifyUsuarios($action2,$rolUsuario);
					if($user["exists"])
					{
						$id_administrador = $user["id"];
						$title = "Asesor - ".$user["title"];
						setVerificar(true,"administrador",$title,compact("id_administrador"));
					}
					else
					{
						setVerificar(false);
					}
				}
				else
				{
					setVerificar(false);
				}
			}
			else if($action1 == "escuelas")
			{
				schools("escuela",$action2);
			}
			else if($action1 == "modulos-participantes")
			{
				modulos("moduloDocente",$action2);
			} 
			else if($action1 == "proyectos-participantes")
			{
				proyectos("proyectoDocente",$action2);
			}
			else if($action1 == "modulos")
			{
				modulos("modulo",$action2);
			}
			else if($action1 == "proyectos")
			{
				if($action2 == "fairchild-challenge") 
				{
					setVerificar(true,"fairchild-challeng","Fairchild Challenge");
				}
				else 
				{
					proyectos("proyecto",$action2);
				}
			}
			else if($action1 == "carpetas")
			{
				folders("carpeta",$action2);
			}
			else if($action1 == "restablecer-clave")
			{
				userToken($action2);
			}
			else if($action1 == "mensajes")
			{
				$user = verifyUsuarioChat($action2);
				if($user["exists"])
				{
					//$title = "Módulos - ".$user["title"];
					$P_nombre = $user["nombre"];
					$P_ape_paterno = $user["ape_paterno"];
					$P_ape_materno = $user["ape_materno"];
					$P_nombre_usuario = $user["nombre_usuario"];
					$P_imagen = $user["imagen"];
					$P_rol = $user["rol"];
					$P_nombre_completo = $P_nombre." ".$P_ape_paterno." ".$P_ape_materno;

					$title = "Mensajes - ".$P_nombre_completo;
					$P_nombre_usuario_consultar = $action2;
					setVerificar(true,"mensajesUsuario",$title,compact("P_nombre_usuario_consultar","P_nombre_completo","P_nombre_usuario","P_imagen","P_rol"));
				}
				else
				{
					setVerificar(false);
				}
					
			}
			else
			{
				setVerificar(false);
			}
		}
		else if(!empty($action1))
		{
			if( strrpos($action1, "index") === false) //Evitar url index.php
			{
				if($action1 == "busqueda") //Ignorar archivos que no pueden ser mostrados con solo una variable
				{
					setVerificar(false);
					return;
				}

				$file = "app/views/$action1.sync.php";

				if(file_exists($file))
				{
					setVerificar(true,$action1);
				}
				else
				{
					setVerificar(false);
				}
			}
			else
			{
				setVerificar(false);
				return;
			}
		}
		else
		{
			setVerificar(false);
		}
	}

	function verifyUsuarioChat($action2)
	{
		$data = model("existeUsuarioChat",compact("action2"));

		extract($data);

		if(isset($error))
		{
			return array("exists"=>false);
		}
		else if($mensaje === true)
		{
			return array("exists"=>true,
							"nombre"=>$nombre,
							"ape_paterno"=>$ape_paterno,
							"ape_materno"=>$ape_materno,
							"nombre_usuario"=>$nombre_usuario,
							"imagen"=>$imagen,
							"rol"=>$rol,
							"mensaje"=>$mensaje);
		}
		else
		{
			return array("exists"=>false);
		}
	}

	function verifyUsuarios($action1,$rol)
	{
		$data = model("existeUsuario",compact("action1","rol"));

		extract($data);

		if(isset($error))
		{
			return array("exists"=>false);
		}
		else if($id != "-1")
		{
			return array("exists"=>true,"id"=>$id,"title"=>$title);
		}
		else
		{
			return array("exists"=>false);
		}
	}

	function proyectos($action,$link)
	{
		$data = model("existeUrl",compact("action","link"));
		
		extract($data);

		if(isset($error))
		{
			setVerificar(false);	
		}
		else if($id != "-1")
		{
			if($action == "proyecto")
			{
				$id_proyecto = $id;
				setVerificar(true,"proyecto",$title,compact("id_proyecto","link"));
			}
			else
			{
				setVerificar(true,"proyectoDocente",$title);
			}
		}
		else
		{
			setVerificar(false);
		}
	}

	function modulos($action,$link)
	{
		$data = model("existeUrl",compact("action","link"));
		
		extract($data);

		if(isset($error))
		{
			setVerificar(false);
		}
		else if($id != "-1")
		{
			if($action == "modulo")
			{
				$id_modulo = $id;
				setVerificar(true,"modulo",$title,compact("id_modulo","link"));
			}
			else
			{
				setVerificar(true,"moduloDocente",$title);
			}
		}
		else
		{
			setVerificar(false);
		}
	}

	function schools($action,$link)
	{
		$data = model("existeUrl",compact("action","link"));
		
		extract($data);

		if(isset($error))
		{
			setVerificar(false);
		}
		else if($id != "-1")
		{
			$clave = $link;
			setVerificar(true,"escuela",$title,compact("clave"));
		}
		else
		{
			setVerificar(false);
		}
	}
	function folders($action,$link)
	{
		$data = model("existeUrl",compact("action","link"));
		
		extract($data);

		if(isset($error))
		{
			setVerificar(false);
		}
		else if($id != "-1")
		{
			require "app/controllers/carpeta.php";
		}
		else
		{
			setVerificar(false);
		}
	}
	function userToken($token)
	{
		$data = model("verificarTokenUsuario",compact("token"));
		extract($data);

		if(isset($error))
		{
			setVerificar(false);
		}
		else if($respuesta == "0")
		{
			setVerificar(false);
		}
		else
		{
			require "app/controllers/restablecer-clave.php";
		}
	}

	function setVerificar($exists,$file = "",$title = "",$vars = array())
	{
		$GLOBALS["exists"] = $exists;
		$GLOBALS["file"] = $file;
		$GLOBALS["title"] = getTitle($title);
		$GLOBALS["vars"] = $vars;
	}


	function setPermission($userPermission,$typePermissions = array("active"))
	{
		$flag = false;
		$permission_set = "";

		if($GLOBALS["AUTHENTICATION"] || !isSessionStarted())
		{
			return;
		}

		extract($GLOBALS["USER_REQUEST"]); //$rol, $informacion_usuario, $id_usuario

		switch ($userPermission) {
			case 'teacher':
				$user = 0;
				break;
			case 'administrator':
				$user = 1;
				break;
			case 'root':
				$user = 2;
				break;
			case 'adviser':
				$user = 3;
				break;
			case 'judge':
				$user = 4;
				break;
			case 'trainer':
				$user = 5;
				break;
			default:
				$user = -1;
				break;
		}

		if($user != $rol)
		{
			return;
		}

		$GLOBALS["USER_ACCESS"] = true; //Indicar que ese tipo de usuario tiene acceso


		if($user == 2) //root
		{
			$flag = true;
		}
		else if($user == 1 || $user == 3 || $user == 4 || $user == 5) //administrator and adviser
		{
			$permission = $typePermissions[0];

			if($permission == 'active')
			{
				if($informacion_usuario == "1")
				{
					$flag = true;
				}
			}
			else if($permission == 'inactive')
			{
				if($informacion_usuario == "0")
				{
					$flag = true;
				}
			}
			else
			{
				$flag = false;
			}
		}
		else if($user == 0) //teacher
		{
			$permission1 = $typePermissions[0];
			$permission2 = isset($typePermissions[1]) ? ($typePermissions[1]) : "" ;

			//var_dump($informacion_usuario);

			if($permission1 == 'active' && $permission2 == '')
			{
				if($informacion_usuario == "1" || $informacion_usuario == "2")
				{
					$flag = true;
				}
				$permission_set = "active";
			}
			else if($permission1 == 'active' && $permission2 == 'withSchools')
			{
				if($informacion_usuario == "1")
				{
					$flag = true;
				}
				$permission_set = "active-withSchools";
			}
			else if($permission1 == 'inactive' && $permission2 == '')
			{
				if($informacion_usuario == "0" || $informacion_usuario == "3")
				{
					$flag = true;
				}
				$permission_set = "inactive";
			}
			else if($permission1 == 'inactive' && $permission2 == 'withSchools')
			{
				if($informacion_usuario == "0")
				{
					$flag = true;
				}
				$permission_set = "inactive-withSchools";
			}
			else
			{
				$flag = false;
			}
		}
		else
		{
			$flag = false;
		}

		if($flag)
		{
			$GLOBALS["AUTHENTICATION"] = true; //Dar permiso para acceder
		}
		else
		{
			$GLOBALS["PERMISSION_SET"] = $permission_set;
		}
	}

	function endPermissions($function = "")
	{		
		if(!$GLOBALS["USER_ACCESS"])
		{
			customMessage($function);
			mensajeSinAcceso();
		}
		extract($GLOBALS["USER_REQUEST"]);
		$permission_set = $GLOBALS["PERMISSION_SET"];
		if(!$GLOBALS["AUTHENTICATION"])
		{

			//customMessage($function);

			if($rol == 2) //root
			{
				
			}
			else if($rol == 1 || $rol == 3 || $rol == 4 || $rol == 5) //administrator and adviser
			{
				if($informacion_usuario == "0")
				{
					mensajeCuentaCancelada();
				}
				else
				{
					mensajeSinAcceso();
				}
			}
			else if($rol == 0) //teacher
			{
				if($informacion_usuario == "0")
				{
					mensajeCuentaCancelada();
				}
				else if($informacion_usuario == "1")
				{
					mensajeSinAcceso();
				}
				else if($informacion_usuario == "2")
				{
					if($permission_set == "inactive" || $permission_set == "inactive-withSchools")
					{
						mensajeSinAcceso();
					}
					else
					{
						mensajeSinEscuelas();
					}
				}
				else if($informacion_usuario == "3")
				{
					if($permission_set == "inactive-withSchools")
					{
						mensajeSinAcceso();
					}
					else
					{
						mensajeCuentaCancelada();
					}
				}
				else
				{
					mensajeSinAcceso();
				}
				
			}
			else
			{
				mensajeSinAcceso();
			}
		}
	}

	function customMessage($function)
	{
		if( !empty($function) )
		{
			if($function == "@accessRequired")
			{
				if(!isSessionStarted())
				{
					accessRequired();
				}
			}
		}
	}

	function mensajeCuentaCancelada()
	{
		closeSession();
		$rdirUsrSessUrl = "";
		$titlRdir = "Cuenta cancelada";
		$messRdir = "Tu cuenda se ha cancelado. Para más información contacte a PASEVIC.";
		sendToClient(compact("rdirUsrSessUrl","titlRdir","messRdir"));
		exit();
	}
	function mensajeSinEscuelas()
	{
		$rdirUsrSessUrl = "configuracion";
		$titlRdir = "Sin escuelas activas";
		$messRdir = "Ya no tienes escuelas activas.";
		sendToClient(compact("rdirUsrSessUrl","titlRdir","messRdir"));
		exit();
	}
	function mensajeSinAcceso()
	{
		$rdirUsrSessUrl = "";
		$titlRdir = "Permiso denegado";
		$messRdir = "No puedes acceder a este archivo.";
		sendToClient(compact("rdirUsrSessUrl","titlRdir","messRdir"));
		exit();
	}

	function accessRequired()
	{
		$rdirUsrSessUrl = "@accessRequired";
		$titlRdir = "";
		$messRdir = "";
		sendToClient(compact("rdirUsrSessUrl","titlRdir","messRdir"));
		exit();
	}

	function sessionStarted()
	{
		$rdirUsrSessUrl = "";
		$titlRdir = "Sesión iniciada";
		$messRdir = "Ya has iniciado sesión.";
		sendToClient(compact("rdirUsrSessUrl","titlRdir","messRdir"));
		exit();
	}
	function mensajeSesionCerrada()
	{
		closeSession();
		$rdirUsrSessUrl = "";
		$titlRdir = "No has iniciado sesión";
		$messRdir = "Se ha detectado que tu sesión ha finalizado, por favor inicia sesión para continuar.";
		sendToClient(compact("rdirUsrSessUrl","titlRdir","messRdir"));
		exit();
	}
	function mensajeSesionEquivocada()
	{
		$rdirUsrSessUrl = "";
		$titlRdir = "Sesión incorrecta";
		$messRdir = "Se ha detectado que esta sesión no te pertenece.";
		sendToClient(compact("rdirUsrSessUrl","titlRdir","messRdir"));
		exit();
	}

	function mensajeErrorSesion()
	{
		closeSession();
		$rdirUsrSessUrl = "";
		$titlRdir = "Error de sesión";
		$messRdir = "Ha ocurrido un error con tu sesión, por favor vuelve a ingresar.";
		sendToClient(compact("rdirUsrSessUrl","titlRdir","messRdir"));
		exit();
	}






















