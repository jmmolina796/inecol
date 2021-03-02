<?php

	if( isSessionStarted() )
	{
		$rootDocument = $_SERVER['DOCUMENT_ROOT']."/";

		if(isset($_POST["fldr"])) //Porque se manda a llamar de JavaScript y del controller existeUrlsMultimedia
		{
			$fldr = $_POST["fldr"];
			$nameFileToDelete = $_POST["name"];
		}
		else
		{
			$fldr = $varAux;
			$nameFileToDelete = $varAux2;
		}

		if($nameFileToDelete != "default.png")
		{
			if($fldr == "imgPub")
			{
				$route = $rootDocument.URL_PUB_IMG.$nameFileToDelete;
			}
			else if($fldr == "imgPubMod")
			{
				$route = $rootDocument.URL_PMOD_IMG.$nameFileToDelete;
			}
			else if($fldr == "imgAdm")
			{
				$route = $rootDocument.URL_ADM_IMG.$nameFileToDelete;	
			}
			else if($fldr == "imgAse")
			{
				$route = $rootDocument.URL_ASE_IMG.$nameFileToDelete;	
			}
			else if($fldr == "imgJue")
			{
				$route = $rootDocument.URL_JUE_IMG.$nameFileToDelete;	
			}
			else if($fldr == "imgCap")
			{
				$route = $rootDocument.URL_CAP_IMG.$nameFileToDelete;	
			}
			else if($fldr == "imgDoc")
			{
				$route = $rootDocument.URL_DOC_IMG.$nameFileToDelete;	
			}
			else if($fldr == "imgMod")
			{
				$route = $rootDocument.URL_MOD_IMG.$nameFileToDelete;	
			}
			else if($fldr == "imgPro")
			{
				$route = $rootDocument.URL_PRO_IMG.$nameFileToDelete;	
			}
			else if($fldr == "filPub")
			{
				$route = $rootDocument.URL_PUB_FL.$nameFileToDelete;	
			}
			else if($fldr == "filPubMod")
			{
				$route = $rootDocument.URL_PMOD_FL.$nameFileToDelete;	
			}
			else
			{
				exit();
			}
			
			if(file_exists($route))
			{
				unlink($route);
			}
		}
	}