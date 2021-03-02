<div class="contenedorTabla <?= $cssClassElements ?>">
    <h2>Desafíos</h2>
    <div class="divContainerTable divContainerTableAct">
        <div class="titleElements">Activos</div>
        <div class="contentMenu">
            <div class="auxiliarMenu auxiliarMenuNotEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoProyecto"> 
                    <i class="glyphicon glyphicon-plus icon-upload"></i>
                    <span>Nuevo</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnConsultarProyecto">
                    <i class="glyphicon glyphicon-eye-open icon-upload"></i>
                    <span>Consultar</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnModificarProyecto">
                    <i class="glyphicon glyphicon-pencil icon-upload"></i>
                    <span>Modificar</span>
                </div>
                <div class="mt-button" id="btnEliminarProyecto">
                    <i class="glyphicon glyphicon-trash icon-upload"></i>
                    <span>Dar de baja</span>
                </div>
            </div>
            <div class="auxiliarMenu auxiliarMenuEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoProyecto"> 
                    <i class="glyphicon glyphicon-plus icon-upload"></i>
                    <span>Nuevo</span>
                </div>
            </div>
        </div>
        <table class='tblContent tableSearch tableUrlRdir' id="tblProyectos" data-filter-control="true" data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
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
                    <th data-field='UrlRdir'>Url</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaProyectos ?> </tbody>                    
        </table>
        <div class="messageElements">No hay desafíos activos</div>
    </div>
    <div class="divContainerTable divContainerTableInact">
        <div class="titleElements">Inactivos</div>
        <div class="contentMenu">
            <div class="auxiliarMenu">
                <div class="mt-button" id="btnProyectoAlta"> 
                    <i class="glyphicon glyphicon-plus-circle icon-upload"></i>
                    <span>Dar de alta</span>
                </div>
            </div>
        </div>
        <table class='tblContent tableSearch' id="tblProyectosBaja" data-filter-control="true" data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
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
                    <th data-field='UrlRdir'>Url</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaProyectosBaja ?> </tbody>
        </table>
        <div class="messageElements">No hay desafíos inactivos</div>
    </div>
</div>