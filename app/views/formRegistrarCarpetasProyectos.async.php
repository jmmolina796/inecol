<div class="form-registrar-carpeta-proyecto cntFormPrincl">
	<h2>Registrar una carpeta de proyecto</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="nombre-carpeta-proyecto" name="nombre" data-name="Nombre de la carpeta:" data-require="true" maxlength="70" data-validate="/^[a-zA-Z\s]{3,40}$/" data-label="Se requiere como mínimo 3 letras" data-require="true">
		<p>Seleccione los proyectos a relacionar con la carpeta de proyecto</p>
   </div>
   <div class="divContainerTable">
       <p class="titleElements">Proyectos que no estan relacionados con ninguna carpeta</p>  
		<table class='tblContent tableSearch' id="tblProyectosCarpetas" data-filter-control="true"  data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-checkbox='true'></th>
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
    			<div class="mt-button btnCancelCarpetasProyectos">Cancelar</div>
    			<div class="mt-button" data-check="div.mt-principal" id="btnCreateCarpetasProyecto">Guardar</div>
    		</div>
        </div> 
</div>