<?php load("loader","modal"); ?>
<div class="content-modal">
    <span class="closeButton cancelarModal"></span>
    <div class="body-modal">
        <div class="contenedorGradosDocente">
            <p>Usted ha decidido unirse al proyecto: <strong><?= $nombre_proyecto ?></strong></p>
            <p>Estos son los grados recomendados para este proyecto:</p>
            <div class="contenedorGrados">
                <?= $listaGradosNivelEdu ?>
            </div>   
            <p>Elija con que escuela, grado y grupo desea participar:</p>
            <div id="contenedorTablaUnionMuro">
                <table class="tblContent" id='tblGradosDocenteUnionMuro' data-click-to-select='true'  data-maintain-selected='true'  >
                    <thead>
                        <tr>
                            <th data-field='state' data-radio='true'></th>
                            <th data-field='clave_escuela'>Clave de escuela</th>
                            <th data-field='Nombre_escuela' >Nombre de la escuela</th>
                            <th data-field='nivel' >Nivel educativo</th>
                            <th data-field='grado' >Grado</th>
                            <th data-field='grupo' >Grupo</th>
                            <th data-field='id_grado' >id_grado</th>
                            <th data-field='id_grupo' >id_grupo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $contenidoTabla ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-buttons">
                <div class="mt-button cancelarModal">Regresar</div>
                <div class="btnUnionProyecto mt-button mt-button-blue" data-IdProyecto="<?= $id_proyecto ?>" >Unirse</div>
            </div>
        </div>
    </div>
</div>