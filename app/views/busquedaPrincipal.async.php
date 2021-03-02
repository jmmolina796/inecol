<div id="contentSearch">
	<div id="busqueda">
		<div id="iconHide">
			<p>
				<span></span>
			</p>
		</div>
		<div id='contendorBusqueda' >
			<div id="contentTxtBusqueda">
				<input type="text" id="txtBusquedaPrincipal" placeholder="Buscar módulos:" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  />
				<p class="clear"></p>
			</div>
			<div id='contenedorItemsBusqueda'>
				<div id="auxCntItmsBsqdPrl"></div>
				<div id='loaderContenedorItemsBusqueda'>
					<?php load("loader","searchPrl"); ?>
				</div>
			</div>
		</div>
		<div id="contendorBotonesBusqueda">
			<div class="auxBotonesBusqueda">
				<!-- <div id="busquedaModulos" class='btnBusqueda selected' data-filtro='modulos'>
					<span class='btnBusqueda'></span>			
				</div> -->
				<div id="busquedaProyectos" class='btnBusqueda' data-filtro='proyectos'>
					<span class='btnBusqueda'></span>
				</div>
				<div id="busquedaDocentes" class='btnBusqueda' data-filtro='docentes'>
					<span class='btnBusqueda'></span>			
				</div>
				<div id="busquedaEscuelas" class='btnBusqueda' data-filtro='escuelas'>
					<span class='btnBusqueda'></span>
				</div>
			</div>
		</div>
	</div>
</div>