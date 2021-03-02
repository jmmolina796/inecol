<div class="contenedorTabla <?= $cssClassElements ?>">
    <h2>Escuelas</h2>
    <div class="divContainerTable divContainerTableAct">
        <div class="titleElements">Activas</div>
        <div class="contentMenu">
            <div class="auxiliarMenu auxiliarMenuNotEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoEscuela"> 
                    <i class="glyphicon glyphicon-plus  icon-upload"></i>
                    <span>Nuevo</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnConsultarEscuela">
                    <i class="glyphicon glyphicon-eye-open  icon-upload"></i>
                    <span>Consultar</span>
                </div>
                <div class="mt-button mt-button-blue" id="btnModificarEscuela">
                    <i class="glyphicon glyphicon-pencil  icon-upload"></i>
                    <span>Modificar</span>
                </div>
                <div class="mt-button" id="btnEliminarEscuela">
                    <i class="glyphicon glyphicon-trash  icon-upload"></i>
                    <span>Dar de baja</span>
                </div>
            </div>
            <div class="auxiliarMenu auxiliarMenuEmp">
                <div class="mt-button mt-button-blue" id="btnNuevoEscuela"> 
                    <i class="glyphicon glyphicon-plus  icon-upload"></i>
                    <span>Nuevo</span>
                </div>
            </div>
        </div>
        <table class='tblContent tableSearch tableUrlRdir' id="tblEscuelas" data-filter-control="true" data-click-to-select='true' data-show-export='true' data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                     <th data-field='state' data-radio='true'> </th>
                     <th data-field='clave' data-filter-control='input'>Clave</th>
                     <th data-field='nombre' data-filter-control='input'>Nombre</th>
                     <th data-field='nivel_educativo' data-filter-control='input'>Nivel educativo</th>
                     <th data-field='entidad' data-filter-control='input'>Entidad</th>
                     <th data-field='municipio' data-filter-control='input'>Municipio</th>
                     <th data-field='localidad' data-filter-control='input'>Localidad</th>
                     <th data-field='UrlRdir'>Url</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaEscuelas ?> </tbody>         
        </table>
        <div class="messageElements">No hay escuelas activas</div>
    </div>
    <div class="divContainerTable divContainerTableInact">
        <div class="titleElements">Inactivas</div>
        <div class="contentMenu">
            <div class="auxiliarMenu">
                <div class="mt-button" id="btnEscuelaAlta"> 
                    <i class="glyphicon glyphicon-plus-circle icon-upload"></i>
                    <span>Dar de alta</span>
                </div>
            </div>
        </div>
         <table class='tblContent tableSearch' id="tblEscuelasBaja" data-filter-control="true" data-click-to-select='true' data-show-export='true'  data-maintain-selected='true' data-pagination='true' data-page-list='[5, 10, 20, 50, 100, 200 ,300 ]' >
            <thead>
                <tr>
                     <th data-field='state' data-radio='true'> </th>
                     <th data-field='clave' data-filter-control='input'>Clave</th>
                     <th data-field='nombre' data-filter-control='input'>Nombre</th>
                     <th data-field='nivel_educativo' data-filter-control='input'>Nivel educativo</th>
                     <th data-field='entidad' data-filter-control='input'>Entidad</th>
                     <th data-field='municipio' data-filter-control='input'>Municipio</th>
                     <th data-field='localidad' data-filter-control='input'>Localidad</th>
                     <th data-field='UrlRdir'>Url</th>
                </tr>
            </thead>
            <tbody> <?= $contenidoTablaEscuelasBaja ?> </tbody>
        </table>
        <div class="messageElements">No hay escuelas inactivas</div>
    </div>
</div>