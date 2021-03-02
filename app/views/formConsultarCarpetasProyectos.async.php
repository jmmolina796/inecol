<div class="form-consultar-carpeta-proyecto cntFormPrincl">
	<h2>Consultar carpeta de proyecto</h2>
	<div class="mt-form mt-principal">		
		<div class="mt-form">
            <h4>Proyectos relacionados con la carpeta <?= $nombre_carpeta ?> </h4>	
        </div>
   </div> 
   <div class="divContainerTable">
		<table class='tblContent tableSearch' id="tblProyectosCarpetas" data-filter-control="true"  data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='Id'>Id</th>
                    <th data-field='Nombre' data-filter-control='input'>Nombre</th>
                    <th data-field='Inicio_convocatoria' data-filter-control='input'>Inicio de convocatoria</th>
                    <th data-field='Fin_convocatoria' data-filter-control='input'>Fin de convocatoria</th>
                    <th data-field='Fecha_incio' data-filter-control='input'>Fecha de inicio</th>
                    <th data-field='Fecha_fin' data-filter-control='input'>Fecha de fin</th>
                    <th data-field='Ciclo' data-filter-control='input'>Ciclo escolar</th>
                    <th data-field='Creado_por' data-filter-control='input'>Creado por</th>
                    <th data-field='Creado_el' data-filter-control='input'>Creado el</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaProyectos ?> </tbody>                    
        </table>
    </div>
	<div class="mt-form">
		<div class="form-buttons">
			<div class="mt-button btnCancelCarpetasProyectos">Regresar</div>
		</div>
    </div> 
</div>