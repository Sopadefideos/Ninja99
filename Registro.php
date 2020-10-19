<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");

$consulta = "SELECT ID_COMUNIDAD, COMUNIDAD FROM COMUNIDADES ORDER BY COMUNIDAD ASC";
$resultado = $mysqli->query($consulta);
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
        <input class="LoginBoton" type="submit" name="RegisterSubmit" id="RegisterSubmit" value="Registrate"></input>
      </div>

    </form>
  </article>

  <?php
  include('footer.html');
  ?>

</body>

</html>
