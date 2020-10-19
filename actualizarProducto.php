<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");

$marca=$_POST['marca'];
$modelo=$_POST['modelo'];
$precio=$_POST['precio'];
$impuestos=$_POST['impuestos'];
$refeFabricante=$_POST['refeFrabricante'];
$detalles=$_POST['detalles'];
$stock=$_POST['stock'];
$gastosEnvio=$_POST['gastosEnvio'];
$id_producto=$_POST['idProducto'];

echo $stock;

$consulta="UPDATE PRODUCTO SET MARCA='$marca', MODELO='$modelo', PRECIO='$precio', TIPO_IMPOSITIVO='$impuestos',
REF_FABRICANTE='$refeFabricante', DESCRIPCION='$detalles', STOCK='$stock', GASTOS_ENVIO='$gastosEnvio' WHERE CODIGO_INTERNO='".$id_producto."'";
$resultado=$mysqli->query($consulta);


if(mysqli_affected_rows($mysqli)>0){
  echo"<script>alert('el formulario se ha rellenado satisfactoriamente.');
  window.location.href=\"panelAdministrador.php\"</script>";
}else{
  echo"<script>alert('el formulario no se ha rellenado correctamente.');
  window.location.href=\"panelAdministrador.php\"</script>";
}

 ?>
