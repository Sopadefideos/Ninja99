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

if($cantidad_añadir>$datos_producto['STOCK']){
  //echo"<script>alert('El stock no tiene suficiente capacidad!!.');window.location.href=\"modificarPedido.php?pedido=$id_pedido&pagina=$pagina_producto\"</script>";
}else{
  $consulta="SELECT * FROM PEDIDO WHERE CODIGO_PEDIDO='".$id_pedido."'";
  $resultado=$mysqli->query($consulta);
  $datos_Pedido=$resultado->fetch_assoc();

  $consulta="SELECT * FROM LINEA_PEDIDO";
  $resultado=$mysqli->query($consulta);
  $datos_LineaPedido=$resultado->fetch_assoc();

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
  if($resultado->num_rows>0){
  foreach ($datos_LineaPedido as $key) {
    if($datos_LineaPedido['PRODUCTO']==$id_producto){
      $id_linea=$datos_LineaPedido['CODIGO_LINEA_PEDIDO'];
      $precioBase=$cantidad_añadir*$datos_producto['PRECIO'];
      $cantidadDeImpuesto=$precioBase*$datos_Pedido['IMPUESTO'];
      $cantidadDeEnvio=$precioBase*$datos_Pedido['GASTOS_ENVIO'];
      $total=($precioBase+$cantidadDeImpuesto)+$cantidadDeEnvio;
      $total_de_linea=$datos_LineaPedido['TOTAL_LINEA']+$total;
      $cantidad_stock=$datos_LineaPedido['CANTIDAD']+$cantidad_añadir;
      $consulta="UPDATE LINEA_PEDIDO SET TOTAL_LINEA='$total_de_linea', CANTIDAD='$cantidad_stock' WHERE CODIGO_LINEA_PEDIDO='".$id_linea."' ";
      $resultado=$mysqli->query($consulta);
    }

  }
}

  $precioBase=$cantidad_añadir*$datos_producto['PRECIO'];
  $cantidadDeImpuesto=$precioBase*$datos_Pedido['IMPUESTO'];
  $cantidadDeEnvio=$precioBase*$datos_Pedido['GASTOS_ENVIO'];
  $total=($precioBase+$cantidadDeImpuesto)+$cantidadDeEnvio;
  if($datos_LineaPedido['PRODUCTO']!=$id_producto){
  $consulta="INSERT INTO LINEA_PEDIDO (CODIGO_PEDIDO, PRODUCTO, CANTIDAD,
    PRECIO_BASE, IMPUESTO, GASTOS_ENVIO, TOTAL_LINEA) VALUES
    ('$id_pedido', '$id_producto', '$cantidad_añadir', '$precio_producto',
      '$impuesto', '$gastosEnvio', '$total')";
      $resultado=$mysqli->query($consulta);
    }
      $total_pedido=0;
      $total_pedido=$total+$datos_Pedido['TOTAL_PEDIDO'];
      $consulta="UPDATE PEDIDO SET TOTAL_PEDIDO='$total_pedido' WHERE CODIGO_PEDIDO='".$id_pedido."'";
      $resultado=$mysqli->query($consulta);
      $stock_resultante=0;
      $stock_resultante=$datos_producto['STOCK']-$cantidad_añadir;
      $consulta="UPDATE PRODUCTO SET STOCK='$stock_resultante' WHERE CODIGO_INTERNO='".$id_producto."'";
      $resultado=$mysqli->query($consulta);
      if(mysqli_affected_rows($mysqli)>0){
       echo"<script>alert('Se ha añadido satisfactoriamente!!.');window.location.href=\"modificarPedido.php?pedido=$id_pedido&pagina=$pagina_producto\"</script>";
      }else{
       echo"<script>alert('No se ha añadido!!.');window.location.href=\"modificarPedido.php?pedido=$id_pedido&pagina=$pagina_producto\"</script>";
      }
}



    ?>
