<div class="form-consultar-docente cntFormPrincl cntRdImg cntTblEsc cntGrd">
	<h2>Consultar Docentes</h2>
	<div class="mt-form mt-principal form-docentes">
        <input type="text" data-name="Docente:" disabled="disabled" data-validate="none" data-label="Incorecto" data-require="false" value="<?= $nombre_docente?>" >
        <input type="text" data-name="Apellido Paterno:" disabled="disabled" data-validate="none" data-label="Incorecto"   data-require="false" value="<?= $ape_paterno?>" >
        <input type="text" data-name="Apellido Materno:"   disabled="disabled" data-validate="none" data-label="Incorecto" data-require="false" value="<?= $ape_materno?>" >
        <input type="text" data-name="Email:" disabled="disabled" data-validate="none" data-label="Incorecto" data-require="false" value="<?= $email?>" >
        <input type="text" data-name="Password:" disabled="disabled" data-validate="none" data-label="Incorecto" data-require="false" value="<?= $password?>" >
        <input type="text" data-name="Nombre de usuario:" data-validate="none" disabled="disabled" data-label="Incorecto" data-require="false" value="<?= $nombre_usuario?>" >
        <input type="text" data-name="Teléfono:" data-validate="none" disabled="disabled" data-label="Incorecto" data-require="false" value="<?= $telefono?>" >
        <input type="text" data-name="Entidad:" data-validate="none" disabled="disabled" data-label="Incorecto" data-require="false" value="<?= $entidad?>" >
        <input type="text" data-name="Municipio:" data-validate="none" disabled="disabled" data-label="Incorecto" data-require="false" value="<?= $municipio?>" >
        <input type="text" data-name="Localidad:" data-validate="none" disabled="disabled" data-label="Incorecto" data-require="false" value="<?= $nombre_localidad?>" >  
            <div class="fotoPerfilConsultar">
                <p>Foto de perfil</p>
                <img src='<?= URL_SERVER.URL_DOC_IMG.$imagen ?>'>
            </div>
                <div id="containerTablaEscuelasAgregadas">
                    <h4>Escuelas registradas</h4>
                    <table id='tblEscuelasAgregadasDocente' >
                        <thead>
                            <tr>
                                <th data-field='Clave'>Clave de escuela</th>
                                 <th data-field='Nombre'>Escuela</th>
                                 <th data-field='Nivel'>Nivel educativo</th>
                                 <th data-field='Entidad'>Grado</th>
                                 <th data-field='Municipio'>Grupo</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?= $tablaEsculasDocente ?>
                        </tbody>
                    </table>
                </div>
		<div  class="mt-button btnCancelDocentes">Regresar</div>
	</div>
</div>