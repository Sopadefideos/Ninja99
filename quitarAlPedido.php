<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");

$id_pedido=$_POST['idPedido'];
$id_producto=$_POST['idproducto'];
$cantidad_añadir=$_POST['cantidad'];
$pagina_producto=$_POST['paginaProducto'];

$consulta="SELECT * FROM PRODUCTO WHERE CODIGO_INTERNO='".$id_producto."'";
$resultado=$mysqli->query($consulta);
$datos_producto=$resultado->fetch_assoc();

$consulta="SELECT * FROM PEDIDO WHERE CODIGO_PEDIDO='".$id_pedido."'";
$resultado=$mysqli->query($consulta);
$datos_Pedido=$resultado->fetch_assoc();

$consulta="SELECT * FROM LINEA_PEDIDO";
$resultado=$mysqli->query($consulta);
$datos_LineaPedido=$resultado->fetch_assoc();
if($cantidad_añadir>$datos_LineaPedido['CANTIDAD']){
  echo"<script>alert('El stock no tiene suficiente capacidad!!.');window.location.href=\"modificarPedido.php?pedido=$id_pedido&pagina=$pagina_producto\"</script>";
}else{
  $precioBase=0;
  $cantidadDeImpuesto=0;
  $cantidadDeEnvio=0;
  $total_de_linea=0;
  $cantidad_stock=0;
  $total=0;
  $id_linea=0;
  $precio_producto=$datos_producto['PRECIO'];
  $impuesto=$datos_Pedido['IMPUESTO'];
  $gastosEnvio=$datos_Pedido['GASTOS_ENVIO'];
  foreach ($datos_LineaPedido as $key) {
    if($datos_LineaPedido['PRODUCTO']==$id_producto){
      $id_linea=$datos_LineaPedido['CODIGO_LINEA_PEDIDO'];
      $precioBase=$cantidad_añadir*$datos_producto['PRECIO'];
      $cantidadDeImpuesto=$precioBase*$datos_Pedido['IMPUESTO'];
      $cantidadDeEnvio=$precioBase*$datos_Pedido['GASTOS_ENVIO'];
      $total=($precioBase+$cantidadDeImpuesto)+$cantidadDeEnvio;
      $total_de_linea=$datos_LineaPedido['TOTAL_LINEA']-$total;
      $codigo_linea_pedido=$datos_LineaPedido['CODIGO_LINEA_PEDIDO'];
      $cantidad_stock=$datos_LineaPedido['CANTIDAD']-$cantidad_añadir;
      $consulta="UPDATE LINEA_PEDIDO SET TOTAL_LINEA='$total_de_linea', CANTIDAD='$cantidad_stock' WHERE CODIGO_LINEA_PEDIDO='".$id_linea."' ";
      $resultado=$mysqli->query($consulta);
      if($cantidad_stock<=0){
        $consulta="DELETE FROM LINEA_PEDIDO WHERE CODIGO_LINEA_PEDIDO='".$codigo_linea_pedido."'";
        $resultado=$mysqli->query($consulta);
      }
    }

  }
  $precioBase=$cantidad_añadir*$datos_producto['PRECIO'];
  $cantidadDeImpuesto=$precioBase*$datos_Pedido['IMPUESTO'];
  $cantidadDeEnvio=$precioBase*$datos_Pedido['GASTOS_ENVIO'];
  $total=($precioBase+$cantidadDeImpuesto)+$cantidadDeEnvio;

      $total_pedido=0;
      $total_pedido=$datos_Pedido['TOTAL_PEDIDO']-$total;
      $consulta="UPDATE PEDIDO SET TOTAL_PEDIDO='$total_pedido' WHERE CODIGO_PEDIDO='".$id_pedido."'";
      $resultado=$mysqli->query($consulta);
      if($total_pedido<0 || $total_pedido=0){
        $consulta="DELETE FROM PEDIDO WHERE CODIGO_PEDIDO='".$id_pedido."'";
        $resultado=$mysqli->query($consulta);
        echo"<script>alert('Se ha eliminado el pedido!!.');window.location.href=\"panelAdministrador.php\"</script>";
      }
      $stock_resultante=0;
      $stock_resultante=$datos_producto['STOCK']+$cantidad_añadir;
      $consulta="UPDATE PRODUCTO SET STOCK='$stock_resultante' WHERE CODIGO_INTERNO='".$id_producto."'";
      $resultado=$mysqli->query($consulta);
      if(mysqli_affected_rows($mysqli)>0){
        echo"<script>alert('Se ha descontado satisfactoriamente!!.');window.location.href=\"modificarPedido.php?pedido=$id_pedido&pagina=$pagina_producto\"</script>";
      }else{
        echo"<script>alert('No se ha descontado!!.');window.location.href=\"modificarPedido.php?pedido=$id_pedido&pagina=$pagina_producto\"</script>";
      }
}

    ?>
