<?php

	if(isUrlClient())
	{
		return;
	}

	if(isSessionStarted())
	{
		$rol = $_SESSION["rol"];

		if(isTeacher())
		{
			$id_docente = $_SESSION["id_usuario"];
			$data = model("buscarDocente",compact("id_docente"));
		}
		else if (isAdviser())
		{
			$id_asesor = $_SESSION["id_usuario"];
			$data = model("buscarAsesor", compact("id_asesor"));
		}
		else if (isJudge())
		{
			$id_juez = $_SESSION["id_usuario"];
			$data = model("buscarJuez", compact("id_juez"));
		}
		else if (isTrainer())
		{
			// $id_juez = $_SESSION["id_usuario"];
			// $data = model("buscarJuez", compact("id_juez"));
		}
		else if(isRoot() || isAdministrator())
		{
			$id_administrador = $_SESSION["id_usuario"];
			$data = model("buscarAdministrador",compact("id_administrador"));
		}

		extract($data);

		if(isTeacher())
		{
			$mensaje = $mensaje_docente;
			$nombre = $nombre_docente;
			$imagen = URL_SERVER.URL_DOC_IMG.$imagen;
		}
		else if (isAdviser())
		{
			$mensaje = $mensaje_asesor;
			$nombre = $nombre_asesor;
			$imagen = URL_SERVER.URL_ASE_IMG.$imagen;
		}
		else if (isJudge()) 
		{
			$mensaje = $mensaje_juez;
			$nombre = $nombre_juez;
			$imagen = URL_SERVER.URL_JUE_IMG.$imagen;
		}
		else if (isTrainer()) 
		{
			// $mensaje = $mensaje_juez;
			// $nombre = $nombre_juez;
			// $imagen = URL_SERVER.URL_JUE_IMG.$imagen;
		}
		else if(isRoot() || isAdministrator())
		{
			$mensaje = $mensaje_administrador;
			$nombre = $nombre_administrador;
			$imagen = URL_SERVER.URL_ADM_IMG.$imagen;
		}

		if(isset($error))
		{
			//ERROR
		}
		else if($mensaje === false)
		{
			//No está el registro
		}
		else
		{
			$nombreUsuario = $_SESSION["usuario"];

			view("headerUsuario",compact("nombre","imagen"));
		}
	}
	else
	{
		view("header");
	}
