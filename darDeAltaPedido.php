<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
session_start();
if($_SESSION['usuariorol']==0){
  echo"<script>alert('NO HAGAS ESO!!.');window.location.href=\"Inicio.php\"</script>";
}

$pedido=$_GET['pedido'];

$consulta = "SELECT * FROM PEDIDO where CODIGO_PEDIDO =  '".$pedido."'";

$resultado = $mysqli->query($consulta);

  $envio=$resultado->fetch_assoc();
  if($envio['ESTADO']==1){
    $consulta="UPDATE PEDIDO SET ESTADO='0' WHERE CODIGO_PEDIDO='".$pedido."'";
    $resultado = $mysqli->query($consulta);
    echo"<script>alert('El pedido ha sido dado de alta.');window.location.href=\"panelAdministrador.php\"</script>";
  }else{
    echo"<script>alert('El pedido ya esta dado de alta.');window.location.href=\"panelAdministrador.php\"</script>";
  }


 ?>
