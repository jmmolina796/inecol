<div class="contenedorTabla <?= $cssClassElements ?>">
    <h2>Carpetas</h2>
    <div class="divContainerTable divContainerTableAct">
        <div class="titleElements">Carpetas activas</div>
        <div class="contentMenu">
            <div class="auxiliarMenu auxiliarMenuNotEmp">
                <div class="mt-button mt-button-blue" id="btnNuevaCarpetaProyecto"> 
                    <i class="glyphicon glyphicon-plus icon-upload"></i>
                    <span>Nuevo</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnConsultarCarpetaProyecto">
                    <i class="glyphicon glyphicon-eye-open icon-upload"></i>
                    <span>Consultar</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnModificarCarpetaProyecto">
                    <i class="glyphicon glyphicon-pencil icon-upload"></i>
                    <span>Modificar</span>
                </div>
                <div class="mt-button" id="btnEliminarCarpetaProyecto">
                    <i class="glyphicon glyphicon-trash icon-upload"></i>
                    <span>Dar de baja</span>
                </div>
            </div>
            <div class="auxiliarMenu auxiliarMenuEmp">
                <div class="mt-button mt-button-blue" id="btnNuevaCarpetaProyecto"> 
                    <i class="glyphicon glyphicon-plus icon-upload"></i>
                    <span>Nuevo</span>
                </div>
            </div>
        </div>
        <table class='tblContent tableSearch tableUrlRdir' id="tblCarpetasProyectos" data-filter-control="true" data-click-to-select='true' data-show-export='true' data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-radio='true'></th>
                    <th data-field='Id'>Id</th>
                    <th data-field='Nombre' data-filter-control='input'>Nombre</th>
                    <th data-field='Cantidad' data-filter-control='input'>Cantidad proyectos</th>
                    <th data-field='UrlRdir'>Url</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaCarpetasProyectos ?> </tbody>
        </table>
        <div class="messageElements">No hay carpertas activas</div>
    </div>
    <div class="divContainerTable divContainerTableInact">
        <div class="titleElements">Carpetas inactivas</div>
        <div class="contentMenu">
            <div class="auxiliarMenu">
                <div class="mt-button" id="btnAltaCarpetas"> 
                    <i class="glyphicon glyphicon-plus-circle icon-upload"></i>
                    <span>Dar de alta</span>
                </div>
            </div>
        </div> 
         <table class='tblContent tableSearch' id="tblCarpetasProyectosBaja" data-filter-control="true" data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-radio='true'></th>
                    <th data-field='Id'>Id</th>
                    <th data-field='Nombre' data-filter-control='input'>Nombre</th>
                    <th data-field='Cantidad' data-filter-control='input'>Cantidad Proyectos</th>
                    <th data-field='UrlRdir'>Url</th>
                </tr>
            </thead>
             <tbody> <?= $contenidoTablaBajaCarpetasProyectos ?> </tbody>
        </table>
        <div class="messageElements">No hay carpetas inactivas</div>
    </div>
</div>