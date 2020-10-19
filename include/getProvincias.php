<?php
	$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
	$mysqli->set_charset("utf8");

	$id_estado = $_POST['ID_COMUNIDAD'];

	$queryP = "SELECT ID_PROVINCIA, PROVINCIA FROM PROVINCIAS WHERE ID_COMUNIDAD = '$id_estado' ORDER BY PROVINCIA";
	$resultadoP = $mysqli->query($queryP);

	$html= "<option value='0'>Seleccionar Provincia</option>";

	while($rowP = $resultadoP->fetch_assoc())
	{
		$html.= "<option value='".$rowP['ID_PROVINCIA']."'>".$rowP['PROVINCIA']."</option>";
	}

	echo $html;
?>
