<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
session_start();
if($_SESSION['usuariorol']==0){
  echo"<script>alert('NO HAGAS ESO!!.');window.location.href=\"Inicio.php\"</script>";
}

$producto=$_GET['product'];

$consulta = "SELECT * FROM PRODUCTO WHERE CODIGO_INTERNO =  '".$producto."'";

$resultado = $mysqli->query($consulta);

  $product=$resultado->fetch_assoc();
  if($product['ESTADO']==0){
    $consulta="UPDATE PRODUCTO SET ESTADO='1' WHERE CODIGO_INTERNO='".$producto."'";
    $resultado = $mysqli->query($consulta);
    echo"<script>alert('El producto ha sido dado de BAJA.');window.location.href=\"panelAdministrador.php\"</script>";
  }else{
    echo"<script>alert('El producto ya esta dado de BAJA.');window.location.href=\"panelAdministrador.php\"</script>";
  }


 ?>
