<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
	<div id="webContent">
		<div class="contenedorTabla <?= $cssClassElements ?>">
			<h2>Ciclo escolar</h2>
			<div class="divContainerTable divContainerTableAct">
				<div class="titleElements">Ciclo escolar activo</div>
				<table class="tblContent" id='tblCiclosEscolaresActivos' data-click-to-select='true' data-maintain-selected='true' >
				    <thead>
				        <tr>
				            <th data-field='state' data-radio='true'> </th>
				            <th data-field='Id'>Id</th>
				            <th data-field='nombre'>Ciclo Escolar</th>
				            <th data-field='fecha_inicio'>Fecha Inicio</th>
				            <th data-field='fecha_fin'>Fecha Fin</th>
				        </tr>
				    </thead>
				    <tbody> <?= $contenidoTablaCiclos ?> </tbody>
				</table>
				<div class="messageElements">No hay ningún ciclo escolar activo</div>
			</div>
		</div>
	</div>
<?php load("footer") ?>