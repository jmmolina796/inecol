<?php

	$id_docente = "1";

	$peticion = $mysqli->prepare("CALL SP_getInfoDocente(?)");

	$peticion->bind_param("i",$id_docente);

	/* ejecuta sentencias prepradas */
	$peticion->execute();

	$peticion->bind_result(
		$val1,
		$val2,
		$val3,
		$val4,
		$val5,
		$val6,
		$val7,
		$val8,
		$val9,
		$val10,
		$val11,
		$val12,
		$val13,
		$val14
	);
	$peticion->fetch();

	$peticion->close();