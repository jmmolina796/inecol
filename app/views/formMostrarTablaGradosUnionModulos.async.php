<?php load("loader","modal"); ?>
<div class="content-modal">
    <span class="closeButton cancelarModal"></span>
    <div class="body-modal">
        <div class="contenedorGradosDocente">
            <h4 class="divGradosProyecto">Módulo <?= $nombre_modulo ?>:</h4>
            <div class="contenedorGrados">
                <?= $listaGradosNivelEdu ?>
            </div>    
            <p>¿Deseas participar en este módulo?</p>
            <h4>Elija con que escuela, grado y grupo se va a unir</h4>
            <div id="contenedorTablaUnionMuro" >
                <table id='tblGradosDocenteUnionMuro'  data-click-to-select='true'  data-maintain-selected='true'  >
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
            	<div class="mt-button cancelarModal">No</div>
                <div class="btnUnionModulo mt-button" data-IdModulo="<?= $id_modulo ?>" >Sí</div>
        	</div>
        </div>
    </div>
</div>