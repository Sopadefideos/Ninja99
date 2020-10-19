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
  if($user['ROL']==0){
    $consulta="UPDATE USUARIO SET ROL='1' WHERE ID_USUARIO='".$id_user."'";
    $resultado = $mysqli->query($consulta);
    echo"<script>alert('$nombreUsuario es ahora ADMINISTRADOR.');window.location.href=\"panelAdministrador.php\"</script>";
  }else{
    echo"<script>alert('$nombreUsuario ya es ADMINISTRADOR.');window.location.href=\"panelAdministrador.php\"</script>";
  }
}else{
  echo"<script>alert('El usuario no existe.');window.location.href=\"panelAdministrador.php\"</script>";
}

?>
