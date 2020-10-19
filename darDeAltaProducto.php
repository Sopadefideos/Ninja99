<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
session_start();
if($_SESSION['usuariorol']==0){
  echo"<script>alert('NO HAGAS ESO!!.');window.location.href=\"Inicio.php\"</script>";
}

$producto=$_GET['product'];

$consulta = "SELECT * FROM PRODUCTO where CODIGO_INTERNO =  '".$producto."'";

$resultado = $mysqli->query($consulta);

  $product=$resultado->fetch_assoc();
  if($product['ESTADO']==1){
    $consulta="UPDATE PRODUCTO SET ESTADO='0' WHERE CODIGO_INTERNO='".$producto."'";
    $resultado = $mysqli->query($consulta);
    echo"<script>alert('El producto ha sido dado de alta.');window.location.href=\"panelAdministrador.php\"</script>";
  }else{
    echo"<script>alert('El producto ya esta dado de alta.');window.location.href=\"panelAdministrador.php\"</script>";
  }


 ?>
