<!DOCTYPE HTML>
<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
$pagina=1;
$paginas=1;
?>
<html lang="ES">
<head>
  <meta charset="utf-8">
  <link href="./css/estilos.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="./imagenes/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <title> Ninja 99 </title>
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
    $paginaActual = "Inicio";
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
    $consulta = "SELECT ID_COMUNIDAD, COMUNIDAD FROM COMUNIDADES ORDER BY COMUNIDAD ASC";
    $resultado = $mysqli->query($consulta);
    if(isset($_SESSION['autentica'])==false){
      ?>
      <em class="titulo">PRIMERO LOGEATE PARA PODER HACER ESTO</em>
      <?php
    }else{
      if($_SESSION['usuariorol']!=1){
        ?>
        <em class="titulo">DEBES SER ADMINISTRADOR PARA PODER HACER ESTO</em>
        <?php
      }else{
        ?>
        <div class="administradorUsuario1-1">
          <em class="titulosAdministrador">GESTION DE USUARIOS</em>
          <div class="administradorUsuario2">
            <div class="BloqueModificarDatos">
              <em class="titulo">REGISTRAR UN USUARIO</em>
              <form name="Registro" class="RegistroMedidas" method="post" class="LoginCabecera" action="register.php">
                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Nombre"> Nombre: </label>
                  <input class="RegistroAlinear" name="nombre" type="text"></input>
                </div>

                <div class="formularioCampo">
                  <label class='labelRegistrar' for="User"> Usuario: </label>
                  <input class="RegistroAlinear" name="usuario" type="text" required></input>
                </div>

                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Contraseña"> Contraseña: </label>
                  <input class="RegistroAlinear" name="password" type="password" required></input>
                </div>

                <div class="formularioCampo">
                  <label class='labelRepetirContraseña' for="Contraseña"> Repetir contraseña: </label>
                  <input class="RegistroAlinear" name="password1" type="password" required></input>
                </div>

                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Correo"> Correo: </label>
                  <input class="RegistroAlinear" name="correo" type="email" required></input>
                </div>

                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Localidad"> Comunidad Autonoma: </label>
                  <select class="Comunidades" name="comunidad" id="comunidad">
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
                  <select class="Provincias" name="provincia" id="provincia">
                    <option value="0">Seleccionar Provincia</option>
                  </select>
                </div>

                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Calle"> Calle: </label>
                  <input class="RegistroAlinear" name="calle" type="text"></input>
                </div>

                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Numero"> Numero: </label>
                  <input class="RegistroAlinear" name="numero" type="text"></input>
                </div>

                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Piso"> Piso: </label>
                  <input class="RegistroAlinear" name="piso" type="text"></input>
                </div>

                <div class="formularioCampo">
                  <label class='labelRegistrar' for="Puerta"> Puerta: </label>
                  <input class="RegistroAlinear" name="puerta" type="text"></input>
                </div>

                <div class="formularioCampo">
                  <label class='labelRegistrar' for="CodigoPostal"> Codigo Postal: </label>
                  <input class="RegistroAlinear" name="codigopostal" type="text"></input>
                </div>

                <div class="formularioCampo">
                  <input class="LoginBoton" type="submit" name="RegisterSubmit" id="RegisterSubmit" value="DAR DE ALTA"></input>
                </div>

              </form>
            </div>
            <div class="administradorUsuario1-2">
              <div class="BloqueModificarDatos">
                <em class="titulo">DAR DE BAJA A UN USUARIO</em>
                <form class="RegistroMedidas" action="darDeBajaUsuario.php" method="post">
                  <div class="formularioCampo">
                    <label class='labelRegistrar' for="Nombre"> USUARIO: </label>
                    <input class="RegistroAlinear" name="usuario" type="text"></input>
                  </div>
                  <div class="formularioCampo">
                    <input class="LoginBoton" type="submit" name="RegisterSubmit"  value="DAR DE BAJA"></input>
                  </div>
                </form>
              </div>


              <div class="BloqueModificarDatos">
                <em class="titulo">DAR DE ALTA A UN USUARIO</em>
                <form class="RegistroMedidas" action="darDeAltaUsuario.php" method="post">
                  <div class="formularioCampo">
                    <label class='labelRegistrar' for="Nombre"> USUARIO: </label>
                    <input class="RegistroAlinear" name="usuario" type="text"></input>
                  </div>
                  <div class="formularioCampo">
                    <input class="LoginBoton" type="submit" name="RegisterSubmit"  value="DAR DE ALTA"></input>
                  </div>
                </form>
              </div>


              <div class="BloqueModificarDatos">
                <em class="titulo">ELIMINAR A UN USUARIO</em>
                <form class="RegistroMedidas" action="eliminarUsuario.php" method="post">
                  <div class="formularioCampo">
                    <label class='labelRegistrar' for="Nombre"> USUARIO: </label>
                    <input class="RegistroAlinear" name="usuario" type="text"></input>
                  </div>
                  <div class="formularioCampo">
                    <input class="LoginBoton" type="submit" name="RegisterSubmit"  value="ELIMINAR USUARIO"></input>
                  </div>
                </form>
              </div>


              <div class="BloqueModificarDatos">
                <em class="titulo">HACER ADMINISTRADOR A UN USUARIO</em>
                <form class="RegistroMedidas" action="hacerAdministrador.php" method="post">
                  <div class="formularioCampo">
                    <label class='labelRegistrar' for="Nombre"> USUARIO: </label>
                    <input class="RegistroAlinear" name="usuario" type="text"></input>
                  </div>
                  <div class="formularioCampo">
                    <input class="LoginBoton" type="submit" name="RegisterSubmit"  value="HACER ADMINISTRADOR"></input>
                  </div>
                </form>
              </div>

              <div class="BloqueModificarDatos">
                <em class="titulo">QUITAR ADMINISTRADOR A UN USUARIO</em>
                <form class="RegistroMedidas" action="quitarAdministrador.php" method="post">
                  <div class="formularioCampo">
                    <label class='labelRegistrar' for="Nombre"> USUARIO: </label>
                    <input class="RegistroAlinear" name="usuario" type="text"></input>
                  </div>
                  <div class="formularioCampo">
                    <input class="LoginBoton" type="submit" name="RegisterSubmit"  value="QUITAR ADMINISTRADOR"></input>
                  </div>
                </form>
              </div>


            </div>

          </div>
        </div>

        <div class="administradorUsuario1-1">
          <em class="titulosAdministrador">GESTION DE PRODUCTOS</em>
          <div class="administradorUsuario2-2">
            <?php
            $mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
            $mysqli->set_charset("utf8");

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
                  <a class="iconoProductoAlta" href="darDeAltaProducto.php?product=<?php echo $dato['CODIGO_INTERNO']; ?>"></a>
                  <a class="iconoProductoBaja" href="darDeBajaProducto.php?product=<?php echo $dato['CODIGO_INTERNO']; ?>"></a>
                  <a class="iconoProductoModificar" href="modificarProducto.php?product=<?php echo $dato['CODIGO_INTERNO']; ?>"></a>
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


        </div>

        <div class="administradorUsuario1-1">
          <em class="titulosAdministrador">GESTION DE PEDIDOS</em>
          <div class="administradorUsuario2-2-1">
            <?php
            $mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
            $mysqli->set_charset("utf8");

            $consulta="SELECT * FROM PEDIDO";
            $resultado = $mysqli->query($consulta);
            if($resultado->num_rows>0){

            if(isset($_GET['pedido'])==true){
              $paginas=$_GET['pedido'];
            }

            $contenidoPorPaginaa=10;
            $empezarDesdee=($paginas-1)*$contenidoPorPaginaa;
            $numFilaas=mysqli_num_rows($resultado);
            $totalPaginaas= ceil($numFilaas/$contenidoPorPaginaa);

            $consulta1="SELECT * FROM PEDIDO
            ORDER BY CODIGO_PEDIDO ASC
            LIMIT $empezarDesdee,$contenidoPorPaginaa";
            $resultado1 = $mysqli->query($consulta1);

            while($dato = $resultado1->fetch_assoc()){
              $user=$dato['USUARIO'];
              ?>

              <div class="">
                <em class="titulo">PEDIDO:&nbsp <?php echo $dato['CODIGO_PEDIDO'] ?>, &nbsp&nbsp&nbsp&nbspREALIZADO POR: &nbsp&nbsp<?php
                $consulta="SELECT USUARIO FROM USUARIO WHERE ID_USUARIO='".$user."'";
                $resultado=$mysqli->query($consulta);
                $nomUser=$resultado->fetch_assoc();
                $nombreUsuario=$nomUser['USUARIO'];
                echo $nombreUsuario;
                ?></em>
                <div class="bloqueIconosAdmin">
                  <a class="iconoProductoAlta" href="darDeAltaPedido.php?pedido=<?php echo $dato['CODIGO_PEDIDO']; ?>"></a>
                  <a class="iconoProductoBaja" href="darDeBajaPedido.php?pedido=<?php echo $dato['CODIGO_PEDIDO']; ?>"></a>
                  <a class="iconoProductoModificar" href="modificarPedido.php?pedido=<?php echo $dato['CODIGO_PEDIDO']; ?>"></a>
                </div>
              </div>
              <?php
            }
            ?>
          </div>
          <div class="paginacionPosicion">
            <a class="paginacion" href="?pedido=1">Inicio</a>
            <?php
            for($i=1 ; $i<=$totalPaginaas; $i++){
              ?>
              <a class="paginacion" href="?pedido=<?php echo $i ?>">&nbsp <?php echo $i ?> &nbsp</a>
            <?php } ?>
            <a class="paginacion" href="?pedido=<?php echo $totalPaginaas ?>">Final</a>

          </div>


        </div>
        <?php
      }
      }
    }
    ?>
  </article>

  <?php
  include('footer.html');
  ?>
</body>

</html>
