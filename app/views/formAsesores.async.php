<div class="contenedorTabla <?= $cssClassElements ?>">
    <h2>Asesores</h2>
    <div class="divContainerTable divContainerTableAct">
        <div class="titleElements">Activos</div>
        <div class="contentMenu">
            <div class="auxiliarMenu auxiliarMenuNotEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoAsesor"> 
                    <i class="glyphicon glyphicon-plus icon-upload"></i>
                    <span>Nuevo</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnConsultarAsesor">
                    <i class="glyphicon glyphicon-eye-open icon-upload"></i>
                    <span>Consultar</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnModificarAsesor">
                    <i class="glyphicon glyphicon-pencil icon-upload"></i>
                    <span>Modificar</span>
                </div>
                <div class="mt-button" id="btnEliminarAsesor">
                    <i class="glyphicon glyphicon-trash icon-upload"></i>
                    <span>Dar de baja</span>
                </div>
            </div>
            <div class="auxiliarMenu auxiliarMenuEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoAsesor"> 
                    <i class="glyphicon glyphicon-plus  icon-upload"></i>
                    <span>Nuevo</span>
                </div>
            </div>
        </div>
        <table class='tblContent tableSearch tableUrlRdir' id="tblAsesores" data-filter-control="true" data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-radio='true'></th>
                    <th data-field='Id'>Id</th>
                    <th data-field='Nombre' data-filter-control='input'>Nombre</th>
                    <th data-field='Ape_paterno' data-filter-control='input'>Apellido paterno</th>
                    <th data-field='Ape_materno' data-filter-control='input'>Apellido materno</th>
                    <th data-field='Email' data-filter-control='input'>Correo electrónico</th>
                    <th data-field='Usuario' data-filter-control='input'>Nombre de usuario</th>
                    <th data-field='Telefono' data-filter-control='input'>Teléfono</th>
                    <th data-field='Tipo_asesor' data-filter-control='input'>Tipo de asesor</th>
                    <th data-field='UrlRdir'>Url</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaAsesores ?> </tbody>
        </table>
        <div class="messageElements">No hay asesores activos</div>
    </div>
    <div class="divContainerTable divContainerTableInact">
        <div class="titleElements">Inactivos</div>
          <div class="contentMenu">
            <div class="auxiliarMenu">
                <div class="mt-button" id="btnAsesorAlta"> 
                    <i class="glyphicon glyphicon-plus-circle icon-upload"></i>
                    <span>Dar de alta</span>
                </div>
            </div>
        </div>
        <table class='tblContent tableSearch tblContentInact' id="tblAsesoresBaja" data-filter-control="true" data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                    <th data-field='state' data-radio='true'></th>
                    <th data-field='Id'>Id</th>
                    <th data-field='Nombre' data-filter-control='input'>Nombre</th>
                    <th data-field='Ape_paterno' data-filter-control='input'>Apellido paterno</th>
                    <th data-field='Ape_materno' data-filter-control='input'>Apellido materno</th>
                    <th data-field='Email' data-filter-control='input'>Correo electrónico</th>
                    <th data-field='Usuario' data-filter-control='input'>Nombre de usuario</th>
                    <th data-field='Telefono' data-filter-control='input'>Teléfono</th>
                    <th data-field='Tipo_asesor' data-filter-control='input'>Tipo de asesor</th>
                    <th data-field='UrlRdir'>Url</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaAsesoresBaja ?> </tbody>
        </table>
        <div class="messageElements">No hay asesores inactivos</div>
    </div>
</div>