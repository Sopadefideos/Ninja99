<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");

$consulta = "select * from usuario";

$resultado = $mysqli->query($consulta);
$dato = $resultado->fetch_assoc();
echo $dato['NOMBRE'];

?>
