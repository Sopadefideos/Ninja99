<?php
  $mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
  $mysqli->set_charset("utf8");
  session_start();

  $nombre = $_POST['nombre'];
  $comunidad = $_POST['comunidad'];
  $provincia = $_POST['provincia'];
  $calle = $_POST['calle'];
  $numero = $_POST['numero'];
  $piso = $_POST['piso'];
  $puerta = $_POST['puerta'];
  $codigopostal = $_POST['codigopostal'];

  $consulta = "UPDATE USUARIO SET NOMBRE='$nombre', ID_COMUNIDAD='$comunidad', ID_PROVINCIA='$provincia', CALLE='$calle', NUMERO='$numero', PISO='$piso', PUERTA='$puerta', CODIGOPOSTAL='$codigopostal' WHERE USUARIO = '".$_SESSION["usuarioactual"]."'";

  $resultado = $mysqli->query($consulta);
  session_destroy();
  if(mysqli_affected_rows($mysqli)>0){
    echo"<script>alert('el formulario se ha rellenado satisfactoriamente.');
    window.location.href=\"Inicio.php\"</script>";
  }else{
    echo"<script>alert('el formulario no se ha rellenado correctamente.');
    window.location.href=\"ModificarUsuario.php\"</script>";
  }

?>
