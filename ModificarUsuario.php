<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");

?>
<!DOCTYPE HTML>
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
    $paginaActual = "ModificarUsuario";
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

  <article class="modificacionesUsuario">
    <?php
    if(isset($_SESSION['autentica'])==true){
      $consulta1 = "select * from usuario where usuario = '".$_SESSION["usuarioactual"]."'";
      $resultado1 = $mysqli->query($consulta1);
      $dato = $resultado1->fetch_assoc();
      ?>

    </div>
    <div class="BloqueModificarDatos">
      <em class="titulo">MODIFICAR DATOS</em>
      <form class="RegistroMedidas" action="ModificarDatos.php" method="post">

        <div class="formularioCampo">
          <label class="etiquetaMod" for="Nombre"> Nombre: </label>
          <input class="RegistroAlinear" type="text" name="nombre" placeholder="nombre" value="<?php echo $dato['NOMBRE'];?> ">
        </div>

        <?php
        $consulta = "SELECT ID_COMUNIDAD, COMUNIDAD FROM COMUNIDADES ORDER BY COMUNIDAD ASC";
        $resultado = $mysqli->query($consulta);
        ?>

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

        <?php
        $consulta1 = "select * from usuario where usuario = '".$_SESSION["usuarioactual"]."'";
        $resultado1 = $mysqli->query($consulta1);
        $dato = $resultado1->fetch_assoc();
        ?>

        <div class="formularioCampo">
          <label class='labelRegistrar' for="Calle"> Calle: </label>
          <input class="RegistroAlinear" name="calle" type="text" value="<?php echo $dato['CALLE'];?> "></input>
        </div>

        <div class="formularioCampo">
          <label class='labelRegistrar' for="Numero"> Numero: </label>
          <input class="RegistroAlinear" name="numero" type="text" value="<?php echo $dato['NUMERO'];?> "></input>
        </div>

        <div class="formularioCampo">
          <label class='labelRegistrar' for="Piso"> Piso: </label>
          <input class="RegistroAlinear" name="piso" type="text" value="<?php echo $dato['PISO'];?> "></input>
        </div>

        <div class="formularioCampo">
          <label class='labelRegistrar' for="Puerta"> Puerta: </label>
          <input class="RegistroAlinear" name="puerta" type="text" value="<?php echo $dato['PUERTA'];?> "></input>
        </div>

        <div class="formularioCampo">
          <label class='labelRegistrar' for="CodigoPostal"> Codigo Postal: </label>
          <input class="RegistroAlinear" name="codigopostal" type="text" value="<?php echo $dato['CODIGOPOSTAL'];?> "></input>
        </div>

        <div class="formularioCampo">
          <input class="LoginBoton" type="submit" name="modificarDatos" id="modificarDatos" value="Aceptar"></input>
        </div>
      </form>
    </form>
  </div>

  <div class="modificacionesContra-User">

    <div class="BloqueModificarUsuario1">
      <em class="titulo">MODIFICAR NOMBRE DE USUARIO</em>
      <form class="RegistroMedidas" action="ModificarUser.php" method="post">

        <div class="formularioCampo">
          <label class="etiquetaMod" for="Nombre"> Usuario: </label>
          <input class="RegistroAlinear" type="text" name="usuario" placeholder="Usuario">
        </div>

        <div class="formularioCampo">
          <label class="etiquetaMod" for="Nombre"> Repetir usuario: </label>
          <input class="RegistroAlinear" type="text" name="usuario1" placeholder="Usuario">
        </div>

        <div class="formularioCampo">
          <input class="LoginBoton" type="submit" name="modificarUsuario" id="modificarUsuario" value="Aceptar"></input>
        </div>
      </form>
    </div>

    <div class="BloqueModificarUsuario2">
      <em class="titulo">MODIFICAR CONTRASEÑA</em>
      <form class="RegistroMedidas" action="ModificarContra.php" method="post">

        <div class="formularioCampo">
          <label class="etiquetaMod" for="Nombre"> Contraseña: </label>
          <input class="RegistroAlinear" type="password" name="password" placeholder="Contraseña">
        </div>

        <div class="formularioCampo">
          <label class="etiquetaMod" for="Nombre"> Repetir contraseña: </label>
          <input class="RegistroAlinear" type="password" name="password1" placeholder="Repite la contraseña">
        </div>

        <div class="formularioCampo">
          <input class="LoginBoton" type="submit" name="modificarContra" id="modificarContra" value="Aceptar"></input>
        </div>
      </form>
    </div>
  </div>
  <?php
  $usuarioAct=$_SESSION['idusuario'];
  echo $usuarioAct;
}
$consulta = "SELECT * FROM PEDIDO WHERE USUARIO='.$usuarioAct.'";
$resultado = $mysqli->query($consulta);
if($resultado->num_rows>0){
  ?>
  <div class="listaPedidos">
    <em class="titulo">LISTADO DE PEDIDOS</em>
    <div class="">
    <?php

    $consulta = "SELECT * FROM PEDIDO WHERE USUARIO='".$usuarioAct."' AND ESTADO='0'";
    $resultado = $mysqli->query($consulta);
    while($pedidos = $resultado->fetch_assoc()){
      ?>
      <div class="pedidos">
        <em class="titulo">PEDIDO Nº: <em class="InfoProductoRosa">&nbsp&nbsp<?php echo $pedidos['CODIGO_PEDIDO'] ?>&nbsp&nbsp</em>  REALIZADO POR: &nbsp&nbsp<em class="InfoProductoRosa"><?php echo $_SESSION['usuarioactual'] ?></em> .</em>
        <em class="titulo">FECHA DEL PAGO: &nbsp&nbsp<em class="InfoProductoRosa"><?php echo $pedidos['FECHA_PAGO'] ?></em></em>
        <em class="titulo">FECHA DE COMPRA: &nbsp&nbsp<em class="InfoProductoRosa"><?php echo $pedidos['FECHA_COMPRA'] ?></em></em>
        <em class="titulo">FECHA DE ENTREGA: &nbsp&nbsp<em class="InfoProductoRosa"><?php  echo $pedidos['FECHA_ENVIO']?></em></em>
        <em class="titulo">TOTAL: &nbsp&nbsp<em class="InfoProductoRosa"><?php  echo $pedidos['TOTAL_PEDIDO']?>€</em></em>
        <em class="titulo">PRODUCTOS:</em>
        <?php
        $cod_pedido=$pedidos['CODIGO_PEDIDO'];
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
      </div>
      <?php
    }
    ?>
    </div>
    <?php

  }
  ?>
</div>
<?php
if(isset($_SESSION['autentica'])==false){
  ?>
  <em class="titulo">PRIMERO LOGEATE PARA PODER HACER ESTO</em>

  <?php
}
?>
</article>

<?php
include('footer.html');
?>

</body>

</html>
