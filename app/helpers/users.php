<?php

	function isSessionStarted()
	{
		return isset($_SESSION["id_usuario"]);
	}

	function closeSession()
	{
		$_SESSION = array();
	}

	function isRoot($rol = "-1")
	{
		if($rol == "-1")
		{
			return isset($_SESSION["id_usuario"]) && ($_SESSION["rol"] == 2);
		}
		else
		{
			return $rol == 2;
		}
	}

	function isAdministrator($rol = "-1")
	{
		if($rol == "-1")
		{
			return isset($_SESSION["id_usuario"]) && ($_SESSION["rol"] == "1");
		}
		else
		{
			return $rol == 1;
		}
	}

	function isAdviser($rol = "-1")
	{
		if($rol == "-1")
		{
			return isset($_SESSION["id_usuario"]) && ($_SESSION["rol"] == "3");
		}
		else
		{
			return $rol == 3;
		}
	}

	function isTeacher($rol = "-1")
	{
		if($rol == "-1")
		{
			return isset($_SESSION["id_usuario"]) && ($_SESSION["rol"] == "0");
		}
		else
		{
			return $rol == 0;
		}
	}

	function isJudge($rol = "-1")
	{
		if($rol == "-1")
		{
			return isset($_SESSION["id_usuario"]) && ($_SESSION["rol"] == "4");
		}
		else
		{
			return $rol == 4;
		}
	}

	function isTrainer($rol = "-1")
	{
		if($rol == "-1")
		{
			return isset($_SESSION["id_usuario"]) && ($_SESSION["rol"] == "5");
		}
		else
		{
			return $rol == 5;
		}
	}

	function isOwner($id, $rol)
	{
		$is_owner = false;

		if(isSessionStarted())
		{
			if($id == $_SESSION["id_usuario"] && $rol == $_SESSION["rol"])
			{
				$is_owner = true;
			}
		}

		return $is_owner;
	}

	function isOwnerUserName($user, $rol)
	{
		$is_owner = false;

		if(isSessionStarted())
		{
			if($user == $_SESSION["usuario"] && $rol == $_SESSION["rol"])
			{
				$is_owner = true;
			}
		}

		return $is_owner;
	}



	function identifyingUser()
	{
		if(isSessionStarted())
		{
			if(!isRoot())
			{
				$rol = $_SESSION["rol"];
				$id_usuario = $_SESSION["id_usuario"];
				
				$data = model("estaUsuarioActivo",compact("rol","id_usuario"));
				extract($data);
				
				// var_dump($informacion_usuario, $rol, $id_usuario);

				//$informacion_usuario - tomada del modelo
			}
			else
			{
				$informacion_usuario = 1;
				$rol = 2;
				$id_usuario = 1;
			}
			$GLOBALS["USER_REQUEST"] = compact("informacion_usuario","rol","id_usuario");
		}
	}


	function userRequesting()
	{
		if($GLOBALS["USER_REQUESTING"] == "@FALSE")
		{
			return;
		}

		if( !empty($GLOBALS["USER_REQUESTING"]) )
		{
			if(!isSessionStarted())
			{
				mensajeSesionCerrada();
			}

			$route = strrpos($GLOBALS["USER_REQUESTING"], "_");
			if($route === false) 
			{
				mensajeErrorSesion();
			}

			$arrayUser = explode("_", $GLOBALS["USER_REQUESTING"]);
			$idUser = $arrayUser[0];
			$rolUser = $arrayUser[1];

			$id = md5(SALT . $_SESSION["id_usuario"]);
			$rol = $_SESSION["rol"];

			if( !(($idUser == $id) && ($rolUser == $rol)) )
			{
				mensajeSesionEquivocada();
			}
		}
		else
		{
			mensajeSesionCerrada();
		}
	}


	function verifyUserActiveSync($url)
	{
		$userActive = isUserActive();

		if($userActive == "0")
		{
			closeSession();
			header('Location: /pasevic');
		}
		else if($userActive == "2")
		{
			if( !($url == "configuracion") )
			{
				header('Location: /pasevic/configuracion');
			}
		}
	}

	/*function verifyUserActiveAsync($file)
	{
		$userActive = isUserActive();
		if($userActive == "0")
		{
			closeSession();

			$rdirUsrSessUrl = "";
			$titlRdir = "Cuenta cancelada";
			$messRdir = "Tu cuenda se ha cancelado. Para más información contacte a PASEVIC.";
			sendToClient(compact("rdirUsrSessUrl","titlRdir","messRdir"));
			exit();
		}
		else if($userActive == "2")
		{
			$exceptionConfig = array(
								"modalModificarClave",
								"modificarClave",
								"modalEliminarCuenta",
								"eliminarCuenta",
								"modificarDocentes",
								"subirImagen",
								"existeUrlMultimedia",
								"imagenDefault",
								"gestionarArchivos",
								"consultarEscuelaDocente",
								"agregarEscuelasDocente"
							);

			if( !in_array($file, $exceptionConfig) )
			{
				$rdirUsrSessUrl = "configuracion";
				$titlRdir = "Sin escuelas activas";
				$messRdir = "Ya no tienes escuelas activas.";
				sendToClient(compact("rdirUsrSessUrl","titlRdir","messRdir"));
				exit();
			}
		}
	}*/
