<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
session_start();

$usuario = $_POST['usuario'];

$consulta = "SELECT USUARIO, ID_USUARIO FROM USUARIO where USUARIO =  '".$usuario."'";

$resultado = $mysqli->query($consulta);

if($resultado->num_rows>0){
  $user=$resultado->fetch_assoc();
  $id_user=$user['ID_USUARIO'];
  $nombreUsuario=$user['USUARIO'];
  $consulta="DELETE FROM USUARIO WHERE ID_USUARIO='".$id_user."'";
  $resultado = $mysqli->query($consulta);
  echo"<script>alert('$nombreUsuario ha sido eliminado de la base de datos.');window.location.href=\"panelAdministrador.php\"</script>";
}else{
  echo"<script>alert('El usuario no existe.');window.location.href=\"panelAdministrador.php\"</script>";
}

 ?>
