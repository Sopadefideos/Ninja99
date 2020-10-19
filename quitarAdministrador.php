<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
session_start();

$usuario = $_POST['usuario'];

$consulta = "SELECT USUARIO, ID_USUARIO, ROL FROM USUARIO where USUARIO =  '".$usuario."'";

$resultado = $mysqli->query($consulta);

if($resultado->num_rows>0){
  $user=$resultado->fetch_assoc();
  $id_user=$user['ID_USUARIO'];
  $nombreUsuario=$user['USUARIO'];
  if($user['ROL']==1){
    $consulta="UPDATE USUARIO SET ROL='0' WHERE ID_USUARIO='".$id_user."'";
    $resultado = $mysqli->query($consulta);
    echo"<script>alert('$nombreUsuario ya no es ADMINISTRADOR.');window.location.href=\"panelAdministrador.php\"</script>";
  }else{
    echo"<script>alert('$nombreUsuario no es ADMINISTRADOR.');window.location.href=\"panelAdministrador.php\"</script>";
  }
}else{
  echo"<script>alert('El usuario no existe.');window.location.href=\"panelAdministrador.php\"</script>";
}

 ?>
