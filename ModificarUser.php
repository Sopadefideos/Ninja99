<?php
  $mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
  $mysqli->set_charset("utf8");
  session_start();

  $usuario = $_POST['usuario'];
  $usuario1 = $_POST['usuario1'];
  if($usuario==$usuario1){
    $consulta = "UPDATE USUARIO SET USUARIO = '$usuario' WHERE USUARIO.ID_USUARIO = $_SESSION[idusuario]";
    $resultado = $mysqli->query($consulta);
  }
  session_destroy();
  if(mysqli_affected_rows($mysqli)>0){
    echo"<script>alert('el formulario se ha rellenado satisfactoriamente.');
    window.location.href=\"Inicio.php\"</script>";
  }else{
    echo"<script>alert('el formulario no se ha rellenado correctamente.');
    window.location.href=\"ModificarUsuario.php\"</script>";
  }

?>
