<?php
  $mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
  $mysqli->set_charset("utf8");
  session_start();

  $password = md5($_POST['password']);
  $password1 = md5($_POST['password1']);
  if($password==$password1){
    $consulta = "UPDATE USUARIO SET PASSWORD='$password' WHERE USUARIO = '".$_SESSION["usuarioactual"]."'";

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
