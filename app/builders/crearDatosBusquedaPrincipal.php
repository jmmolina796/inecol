<?php 

    if($mensaje === true)
    {
        $contentHtml = "";
        if($tipoBusqueda == 'proyectos')
        {
        	for($x=0;$x<count($informacion);$x++)
	        {
	            list($imagen_portada,$nombre_proyecto,$url) = $informacion[$x];
	            $contentHtml .= "<p class='itemBusquedaPrincipal'>".
	            					"<a href='".projectLink($url)."'  >".
		            					"<img src='".URL_SERVER.URL_PRO_IMG.$imagen_portada."'>".
		                             	"<span class='name'>".$nombre_proyecto."</span>".
	            					"</a>".
	            				"</p>";
	        }
        }
        if($tipoBusqueda == 'modulos')
        {
        	for($x=0;$x<count($informacion);$x++)
	        {

	            list($imagen_portada,$nombre_modulo,$url) = $informacion[$x];
				$contentHtml .= "<p class='itemBusquedaPrincipal'>".
	            					"<a href='".moduleLink($url)."'  >".
		            					"<img src='".URL_SERVER.URL_MOD_IMG.$imagen_portada."'>".
		                             	"<span class='name'>".$nombre_modulo."</span>".
	            					"</a>".
	            				"</p>";
	        }  
        }
        if($tipoBusqueda == 'docentes')
        {
        	for($x=0;$x<count($informacion);$x++)
	        {
	            list($url_imagen, $nombre_docente , $nombre_usuario) = $informacion[$x];

	            $contentHtml .= "<p class='itemBusquedaPrincipal'>".
	            					"<a href='".teacherProfileLink($nombre_usuario)."'>".
		            					"<img src='".URL_SERVER.URL_DOC_IMG.$url_imagen."'>".
		                             	"<span class='name'>".$nombre_docente."</span>".
	            					"</a>".
	            				"</p>";
	        }  
        }
        if($tipoBusqueda == 'escuelas')
        {
        	for($x=0;$x<count($informacion);$x++)
	        {

	            list($nombre_escuela,$clave_escuela,$municipio,$nivel_educativo) = $informacion[$x];
	            $contentHtml .= "<p class='itemBusquedaPrincipal'>".
	            					"<a href='".schoolLink($clave_escuela)."'>".
		            					"<span class='iconSchool'></span>".
		                             	"<span class='nameSchool name'>".$nombre_escuela."</span>".
		                             	"<span class='extra'>".$clave_escuela." · ".$municipio." · ".$nivel_educativo."</span>".
	            					"</a>".
	            				"</p>";
	        }  
        }

        $contentHtml .= "<p class='goToUrl'>".
        					"<a id='masResultados' href='".searchLink($tipoBusqueda, $filtroBusqueda)."'>".
        						"<span> Ver más resultados</span>".
        					"<a>".
        				"</p>";
    }