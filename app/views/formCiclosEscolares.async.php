<div class="contenedorTabla <?= $cssClassElements ?>">
    <h2>Ciclos Escolares</h2>
    <div class="divContainerTable divContainerTableAct">
        <div class="titleElements">Activo</div>
        <div class="contentMenu"> 
            <div class="auxiliarMenu auxiliarMenuNotEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoCiclo"> 
                    <i class="glyphicon glyphicon-plus icon-upload"></i>
                    <span>Nuevo</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnConsultarCiclo">
                    <i class="glyphicon glyphicon-eye-open icon-upload"></i>
                    <span>Consultar</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnModificarCiclo">
                    <i class="glyphicon glyphicon-pencil icon-upload"></i>
                    <span>Modificar</span>
                </div>
                <div class="mt-button" id="btnEliminarCiclo">
                    <i class="glyphicon glyphicon-trash icon-upload"></i>
                    <span>Dar de baja</span>
                </div>
            </div>
            <div class="auxiliarMenu auxiliarMenuEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoCiclo"> 
                    <i class="glyphicon glyphicon-plus  icon-upload"></i>
                    <span>Nuevo</span>
                </div>
            </div>
        </div>  
        <table class="tblContent" id='tblCiclosEscolaresActivos' data-click-to-select='true' data-maintain-selected='true'  >
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
    <div class="divContainerTable divContainerTableInact">
        <div class="titleElements">Inactivos</div>
        <div class="contentMenu">
            <div class="auxiliarMenu">
                <div class="mt-button" id="btnCicloEscolarAlta"> 
                    <i class="glyphicon glyphicon-plus-circle icon-upload"></i>
                    <span>Dar de alta</span>
                </div>
            </div>
        </div>
        <table class='tblContent tableSearch' id="tblHistorialCiclosEscolares" data-filter-control="true" data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-radio='true'> </th>
                    <th data-field='Id'>Id Ciclo Escolar</th>
                    <th data-field='nombre' data-filter-control='input'>Ciclo Escolar</th>
                    <th data-field='fecha_inicio' data-filter-control='input'>Fecha Inicio</th>
                    <th data-field='fecha_fin' data-filter-control='input'>Fecha Fin</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaCiclosBaja ?> </tbody>
        </table>
        <div class="messageElements">No hay ciclos escolares inactivos</div>
    </div>
</div>