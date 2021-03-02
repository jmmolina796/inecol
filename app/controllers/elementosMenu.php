<?php 

	$elementos = array();
	$elementoIgnorar = $varAux;
	if(isSessionStarted())
	{
		$nombre_usuario = $_SESSION["usuario"];

		if(isRoot()) //ROOT
		{
			$elementos["@go:".URL_SERVER] = "Inicio";
			$elementos["formAdministradores"] = "Administradores";
			$elementos["formAsesores"] = "Asesores";
			$elementos["formDocentes"] = "Docentes";
			$elementos["formJueces"] = "Jueces";
			$elementos["formInstituciones"] = "Instituciones de procedencia";
			$elementos["formCapacitaciones"] = "Capacitaciones";
			$elementos["formCapacitacionesGrupos"] = "Grupos de capacitaciones";
			$elementos["formCapacitadores"] = "Capacitadores";
			$elementos["formEscuelas"] = "Escuelas";
			// $elementos["formModulos"] = "Módulos";
			$elementos["formAlianzas"] = "Alianzas";
			$elementos["formCiclosEscolares"] = "Ciclos escolares";
			$elementos["formProyectos"] = "Desafíos";
			/*$elementos["formCarpetasProyectos"] = "Carpetas";*/
			/*$elementos["rootForo"] = "Foro";
			$elementos["formTutoriales"] = "Tutoriales";
			$elementos["rootChat"] = "Chat";
			$elementos["rootPerfil"] = "Perfil";*/
		}
		else if(isAdministrator()) //Administrador
		{
			$elementos["@go:".URL_SERVER] = "Inicio";
			$elementos["formAdministradores"] = "Administradores";
			$elementos["formAsesores"] = "Asesores";
			$elementos["formDocentes"] = "Docentes";
			$elementos["formJueces"] = "Jueces";
			$elementos["formInstituciones"] = "Instituciones de procedencia";
			$elementos["formCapacitaciones"] = "Capacitaciones";
			$elementos["formCapacitadores"] = "Capacitadores";
			$elementos["formEscuelas"] = "Escuelas";
			// $elementos["formModulos"] = "Módulos";
			$elementos["formAlianzas"] = "Alianzas";
			$elementos["formCiclosEscolares"] = "Ciclos escolares";
			$elementos["formProyectos"] = "Desafíos";
			/*$elementos["formCarpetasProyectos"] = "Carpetas";*/
			/*$elementos["rootChat"] = "Chat";
			$elementos["rootForo"] = "Foro";
			$elementos["rootPerfil"] = "Perfil";*/
		}
		else if(isAdviser()) //Asesor
		{
			$elementos["@go:".URL_SERVER] = "Inicio";
			$elementos["@go:".URL_SERVER."escuelas"] = "Escuelas";  //No puede modificar escuelas
			$elementos["formDocentes"] = "Docentes";	//No puede modificar docentes
			$elementos["formProyectos"] = "Desafíos";	//No puede modificar proyectos
		}
		else if(isJudge()) //Juez
		{
			$elementos["formProyectosCalificar"] = "Proyectos a calificar";	//No puede modificar proyectos
		}
		else if(isTrainer()) //Capacitador
		{
			
		}
		else if(isTeacher()) //Docente
		{
			$proyectosUsuario = userProjects($nombre_usuario);
			$modulosUsuario = userModules($nombre_usuario);
			
			$elementos["@go:".URL_SERVER] = "Inicio";
			// $elementos["$modulosUsuario"] = "Mis Módulos";
			$elementos["$proyectosUsuario"] = "Mis proyectos";

			// $elementos["seleccionar-modulos"] = "Módulos SEVIC";
			$elementos["seleccionar-proyectos"] = "Proyectos disponibles";

			/*$elementos["rootChat"] = "Chat";
			$elementos["rootForo"] = "Foro";
			$elementos["rootPerfil"] = "Perfil";*/
		}
	}
	else //Invitado
	{
		$elementos[""] = "Inicio";
		// $elementos["descargar-modulos"] = "Módulos SEVIC";
		// $elementos["proyectos/fairchild-challenge"] = "Fairchild Challenge";
		$elementos["convocatorias"] = "Convocatorias";
		$elementos["contacto"] = "Contacto";
		$elementos["@go:https://www.inecol.mx/inecol/index.php/es/transparencia2/normatividad"] = "Transparencia";
	}

	if($elementoIgnorar !== "") {
		array_splice($elementos, $elementoIgnorar, 1);
	}

	$liElementosMenu = builder("crearElementosMenu",compact("elementos"));

	view("elementosMenu",compact("liElementosMenu"));