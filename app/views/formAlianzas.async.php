<div class="contenedorTabla <?= $cssClassElements ?>">
    <h2>Alianzas</h2>
    <div class="divContainerTable divContainerTableAct">
        <div class="titleElements">Activas</div>
        <div class="contentMenu">
            <div class="auxiliarMenu auxiliarMenuNotEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoAlianza"> 
                    <i class="glyphicon glyphicon-plus  icon-upload"></i>
                    <span>Nuevo</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnConsultarAlianza">
                    <i class="glyphicon glyphicon-eye-open  icon-upload"></i>
                    <span>Consultar</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnModificarAlianza">
                    <i class="glyphicon glyphicon-pencil  icon-upload"></i>
                    <span>Modificar</span>
                </div>
                <div class="mt-button" id="btnEliminarAlianza">
                    <i class="glyphicon glyphicon-trash  icon-upload"></i>
                    <span>Dar de baja</span>
                </div>
            </div>
            <div class="auxiliarMenu auxiliarMenuEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoAlianza"> 
                    <i class="glyphicon glyphicon-plus  icon-upload"></i>
                    <span>Nuevo</span>
                </div>
            </div>
        </div>
        <table class='tblContent tableSearch' id="tblAlianzas" data-filter-control="true" data-click-to-select='true' data-show-export='true' data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-radio='true'></th>
                    <th data-field='Id'>Id</th>
                    <th data-field='Nombre' data-filter-control='input'>Nombre</th>
                    <th data-field='Descripcion' data-filter-control='input'>Descripción</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaAlianzas ?> </tbody>
        </table>
        <div class="messageElements">No hay alianzas activas</div>
    </div>
    <div class="divContainerTable divContainerTableInact">
        <div class="titleElements">Inactivas</div>
        <div class="contentMenu">
            <div class="auxiliarMenu">
                <div class="mt-button" id="btnAlianzaAlta"> 
                    <i class="glyphicon glyphicon-plus-circle icon-upload"></i>
                    <span>Dar de alta</span>
                </div>
            </div>
        </div>
         <table class='tblContent tableSearch' id="tblAlianzasBaja" data-filter-control="true" data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-radio='true'></th>
                    <th data-field='Id'>Id</th>
                    <th data-field='Nombre' data-filter-control='input'>Nombre</th>
                    <th data-field='Descripcion' data-filter-control='input'>Descripción</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaAlianzasBaja ?> </tbody>
        </table>
        <div class="messageElements">No hay alianzas inactivas</div>
    </div>
</div>