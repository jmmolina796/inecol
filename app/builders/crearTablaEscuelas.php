<?php
	
	$contentHtml = "<table class='tblContent tableSearch tableUrlRdirOne' id='tblEscuelasDocentes' data-filter-control='true' data-show-export='true' data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >".
	            "<thead>".
	                "<tr>".
	                    "<th data-field='clave' data-filter-control='input'>Clave</th>".
	                    "<th data-field='nombre' data-filter-control='input'>Nombre</th>".
	                    "<th data-field='nivel_educativo' data-filter-control='input'>Nivel educativo</th>".
	                    "<th data-field='entidad' data-filter-control='input'>Entidad</th>".
	                    "<th data-field='municipio' data-filter-control='input'>Municipio</th>".
	                    "<th data-field='localidad' data-filter-control='input'>Localidad</th>".
	                    "<th data-field='maestros' data-filter-control='input'>Maestros</th>".
                     	"<th data-field='UrlRdir'>Url</th>".
	                "</tr>".
	            "</thead>".
	            "<tbody> ".$contenidoTablaEscuelas."</tbody> ".        
	        "</table>";