<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
$pagina=1;
?>
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
    $paginaActual = "modificarProducto";
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
    if($_SESSION['usuariorol']==0){
      echo"<script>alert('NO HAGAS ESO!!.');window.location.href=\"Inicio.php\"</script>";
    }

    if($_SESSION['usuariorol']==1){
      $id_pedido=$_GET['pedido'];
      $consulta="SELECT * FROM PEDIDO WHERE CODIGO_PEDIDO='".$id_pedido."'";
      $resultado=$mysqli->query($consulta);
      $datos_pedido=$resultado->fetch_assoc();
      ?>

      <div class="administradorUsuario2-3">
        <div class="BloqueModificarDatos">
          <form name="Registro" class="RegistroMedidas" method="post" class="LoginCabecera" action="actualizarProducto.php">
            <div class="formularioCampo">
              <label class='labelRegistrar' for="Nombre"> FECHA DE ENVIO: </label>
              <input class="ProductoAlinear" name="marca" type="text" value="<?php echo $datos_pedido['FECHA_ENVIO'] ?>"></input>
            </div>

            <div class="formularioCampo">
              <label class='labelRegistrar' for="User"> FECHA DE PAGO: </label>
              <input class="ProductoAlinear" name="modelo" type="text" value="<?php echo $datos_pedido['FECHA_PAGO'] ?>"></input>
            </div>

            <div class="formularioCampo">
              <input type="hidden" name="idProducto" value="<?php echo $datos_pedido['CODIGO_PEDIDO'] ?>">
              <input class="LoginBoton" type="submit" name="RegisterSubmit" id="RegisterSubmit" value="ACTUALIZAR"></input>
            </div>

          </form>
        </div>

        <div class="BloqueModificarDatosPedido">
          <em class="titulo">PRODUCTOS:</em>
          <?php
          $pag_pedido=$_GET['pedido'];
          $cod_pedido=$datos_pedido['CODIGO_PEDIDO'];
          $consulta2 = "SELECT PRODUCTO FROM LINEA_PEDIDO WHERE CODIGO_PEDIDO='".$cod_pedido."'";
          $resultado2 = $mysqli->query($consulta2);
          while ($producto=$resultado2->fetch_assoc()) {
            $id_prod=$producto['PRODUCTO'];
            $consulta3 = "SELECT MARCA, MODELO FROM PRODUCTO WHERE CODIGO_INTERNO='".$id_prod."'";
            $resultado3 = $mysqli->query($consulta3);
            while($marcaModelo=$resultado3->fetch_assoc()){
              ?>
              <em class="titulo">MARCA:&nbsp&nbsp<em class="InfoProductoRosa"> <?php  echo $marcaModelo['MARCA']?></em>.&nbsp&nbsp&nbsp&nbsp MODELO: &nbsp&nbsp<em class="InfoProductoRosa"><?php echo $marcaModelo['MODELO'] ?></em></em>
              <?php
            }

          }
          ?>
          <em class="titulo">TOTAL:&nbsp&nbsp<em class="InfoProductoRosa"><?php echo $datos_pedido['TOTAL_PEDIDO'] ?>€</em></em>
          <?php

          ?>
          <em class="titulo">AÑADIR ALGUN PRODUCTO:</em>
          <?php
          $consulta="SELECT * FROM PRODUCTO";
          $resultado = $mysqli->query($consulta);

          if(isset($_GET['pagina'])==true){
            $pagina=$_GET['pagina'];
          }

          $contenidoPorPagina=12;
          $empezarDesde=($pagina-1)*$contenidoPorPagina;
          $numFilas=mysqli_num_rows($resultado);
          $totalPaginas= ceil($numFilas/$contenidoPorPagina);

          $consulta1="SELECT * FROM PRODUCTO
          ORDER BY CODIGO_INTERNO ASC
          LIMIT $empezarDesde,$contenidoPorPagina";
          $resultado1 = $mysqli->query($consulta1);

          while($dato = $resultado1->fetch_assoc()){
            ?>
            <div class="">
            <em class="titulo">PRODUCTO: &nbsp&nbsp<a class="titulosProduct" href="details.php?product=<?php echo $dato['CODIGO_INTERNO']; ?>"><?php echo $dato['MARCA'] ?>, <?php echo $dato['MODELO'] ?></a></em>
            <div class="bloqueIconosAdmin">
            <form class="" action="agregarAlPedido.php" method="post">
            <div class="formularioCampo">
            <label class='labelStock' for="Numero"> Cantidad: </label>
            <input class="inputStock" name="cantidad" type="number" placeholder="Stock maximo: <?php echo $dato['STOCK']; ?>"></input>
            </div>
            <input type="hidden" name="idproducto" value="<?php echo $dato['CODIGO_INTERNO']; ?>">
            <input class="carritoBoton" type="submit" name="RegisterSubmi" id="RegisterSubmit" value="AÑADIR AL PEDIDO"></input>
            <input type="hidden" name="idPedido" value="<?php echo $datos_pedido['CODIGO_PEDIDO'] ?>">
            <input type="hidden" name="paginaProducto" value="<?php echo $pagina ?>">
            </form>
            <form class="" action="quitarAlPedido.php" method="post">
            <div class="formularioCampo">
            <label class='labelStock' for="Numero"> Cantidad: </label>
            <input class="inputStock" name="cantidad" type="number" placeholder="Stock maximo: <?php echo $dato['STOCK']; ?>"></input>
            </div>
            <input type="hidden" name="idproducto" value="<?php echo $dato['CODIGO_INTERNO']; ?>">
            <input class="carritoBoton" type="submit" name="RegisterSubmi" id="RegisterSubmit" value="QUITAR AL PEDIDO"></input>
            <input type="hidden" name="idPedido" value="<?php echo $datos_pedido['CODIGO_PEDIDO'] ?>">
            <input type="hidden" name="paginaProducto" value="<?php echo $pagina ?>">
            </form>
            </div>
            </div>
            <?php
          }
          ?>
          <div class="paginacionPosicion">
          <a class="paginacion" href="?pedido=<?php echo $pag_pedido ?>&pagina=1">Inicio</a>
          <?php
          for($i=1 ; $i<=$totalPaginas; $i++){
            ?>
            <a class="paginacion" href="?pedido=<?php echo $pag_pedido ?>&pagina=<?php echo $i ?>">&nbsp <?php echo $i ?> &nbsp</a>
            <?php } ?>
            <a class="paginacion" href="?pedido=<?php echo $pag_pedido ?>&pagina=<?php echo $totalPaginas ?>">Final</a>

            </div>
            </div>

            </div>

            </div>

            <?php
          }
          ?>
          </article>

          <?php
          include('footer.html');
          ?>

          </body>

          </html>
