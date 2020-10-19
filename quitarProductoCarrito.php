<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
session_start();

$posicion=$_POST['posicion'];
echo "posicion: $posicion";

unset($_SESSION['stockActual'][$posicion]);
unset($_SESSION['carrito'][$posicion]);
unset($_SESSION['cantidad'][$posicion]);

//CANTIDAD
$contador=0;
$cantidad=array();
foreach ($_SESSION['cantidad'] as $key) {
  $cantidad[$contador]=$key;
  $contador++;
}

unset($_SESSION['cantidad']);
$_SESSION['cantidad']=array();
$contador=0;
foreach ($cantidad as $key) {
  $_SESSION['cantidad'][$contador]=$key;
  $contador++;
}

//CARRITO
$contador=0;
$carrito=array();
foreach ($_SESSION['carrito'] as $key) {
  $carrito[$contador]=$key;
  $contador++;
}

unset($_SESSION['carrito']);
$_SESSION['carrito']=array();
$contador=0;
foreach ($carrito as $key) {
  $_SESSION['carrito'][$contador]=$key;
  $contador++;
}

//STOCKACTUAL
$contador=0;
$stockActual=array();
foreach ($_SESSION['stockActual'] as $key) {
  $stockActual[$contador]=$key;
  $contador++;
}

unset($_SESSION['stockActual']);
$_SESSION['stockActual']=array();
$contador=0;
foreach ($stockActual as $key) {
  $_SESSION['stockActual'][$contador]=$key;
  $contador++;
}

header('Location: Carrito.php');
 ?>
