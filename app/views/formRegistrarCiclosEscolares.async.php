<div class="form-registrar-ciclosEscolares cntFormPrincl cntNtClEs">
	<h2>Registrar Ciclos Escolares</h2>
	<div class="nota-cicloEscolar">
    	<h4>Los ciclos escolares registrados forman parte de los 3 niveles educativos (preescolar, primaria y secundaria).</h4>
	</div>
	<div class="mt-form mt-principal form-ciclos">
        <input type="text" id="ciclo-nombre" name="nombre"  data-name="Nombre Ciclo Escolar:" maxlength="100" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ0-9\_\.\-\s]{1,100}$/" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<input type="text" id="ciclo-fechaInicio" name="fecha_inicio" data-name="Fecha de Inicio:" data-validate="empty-10"  data-label="Campo requerido" data-require="true" data-date="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="text" id="ciclo-fechaFin" name="fecha_fin" data-name="Fecha de Fin:"  data-validate="empty-10" data-label="Campo requerido" data-require="true" data-date="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<div class="form-buttons">
			<div  class="mt-button btnCancelCiclos">Cancelar</div>
	        <div data-check="div.mt-principal" class="mt-button mt-button-blue btnAceptarCiclos">Registrar</div>
		</div>
	</div>
</div>


