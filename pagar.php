<?php
session_start();
$modo_pago=$_POST['pagar'];
$_SESSION['modoPago']=$modo_pago;
$_SESSION['horaPago']=date("Y-m-d H:i:s");
header('Location: Carrito.php?datosEnvio=true');
 ?>
