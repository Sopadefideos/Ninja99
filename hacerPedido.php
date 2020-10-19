<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
session_start();

$comunidad = $_POST['comunidad'];

$provincia = $_POST['provincia'];

$calle = $_POST['calle'];

$numero = $_POST['numero'];

$piso = $_POST['piso'];

$puerta = $_POST['puerta'];

$codigopostal = $_POST['codigopostal'];

if($comunidad==5){
  $impuesto=0.07;
  $gastosEnvio=0.02;
}elseif($comunidad==10){
  $impuesto=0.08;
  $gastosEnvio=0.02;
}elseif ($comunidad==15) {
  $impuesto=0.04;
  $gastosEnvio=0.02;
}else{
  $impuesto=0.21;
  $gastosEnvio=0.01;
}

$fechaCompra=date("Y-m-d H:i:s");


$datestart = strtotime('2018-6-1');//you can change it to your timestamp;
$dateend = strtotime('2018-7-31');//you can change it to your timestamp;
$daystep = 86400;
$datebetween = abs(($dateend - $datestart) / $daystep);
$randomday = rand(0, $datebetween);
$int=date("Y-m-d", $datestart + ($randomday * $daystep)) ;

$fechaEnvio= date("$int H:i:s");

$contador=0;
$precioTotal=0;
foreach ($_SESSION['carrito'] as $key) {
  $consulta="SELECT PRECIO FROM PRODUCTO WHERE CODIGO_INTERNO='".$key."'";
  $resultado=$mysqli->query($consulta);
  $producto=$resultado->fetch_assoc();
  $precio=$_SESSION['cantidad'][$contador]*$producto['PRECIO'];
  $cantidadImpuesto=$precio*$impuesto;
  $cantidadEnvio=$precio*$gastosEnvio;
  $precioTotal=$precioTotal+($precio+$cantidadEnvio+$cantidadImpuesto);
  $contador++;
}

$consulta1="INSERT INTO PEDIDO (USUARIO, FECHA_COMPRA, FECHA_PAGO, FECHA_ENVIO, COMUNIDAD, PROVINCIA, CALLE, NUMERO, PISO, PUERTA, CODIGO_POSTAL, IMPUESTO, GASTOS_ENVIO, TOTAL_PEDIDO, MODO_PAGO) VALUES
('$_SESSION[idusuario]',
  '$fechaCompra',
  '$_SESSION[horaPago]',
  '$fechaEnvio',
  '$comunidad',
  '$provincia',
  '$calle',
  '$numero',
  '$piso',
  '$puerta',
  '$codigopostal',
  '$impuesto',
  '$gastosEnvio',
  '$precioTotal',
  '$_SESSION[modoPago]')";

$resultado=$mysqli->query($consulta1);

$contador=0;
$precioTotal=0;
$precioBase=0;
foreach ($_SESSION['carrito'] as $key) {
  $idUsuario=$_SESSION['idusuario'];
  $consulta="SELECT CODIGO_PEDIDO FROM PEDIDO WHERE PEDIDO.USUARIO='".$idUsuario."' ORDER BY CODIGO_PEDIDO DESC
  LIMIT 1";
  $resultado=$mysqli->query($consulta);
  $pedido=$resultado->fetch_assoc();

  $consulta="SELECT PRECIO, STOCK FROM PRODUCTO WHERE CODIGO_INTERNO= '".$key."'";
  $resultado=$mysqli->query($consulta);
  $precio=$resultado->fetch_assoc();
  $precioo=$_SESSION['cantidad'][$contador]*$precio['PRECIO'];
  $cantidadImpuesto=$precioo*$impuesto;
  $cantidadEnvio=$precioo*$gastosEnvio;
  $precioTotal=$precioTotal+($precioo+$cantidadEnvio+$cantidadImpuesto);

  $cantidad=$_SESSION['cantidad'][$contador];
  $precioInicial=$precio['PRECIO'];
  $pedidoCod=$pedido['CODIGO_PEDIDO'];

  $consulta="INSERT INTO LINEA_PEDIDO (CODIGO_PEDIDO, PRODUCTO, CANTIDAD,
    PRECIO_BASE, IMPUESTO, GASTOS_ENVIO, TOTAL_LINEA) VALUES
    ('$pedidoCod', '$key', '$cantidad', '$precioInicial',
      '$impuesto', '$gastosEnvio', '$precioTotal')";
  $resultado=$mysqli->query($consulta);

  $nuevaCantidad=$precio['STOCK']-$_SESSION['cantidad'][$contador];
  echo $nuevaCantidad;
  $consulta = "UPDATE PRODUCTO SET STOCK = '$nuevaCantidad' WHERE CODIGO_INTERNO = '".$key."'";
  $resultado=$mysqli->query($consulta);
  $contador++;
}


  unset($_SESSION['carrito']);
  unset($_SESSION['cantidad']);
  unset($_SESSION['stockActual']);

  $_SESSION["carrito"]= array();
  $_SESSION["cantidad"] = array();
  $_SESSION["stockActual"]=array();


  echo"<script>alert('Su compra se ha efectuado correctamente, Gracias.');
  window.location.href=\"Carrito.php\"</script>";
 ?>
