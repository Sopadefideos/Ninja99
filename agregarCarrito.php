<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
session_start();

$cantidad=$_POST['cantidad'];
$id_producto=$_POST['idproducto'];
$pagina=$_POST['pagCarrito'];
if($pagina=='details'){
  $detalle=$_POST['detalle'];
}

$consulta="SELECT STOCK FROM PRODUCTO WHERE CODIGO_INTERNO='".$id_producto."'";
$resultado=$mysqli->query($consulta);
$stock=$resultado->fetch_assoc();
//$consulta="SELECT MARCA, MODELO, PRECIO, TIPO_IMPOSITIVO, GASTOS_ENVIO, STOCK FROM PRODUCTO WHERE CODIGO_INTERNO='".$id_producto."'";
//$resultado=$mysqli->query($consulta);

//$dato = $resultado->fetch_assoc();
//$carrito=$dato;

$cont = 0;
$coincidencia = 'false';
foreach ($_SESSION['carrito'] as $valor) {
  if ($valor == $id_producto){
    $consulta="SELECT STOCK FROM PRODUCTO WHERE '".$id_producto."'";
    $resultado=$mysqli->query($consulta);
    $stock=$resultado->fetch_assoc();
    if($_SESSION['stockActual'][$cont]>0 && $cantidad<=$_SESSION['stockActual'][$cont]){
      $_SESSION['cantidad'][$cont] += $cantidad;
      $_SESSION['stockActual'][$cont]-=$cantidad;
      $coincidencia = 'true';
      if($pagina=='details'){
        header('Location: '.$pagina.'.php?product='.$detalle.'');
      }else{
        header('Location: '.$pagina.'.php');
      }

    }else{
      $coincidencia='true';
      if($pagina=='details'){
        echo"<script>alert('El stock supera su capacidad.');
        window.location.href=\"$pagina.php?product=$detalle\"</script>";
      }else{
        echo"<script>alert('El stock supera su capacidad.');
        window.location.href=\"$pagina.php\"</script>";
      }
    }
  }
  $cont++;
}


if($coincidencia=='false'){
  $total_productos=$stock['STOCK']-$cantidad;
  if($total_productos>=0){
    array_push($_SESSION['cantidad'],$cantidad);
    array_push($_SESSION['carrito'] , $id_producto);
    array_push($_SESSION['stockActual'], $total_productos);
    if($pagina=='details'){
      header('Location: '.$pagina.'.php?product='.$detalle.'');
    }else{
      header('Location: '.$pagina.'.php');
    }

  }else{
    if($pagina=='details'){
      echo"<script>alert('El stock no lo permite, introduzca una cantidad correcta.');
      window.location.href=\"$pagina.php?product=$detalle\"</script>";
    }else{
      echo"<script>alert('El stock no lo permite, introduzca una cantidad correcta.');
      window.location.href=\"$pagina.php\"</script>";
    }
  }

}



$precio_total = 0;

foreach ($_SESSION['cantidad'] as $valor) {
  $precio_total += $valor;
}

foreach ($_SESSION['stockActual'] as $key) {
  echo ".  $key   .";
}

echo "la cantidad total de la compra es $precio_total";
//$_SESSION['carrito']++;
//header('Location: '.$pagina.'.php');
?>
