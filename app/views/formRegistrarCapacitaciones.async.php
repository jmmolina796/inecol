<div class="form-registrar-capacitacion cntFormPrincl">
	<h2>Registrar una capacitación</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="capacitacion-nombre" name="capacitacion-nombre" data-name="Nombre:" maxlength="70" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\.\,\-\_\s]{3,70}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <select class="sgl" id="slct-proyectos" name="slct-proyectos" data-label="Campo requerido" data-require="true" data-name="Desafío:">
            <?= $selectProyectos ?>
        </select>
		<div class="mt-form">
			<textarea name="capacitacion-descripcion" id="capacitacion-descripcion" data-name="Descripción:" maxlength="700" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
		</div>
        <div class="tr-sessions">
            <div class="mt-form tr-session-inf">
                <h3>Sesión 1</h3>
                <span class="glyphicon glyphicon-plus-sign icon-mt-form first-icon add-tr-session" aria-hidden="true"></span>
                <input type="text" id="cap-session-nombre-0" name="cap-session-nombre-0" data-name="Nombre:" maxlength="70" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\.\,\-\_\s]{3,70}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
                <div class="mt-form">
                    <textarea name="cap-session-descripcion-0" id="cap-session-descripcion-0" data-name="Descripción:" maxlength="700" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
                </div>
            </div>
        </div>
		<div class="form-buttons">
			<div class="mt-button btnCancelCapacitacion">Cancelar</div>
			<div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnCreateCapacitacion">Registrar</div>
		</div>
	</div>
</div>