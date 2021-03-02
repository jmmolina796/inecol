<div class="form-modificar-carpeta-proyecto cntFormPrincl">
<br><br>
	<h2>Modificar carpeta de proyecto</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="nombre-carpeta-proyecto" name="nombre" data-name="Nombre de la carpeta:" data-require="true" maxlength="70" data-validate="/^[a-zA-Z\s]{3,40}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" value="<?= $nombre_carpeta ?>" data-id_carp='<?= $id_carpeta ?>'>
		
    <br>
    
   </div>  
   <br>
   
   <div class="mt-form">
    <div class="mt-button" id='btnQuitarProyectoDeCarpeta'>Dar de Baja</div>
   </div>
<br>
<h4>Proyectos relacionados con la carpeta <span><?= $nombre_carpeta ?></span></h4>

		<table class='tblContent tableSearch' id="tblProyectosCarpetas" data-filter-control="true"  data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-radio='true'></th>
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
            <tbody> <?= $contenidoTablaProyectosDeCarpeta ?> </tbody>                    
        </table>


        <br><br>

        <div class="mt-form">
           
        <h4>Proyectos que no estan relacionados con ninguna carpeta</h4>  

        </div> 
<p><strong>Puede seleccionar de la tabla de abajo que otros proyectos relacionar con la carpeta </strong></p>
        <table class='tblContent tableSearch' id="tblProyectosSinCarpetas" data-filter-control="true"  data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
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
		<div class="mt-form">
    		<div class="form-buttons">
                <div class="mt-button btnCancelCarpetasProyectos">Regresar</div>
                <div class="mt-button btnUnirCarpetasProyectos">Modificar</div>
            </div>
        </div> 
</div>