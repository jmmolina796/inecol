<?php


	$nombreUsuario = $_SESSION["usuario"];
	$perfilLink = "";
	$content = "";

	if(isAdministrator())
    {
        $perfilLink = administratorProfileLink($nombreUsuario);
    }
    else if(isAdviser())
    {
        $perfilLink = adviserProfileLink($nombreUsuario);
    }
    else if(isJudge())
    {
        $perfilLink = judgeProfileLink($nombreUsuario);
    }
    else if(isTrainer())
    {
        $perfilLink = trainerProfileLink($nombreUsuario);
    }
    else if(isTeacher())
    {
        $perfilLink = teacherProfileLink($nombreUsuario);
    }

    if(!isRoot())
    {
    	$content = "<li class='goToUrl'><a href='".$perfilLink."' class='no-style'>Mi perfil</a></li>";
    }

	view("miCuenta", compact("perfilLink","content"));