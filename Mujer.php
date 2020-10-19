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
    $paginaActual = "Mujer";
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
    <div class="ContenedorProductos">
      <?php
      $mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
      $mysqli->set_charset("utf8");

      $consulta="SELECT * FROM PRODUCTO WHERE NOT ESTADO='1' AND STOCK>='0' AND FAMILIA BETWEEN 4 AND 9";
      $resultado = $mysqli->query($consulta);
      if(isset($_GET['pagina'])){
        if($_GET['pagina']==1){
          header("Location: Mujer.php");
        }else{
          $pagina=$_GET['pagina'];
        }
      }else{
        $pagina=1;
      }
      $contenidoPorPagina=12;
      $empezarDesde=($pagina-1)*$contenidoPorPagina;
      $numFilas=mysqli_num_rows($resultado);
      $totalPaginas= ceil($numFilas/$contenidoPorPagina);

      $consulta1="SELECT * FROM PRODUCTO
      WHERE NOT ESTADO='1' AND STOCK>='0' AND FAMILIA BETWEEN 4 AND 9
      ORDER BY FAMILIA DESC
      LIMIT $empezarDesde,$contenidoPorPagina";
      $resultado1 = $mysqli->query($consulta1);

      while($dato = $resultado1->fetch_assoc()){
        ?>
        <div class="Productos">
          <img src="./imagenes/Productos/<?php echo $dato['FOTOGRAFIA']; ?>" alt="nikesb" class="imagenesTienda">
          <div>
            <em class="InfoProducto">Producto: <em class="InfoProductoRosa"><?php echo $dato['MARCA']; ?>, <?php echo $dato['MODELO']; ?></em></em>
            <em class="InfoProducto">Precio: <em class="InfoProductoRosa"><?php echo $dato['PRECIO'] ?>€ + IVA</em></em>
            <a class="LogoutBoton" href="details.php?product=<?php echo $dato['CODIGO_INTERNO']; ?>">MOSTRAR DETALLES</a>
            <?php
            if(isset($_SESSION['autentica'])==true){
              ?>
              <form class="" action="agregarCarrito.php" method="post">
                <div class="formularioCampo">
                  <label class='labelStock' for="Numero"> Cantidad: </label>
                  <input class="inputStock" name="cantidad" type="number" placeholder="Stock maximo: <?php echo $dato['STOCK']; ?>"></input>
                </div>
                <input type="hidden" name="idproducto" value="<?php echo $dato['CODIGO_INTERNO']; ?>">
                <input class="carritoBoton" type="submit" name="RegisterSubmi" id="RegisterSubmit" value="AÑADIR AL CARRITO"></input>
                <input type="hidden" name="pagCarrito" value="<?php echo $paginaActual ?>">
              </form>
            <?php } ?>
          </div>

        </div>
        <?php
      }
      ?>
    </div>
    <div class="paginacionPosicion">
      <a class="paginacion" href="?pagina=1">Inicio</a>
      <?php
      for($i=1 ; $i<=$totalPaginas; $i++){
        ?>
        <a class="paginacion" href="?pagina=<?php echo $i ?>">&nbsp <?php echo $i ?> &nbsp</a>
      <?php } ?>
      <a class="paginacion" href="?pagina=<?php echo $totalPaginas ?>">Final</a>
    </div>
  </article>

  <?php
    include('footer.html');
  ?>

</body>

</html>
