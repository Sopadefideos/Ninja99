<!DOCTYPE HTML>
<html lang="ES">
<head>
  <meta charset="utf-8">
  <link href="./css/estilos.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="./imagenes/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <title> Ninja 99 </title>
</head>

<body>

  <header>
    <img class="LogoNinja" src="./imagenes/LogoNinja.png" alt="Ninja99" title="Ninja99">
    <?php
    session_start();
    $producto=$_GET['product'];
    $paginaActual = "details";
    if(isset($_SESSION['autentica'])==false){

      include('login.html');
    }
    else{
      include('sesionIniciada.php');
      if($_SESSION['usuariorol']==1){
        include('linkAdminsitrador.html');
      }
    }
    ?>
  </header>

  <nav>
    <ul class="menu">
      <li><a class="Inicio" href="./Inicio.php"></a></li>
      <li><a class="Hombre" href="./Hombre.php"></a></li>
      <li><a class="Mujer" href="./Mujer.php"></a></li>
      <?php
      if(isset($_SESSION['autentica'])==true){
        ?>
        <li><a class="Usuario" href="./ModificarUsuario.php"></a></li>
        <?php
      }
      ?>
    </ul>
  </nav>

  <article>
    <?php
    $mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
    $mysqli->set_charset("utf8");
    $consulta="SELECT * FROM PRODUCTO WHERE CODIGO_INTERNO =  '".$producto."'";
    $resultado=$mysqli->query($consulta);
    $dato = $resultado->fetch_assoc();
    $suplemento=round($dato['PRECIO']*$dato['TIPO_IMPOSITIVO'],2);
    ?>
    <div class="detallesProducto">

      <em class="detailProducto"><?php echo $dato['DESCRIPCION'] ?></em>
      <img src="./imagenes/Productos/<?php echo $dato['FOTOGRAFIA']; ?>" alt="nikesb" class="imagenesDetalle">
      <div>
        <em class="InfoProducto">Producto: <em class="InfoProductoRosa"><?php echo $dato['MARCA']; ?>, <?php echo $dato['MODELO']; ?></em></em>
        <em class="InfoProducto">Precio: <em class="InfoProductoRosa"><?php echo $dato['PRECIO'] ?> + IVA (<?php echo $suplemento ?>) € = <?php echo $suplemento+$dato['PRECIO'] ?>€</em></em>
        <?php
        if(isset($_SESSION['autentica'])==true){
          ?>
          <form class="formularioCarrito" action="agregarCarrito.php" method="post">
            <div class="formularioCampo">
              <label class='labelStock' for="Numero"> Cantidad: </label>
              <input class="inputStock" name="cantidad" type="number" placeholder="Stock maximo: <?php echo $dato['STOCK']; ?>"></input>
            </div>
            <input type="hidden" name="idproducto" value="<?php echo $dato['CODIGO_INTERNO']; ?>">
            <input class="carritoBoton" type="submit" name="RegisterSubmi" id="RegisterSubmit" value="AÑADIR AL CARRITO"></input>
            <input type="hidden" name="pagCarrito" value="<?php echo $paginaActual ?>">
            <input type="hidden" name="detalle" value="<?php echo $_GET['product'] ?>">
          </form>
        <?php } ?>
      </div>

    </div>
  </article>


  <?php
  include('footer.html');
  ?>

</body>

</html>
