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
        $mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
        $mysqli->set_charset("utf8");
        $id_producto=$_GET['product'];
        $consulta="SELECT * FROM PRODUCTO WHERE CODIGO_INTERNO='".$id_producto."'";
        $resultado=$mysqli->query($consulta);
        $datos_producto=$resultado->fetch_assoc();
        foreach ($datos_producto as $key => $value) {

        }
        ?>
        <form name="Registro" class="RegistroMedidas" method="post" class="LoginCabecera" action="actualizarProducto.php">
          <div class="formularioCampo">
            <label class='labelRegistrar' for="Nombre"> MARCA: </label>
            <input class="ProductoAlinear" name="marca" type="text" value="<?php echo $datos_producto['MARCA'] ?>"></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="User"> MODELO: </label>
            <input class="ProductoAlinear" name="modelo" type="text" value="<?php echo $datos_producto['MODELO'] ?>"></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="Contraseña"> PRECIO: </label>
            <input class="ProductoAlinear" name="precio" type="number" value="<?php echo $datos_producto['PRECIO'] ?>"></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRepetirContraseña' for="Contraseña"> IMPUESTOS: </label>
            <input class="ProductoAlinear" name="impuestos" type="number" value="<?php echo $datos_producto['TIPO_IMPOSITIVO'] ?>"></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="Correo"> REFERENCIA DEL FABRICANTE: </label>
            <input class="ProductoAlinear" name="refeFrabricante" type="text" value="<?php echo $datos_producto['REF_FABRICANTE'] ?>"></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="Calle"> DETALLES: </label>
            <input class="ProductoAlinear" name="detalles" type="text" value="<?php echo $datos_producto['DESCRIPCION'] ?>"></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="Numero"> STOCK: </label>
            <input class="ProductoAlinear" name="stock" type="number" value="<?php echo $datos_producto['STOCK'] ?>"></input>
          </div>

          <div class="formularioCampo">
            <label class='labelRegistrar' for="Piso"> GASTOS DE ENVIO: </label>
            <input class="ProductoAlinear" name="gastosEnvio" type="number" value="<?php echo $datos_producto['GASTOS_ENVIO'] ?>"></input>
          </div>

          <div class="formularioCampo">
            <input type="hidden" name="idProducto" value="<?php echo $datos_producto['CODIGO_INTERNO'] ?>">
            <input class="LoginBoton" type="submit" name="RegisterSubmit" id="RegisterSubmit" value="ACTUALIZAR"></input>
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
