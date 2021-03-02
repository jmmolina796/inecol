<?php 

    if($mensaje === true)
    {
        $contentHtml = "";

        if($tipoBusqueda == 'proyectos')
        {
        	for($x=0;$x<count($informacion);$x++)
	        {

	            //list($imagen_portada,$nombre_proyecto,$ciclo_escolar,$fecha1,$fecha2,$url,$dato1,$dato2,$dato3,$dato4,$estado,$cantidad,$descripcion,$css_estado) = $informacion[$x];
	            list($imagen_portada,$nombre_proyecto,$url,$descripcion) = $informacion[$x];

	            /*if($cantidad == 0)
	            {
	            	$menCantidad = "No hay participantes";
	            }
	            else if($cantidad == 1)
	            {
	            	$menCantidad = $cantidad." participante";
	            }
	            else
	            {
	            	$menCantidad = $cantidad." participantes";
	            }*/

	            //$fecha1 = strtoupper(substr($fecha1,0,1)).substr($fecha1,1);

	            $contentHtml .= "<article class='goToUrl'>".
		            				"<div class='background' style='background-image: url(".URL_SERVER.URL_PRO_IMG.$imagen_portada.")'></div>".
		            				"<a class='itemBusquedaPrincipal' href='".projectLink($url)."'> ".
		                               "<div class='image'>".
				                         	"<img src='".URL_SERVER.URL_PRO_IMG.$imagen_portada."' />".
			                           	"</div>".
			                           	"<div class='info inProyecto'>".
					                        "<span class='title'>".
					                        	"<span>".$nombre_proyecto."</span>".
					                        "</span>".
					                        /*"<span class='text status ".$css_estado."'>".
					                        	"<span>".$estado."</span>".
					                        "</span>".
					                        "<span class='text'>".
					                        	"<span>".$ciclo_escolar."</span>".
					                        "</span>".
					                        "<span class='text'>".
					                        	"<span>".$fecha1." - ".$fecha2."</span>".
					                        "</span>".
					                        "<span class='text'>".
					                        	"<span>".$menCantidad."</span>".
					                        "</span>".*/
					                        "<span class='description'>".
					                        	"<span>".$descripcion."</span>".
					                        "</span>".
					                        "<span class='dots'></span>".
			                           	"</div>".
		                            "</a>".
		                        "</article>";
	        }
        }

        if($tipoBusqueda == 'modulos')
        {
        	for($x=0;$x<count($informacion);$x++)
	        {

	            list($nombre, $descripcion, $imagen_portada, $url) = $informacion[$x];

	            $contentHtml .= "<article class='goToUrl'>".
		            				"<div class='background' style='background-image: url(".URL_SERVER.URL_MOD_IMG.$imagen_portada.")'></div>".
		            				"<a class='itemBusquedaPrincipal' href='".moduleLink($url)."'> ".
		                               "<div class='image'>".
				                         	"<img src='".URL_SERVER.URL_MOD_IMG.$imagen_portada."' />".
			                           	"</div>".
			                           	"<div class='info inProyecto'>".
					                        "<span class='title'>".
					                        	"<span>".$nombre."</span>".
					                        "</span>".
					                        "<span class='description'>".
					                        	"<span>".$descripcion."</span>".
					                        "</span>".
					                        "<span class='dots'></span>".
			                           	"</div>".
		                            "</a>".
		                        "</article>";
	        }
        }

        if($tipoBusqueda == 'docentes')
        {
        	for($x=0;$x<count($informacion);$x++)
	        {

	            list($url_imagen, $nombre_docente, $nombre_usuario, $entidad, $municipio, $localidad, $clave, $nombre_escuela, $cantidad) = $informacion[$x];

	            $cantidad--;

                $contentHtml .= "<article class='goToUrl'>".
    	            				"<div class='background' style='background-image: url(".URL_SERVER.URL_DOC_IMG.$url_imagen.")'></div>".
    	            				"<a class='itemBusquedaPrincipal' href='".teacherProfileLink($nombre_usuario)."'> ".
    	                               "<div class='image'>".
    			                         	"<img src='".URL_SERVER.URL_DOC_IMG.$url_imagen."' />".
    		                           	"</div>".
    		                           	"<div class='info inTeacher'>".
    				                        "<span class='title'>".
    				                        	"<span>".$nombre_docente."</span>".
    				                        "</span>".
    				                        "<span class='text'>".
					                        	"<span>".$localidad." · ".$municipio." · ".$entidad."</span>".
					                        "</span>".
    				                        "<span class='text'>".
    				                        	"<span>".$nombre_escuela." · ".$clave."</span>".
    				                        "</span>";
    	        if($cantidad > 0)
    	        {
    	        	if($cantidad == 1)
	    	        {
	    	        	$cantidad = "Y una escuela más";
	    	        }
	    	        else
	    	        {
	    	        	$cantidad = "Y otras ".$cantidad." escuelas más";
	    	        }
							$contentHtml .= "<span class='text'>".
    				                        	"<span>".$cantidad."</span>".
    				                        "</span>";
    	        }
	            
				$contentHtml .= 	"</div>".
    	                            "</a>".
    	                        "</article>";
	        }
        }

        if($tipoBusqueda == 'escuelas')
        {
        	for($x=0;$x<count($informacion);$x++)
	        {
	            list($nombre_escuela,$clave_escuela,$entidad,$municipio,$localidad,$nivel_educativo) = $informacion[$x];

	            $contentHtml .= "<article class='goToUrl'>".
	            					"<div class='backgroundSchool'></div>".
						            "<a class='itemBusquedaPrincipal' href='".schoolLink($clave_escuela)."'  > ".
		                             	"<div class='image'>".
				                         	"<span class='imgSchool'></span>".
			                           	"</div>".
			                           	"<div class='info inEscuela'>".
					                        "<span class='title'>".
					                        	"<span>".$nombre_escuela."</span>".
					                        "</span>".
					                        "<span class='text'>".
					                        	"<span>".$clave_escuela."</span>".
					                        "</span>".
					                        "<span class='text'>".
					                        	"<span>".$localidad." · ".$municipio." · ".$entidad."</span>".
					                        "</span>".
					                        "<span class='text'>".
					                        	"<span>".$nivel_educativo."</span>".
					                        "</span>".
			                           	"</div>".
	                            	"</a>".
						        "</article>";
	        }   
        }

        if( $cantidadRows > 0)
        {
        	$contentHtml .= "<div id='obtenerMasResultados'>
								<div>Cargar más 
									<span>+ ".$cantidadRows."</span>
								</div>
							</div>";
        }
    }