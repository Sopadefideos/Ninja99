<!DOCTYPE HTML>
<html lang="ES">
<head>
  <meta charset="utf-8">
  <link href="./css/estilos.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="./imagenes/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <title> Ninja 99  </title>
  <script src="js/jquery.js"></script>

  <script language="javascript">
  $(document).ready(function(){
    $("#comunidad").change(function () {
      $("#comunidad option:selected").each(function () {
        ID_COMUNIDAD = $(this).val();
        $.post("include/getProvincias.php", { ID_COMUNIDAD: ID_COMUNIDAD }, function(data){
          $("#provincia").html(data);
        });
      });
    })
  });
  </script>

</head>

<body>

  <header>
    <img class="LogoNinja" src="./imagenes/LogoNinja.png" alt="Ninja99" title="Ninja99">
    <?php
    session_start();
    $paginaActual = "Carrito";
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
    if(isset($_SESSION['autentica'])==false){
      ?>
      <em class="titulo">PRIMERO LOGEATE PARA PODER HACER ESTO</em>

      <?php
    }else{
      if(empty($_SESSION['carrito'])==true){
        ?>
        <em class="titulo">PRIMERO AÑADE ALGUN PRODUCTO PARA PODER USAR ESTA HERRAMIENTA</em>
        <?php
      }
    }
    if(isset($_GET['confirmar'])==false){
      $pagar='no';
    }else{
      $pagar=$_GET['confirmar'];
    }
    $total=0;
    if(isset($_GET['datosEnvio'])==false){
      $datos_envio='no';
    }else{
      $datos_envio=$_GET['datosEnvio'];
    }

    if(isset($_SESSION['carrito'])==true && $pagar!='pago' && $datos_envio!='true'){
      $contador=0;
      foreach ($_SESSION['carrito'] as $valor) {
        $mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
        $mysqli->set_charset("utf8");
        $consulta = "SELECT MARCA, MODELO, FOTOGRAFIA, CODIGO_INTERNO, PRECIO, TIPO_IMPOSITIVO, GASTOS_ENVIO FROM PRODUCTO WHERE CODIGO_INTERNO =  '".$valor."'";

        $resultado = $mysqli->query($consulta);
        $product=$resultado->fetch_assoc();
        if($_SESSION['stockActual'][$contador]>=0){
          ?>
          <em class="InfoProducto">Producto: <a class="InfoProductoRosa" href="details.php?product=<?php echo $product['CODIGO_INTERNO']; ?>"><?php echo $product['MARCA'] ?>, <?php echo $product['MODELO'] ?></a> y su cantidad: <em class="InfoProductoRosa"><?php echo $_SESSION['cantidad'][$contador] ?></em></em>
          <em class="InfoProducto">Total: <?php echo $product['PRECIO']*$_SESSION['cantidad'][$contador] ?> €. + GE=(<?php echo round($product['GASTOS_ENVIO']*($product['PRECIO']*$_SESSION['cantidad'][$contador]),2) ?>),
            (IVA: <?php echo round($product['TIPO_IMPOSITIVO']*($product['PRECIO'] * $_SESSION['cantidad'][$contador]),2) ?>)</em>
            <form class="formQuitarCarrito" action="quitarCantidadCarrito.php" method="post">
              <div class="formularioCampo">
                <label class='labelQuitarCarrito' for="Numero"> Cantidad a quitar: </label>
                <input class="inputStock" name="cantidadQuitar" type="number" placeholder="Stock: <?php echo $_SESSION['cantidad'][$contador]; ?>"></input>
              </div>
              <input type="hidden" name="idproductoCarrito" value="<?php echo $contador; ?>">
              <input class="carritoBotonQuitar" type="submit" name="RegisterSubmi" id="RegisterSubmit" value="QUITAR CANTIDAD"></input>
              <input type="hidden" name="pagCarrito" value="<?php echo $paginaActual ?>">
            </form>

            <form class="formQuitarCarrito" action="quitarProductoCarrito.php" method="post">
              <input type="hidden" name="posicion" value="<?php echo $contador ?>">
              <input class="carritoBotonQuitar" type="submit" name="RegisterSubmi" id="RegisterSubmit" value="ELIMINAR DEL CARRITO"></input>
            </form>
            <?php
            $precio=$product['PRECIO']*$_SESSION['cantidad'][$contador];
            $ge=round($product['GASTOS_ENVIO']*($product['PRECIO']*$_SESSION['cantidad'][$contador]),2);
            $total=$total+($precio+$ge);
          }
          $contador++;
        }
        ?>
        <?php
        if(empty($_SESSION['carrito'])==false){
          $_SESSION['precioSinImpuestos']=$total;
          $total=0;
          ?>
          <div class="posicionBotonPago">
            <a class="botonPagar" href="?confirmar=pago">CONFIRMAR PAGO</a>
          </div>
          <?php
        }

      }
      if($pagar=='pago'){
        if(empty($_SESSION['carrito'])==false){
          ?>
          <div class="posicionPago">
            <div class="posicionformaBotonPago">
              <em class="titulo">PAGAR CON TRANSFERENCIA</em>
              <form name="Registro" class="RegistroMedidas" method="post" class="LoginCabecera" action="pagar.php">
                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Nombre"> NOMBRE: </label>
                  <input class="RegistroAlinear" name="nombre" type="text" required></input>
                </div>
                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Nombre"> DNI: </label>
                  <input class="RegistroAlinear" name="dni" type="text" required></input>
                </div>
                <div class="tituloCuentaPosicion">
                  <em class="tituloCuenta">Nº DE CUENTA:&nbsp<em class="InfoProductoRosa"> ES55 6666 6666 6666 6666</em></em>
                </div>
                <div class="tituloCuentaPosicion">
                  <em class="InfoProducto">Total: <em class="InfoProductoRosa"><?php echo $_SESSION['precioSinImpuestos'] ?> €.</em></em>
                </div>
                <div class="formularioCampo">
                  <input type="hidden" name="pagar" value="1">
                  <input class="LoginBoton" type="submit" name="pagarTrans" id="RegisterSubmit" value="PAGAR"></input>
                </div>
              </form>
            </div>
            <div class="posicionformaBotonPago">
              <em class="titulo">PAGAR CON TARJETA</em>
              <form name="Registro" class="RegistroMedidas" method="post" class="LoginCabecera" action="pagar.php">
                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Nombre"> NOMBRE: </label>
                  <input class="RegistroAlinear" name="nombre" type="text" required></input>
                </div>
                  <div class="formularioCampo">
                    <label class='labelRegistrar' for="Nombre"> Nº DE CUENTA: </label>
                    <input class="RegistroAlinear" name="cuenta" type="varchar" required></input>
                  </div>
                  <div class="formularioCampo">
                    <label class='labelRegistrar' for="Nombre"> CADUCIDAD: </label>
                    <input class="RegistroAlinear" name="nombre" type="text" required></input>
                  </div>
                  <div class="tituloCuentaPosicion">
                    <em class="InfoProducto">Total: <em class="InfoProductoRosa"><?php echo $_SESSION['precioSinImpuestos'] ?> €.</em></em>
                  </div>
                  <div class="formularioCampo">
                    <input type="hidden" name="pagar" value="2">
                    <input class="LoginBoton" type="submit" name="pagarTarjeta" id="RegisterSubmit" value="PAGAR"></input>
                  </div>
                </form>
              </div>
            </div>
            <?php
          }
        }
        if($datos_envio=='true'){

          $mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
          $mysqli->set_charset("utf8");
          $consulta = "SELECT ID_COMUNIDAD, COMUNIDAD FROM COMUNIDADES ORDER BY COMUNIDAD ASC";
        $resultado = $mysqli->query($consulta);
        ?>
        <form name="Registro" class="RegistroMedidas" method="post" class="LoginCabecera" action="hacerPedido.php">
          <div class="formularioCampo">
            <label class='labelRegistrar' for="Localidad"> Comunidad Autonoma: </label>
            <select class="Comunidades" name="comunidad" id="comunidad" required>
              <option value="0">Seleccionar Comunidad Autonoma</option>
              <?php
              while($row = $resultado->fetch_assoc()) {
                ?>
                <option value="<?php echo $row['ID_COMUNIDAD']; ?>"><?php echo $row['COMUNIDAD']; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="Provincia"> Provincia: </label>
            <select class="Provincias" name="provincia" id="provincia" required>
              <option value="0">Seleccionar Provincia</option>
            </select>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="Calle"> Calle: </label>
            <input class="RegistroAlinear" name="calle" type="text" required></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="Numero"> Numero: </label>
            <input class="RegistroAlinear" name="numero" type="text" required></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="Piso"> Piso: </label>
            <input class="RegistroAlinear" name="piso" type="text" ></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="Puerta"> Puerta: </label>
            <input class="RegistroAlinear" name="puerta" type="text" ></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="CodigoPostal"> Codigo Postal: </label>
            <input class="RegistroAlinear" name="codigopostal" type="text"></input>
          </div>

          <div class="formularioCampo">
            <input class="LoginBoton" type="submit" name="RegisterSubmit" id="RegisterSubmit" value="ACEPTAR PAGO"></input>
          </div>
        </form>

          <?php
        }
          ?>
      </article>

      <?php
      include('footer.html');
      ?>

    </body>

    </html>
