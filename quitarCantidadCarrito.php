<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
session_start();

$cantidad=$_POST['cantidadQuitar'];
$producto=$_POST['idproductoCarrito'];

if($cantidad>0 && $cantidad<=$_SESSION['cantidad'][$producto]){
$_SESSION['cantidad'][$producto]=$_SESSION['cantidad'][$producto]-$cantidad;
$_SESSION['stockActual'][$producto]=$_SESSION['stockActual'][$producto]+$cantidad;
}else{
  echo"<script>alert('El stock no lo permite, introduzca una cantidad correcta.');
  window.location.href=\"Carrito.php\"</script>";
}

if($_SESSION['cantidad'][$producto]==0){
  unset($_SESSION['stockActual'][$producto]);
  unset($_SESSION['carrito'][$producto]);
  unset($_SESSION['cantidad'][$producto]);
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
}

header('Location: Carrito.php');

 ?>
