<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
session_start();

$usuario = $_POST['usuario'];

$consulta = "SELECT USUARIO, ID_USUARIO, ESTADO FROM USUARIO where USUARIO =  '".$usuario."'";

$resultado = $mysqli->query($consulta);

if($resultado->num_rows>0){
  $user=$resultado->fetch_assoc();
  $id_user=$user['ID_USUARIO'];
  $nombreUsuario=$user['USUARIO'];
  if($user['ESTADO']==1){
    $consulta="UPDATE USUARIO SET ESTADO='1' WHERE ID_USUARIO='".$id_user."'";
    $resultado = $mysqli->query($consulta);
    echo"<script>alert('$nombreUsuario ha sido dado de baja.');window.location.href=\"panelAdministrador.php\"</script>";
  }else{
    echo"<script>alert('$nombreUsuario ya esta de baja.');window.location.href=\"panelAdministrador.php\"</script>";
  }
}else{
  echo"<script>alert('El usuario no existe.');window.location.href=\"panelAdministrador.php\"</script>";
}

 ?>
