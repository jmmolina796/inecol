<div class="contenedorTabla <?= $cssClassElements ?>">
    <h2>Grupos de capacitaciones</h2>
    <div class="divContainerTable divContainerTableAct">
        <!-- <div class="titleElements">Activas</div> -->
        <div class="contentMenu">
            <div class="auxiliarMenu auxiliarMenuNotEmp">
                <div class="mt-button mt-button-blue" id="btnCrearGrupos"> 
                    <i class="glyphicon glyphicon-plus  icon-upload"></i>
                    <span>Grupos</span>
                </div>
                <!-- <div class="mt-button mt-button-blue" id="btnConsultarCapacitacion">
                    <i class="glyphicon glyphicon-eye-open  icon-upload"></i>
                    <span>Consultar</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnModificarCapacitacion">
                    <i class="glyphicon glyphicon-pencil  icon-upload"></i>
                    <span>Modificar</span>
                </div>
                <div class="mt-button" id="btnEliminarCapacitacion">
                    <i class="glyphicon glyphicon-trash  icon-upload"></i>
                    <span>Dar de baja</span>
                </div> -->
            </div>
            <div class="auxiliarMenu auxiliarMenuEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoCapacitacion"> 
                    <i class="glyphicon glyphicon-plus  icon-upload"></i>
                    <span>Nuevo</span>
                </div>
            </div>
        </div>
        <table class='tblContent tableSearch' id="tblGruposCapacitaciones" data-filter-control="true" data-click-to-select='true' data-show-export='true' data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-radio='true'></th>
                    <th data-field='Id'>Id</th>
                    <th data-field='Proyecto' data-filter-control='input'>Proyecto</th>
                    <th data-field='Capacitacion' data-filter-control='input'>Capacitación</th>
                    <th data-field='Sesion' data-filter-control='input'>Sesión</th>
                    <th data-field='Nivel_educativo' data-filter-control='input'>Nivel educativo</th>
                    <th data-field='Total_docentes' data-filter-control='input'>Total de docentes</th>
                    <th data-field='Numero_grupos' data-filter-control='input'>Número de grupos</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaCapSesiones ?> </tbody>
        </table>
        <div class="messageElements">No hay capacitaciones activas</div>
    </div>
    <!-- <div class="divContainerTable divContainerTableInact">
        <div class="titleElements">Inactivas</div>
        <div class="contentMenu">
            <div class="auxiliarMenu">
                <div class="mt-button" id="btnCapacitacionAlta"> 
                    <i class="glyphicon glyphicon-plus-circle icon-upload"></i>
                    <span>Dar de alta</span>
                </div>
            </div>
        </div>
         <table class='tblContent tableSearch' id="tblGruposCapacitacionesBaja" data-filter-control="true" data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-radio='true'></th>
                    <th data-field='Id'>Id</th>
                    <th data-field='Nombre' data-filter-control='input'>Nombre</th>
                    <th data-field='Proyecto' data-filter-control='input'>Proyecto</th>
                    <th data-field='Sesiones' data-filter-control='input'>Sesiones</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaGruposCapacitacionesBaja ?> </tbody>
        </table>
        <div class="messageElements">No hay capacitaciones inactivas</div>
    </div> -->
</div>