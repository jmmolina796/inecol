<tr>
    <td>
        <span class="glyphicon glyphicon-plus-sign iconAgregarEscuela" aria-hidden="true"></span>
        <?= $clave_escuela ?>
    </td>
	<td><?= $escuela ?></td>
	<td><?= $nivel_educativo ?></td>
	<td>
		<select class="slgrado" name="slgrado">
        	<?= $selectGrados ?>
		</select>
	</td>
	<td>
		<select class="slgrupo" name="slgrupo">
        	<?= $selectGrupos ?>
		</select>
	</td>
	<td>
		<span class="glyphicon glyphicon-remove-sign btnEliminarEscuelaDocente" aria-hidden="true"></span>
	</td>
</tr>