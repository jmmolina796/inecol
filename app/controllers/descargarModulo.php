<?php

	if(isset($_GET["u"]) && isset($_GET["n"]))
	{
		$url = rawurldecode($_GET["u"]);
		$name = rawurldecode($_GET["n"]);

		$filename = $_SERVER['DOCUMENT_ROOT']."/public/modulos/".$url;

		if(file_exists($filename))
		{
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $filename);
			finfo_close($finfo);

			header("Content-type:".$mimeType);

			header('Content-Disposition:attachment;filename="'.$name.'"');

			readfile($filename);
		}
		else
		{
			goHome();
		}

	}
	else
	{
		goHome();
	}