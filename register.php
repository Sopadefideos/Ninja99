<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");
//correo provincia localidad calle numero piso puerta codigopostal

$nombre = $_POST['nombre'];

$usuario = $_POST['usuario'];

$password = md5($_POST['password']);

$password1 = md5($_POST['password1']);

if($password!=$password1){
  echo"<script>alert('Las contraseñas no coinciden.');
  window.location.href=\"Registro.php\"</script>";
}

$correo = $_POST['correo'];

$comunidad = $_POST['comunidad'];

$provincia = $_POST['provincia'];

$calle = $_POST['calle'];

$numero = $_POST['numero'];

$piso = $_POST['piso'];

$puerta = $_POST['puerta'];

$codigopostal = $_POST['codigopostal'];

$consulta = "INSERT INTO USUARIO (NOMBRE, USUARIO, PASSWORD, CORREO, ID_COMUNIDAD, ID_PROVINCIA, CALLE, NUMERO, PISO, PUERTA, CODIGOPOSTAL, FECHAREGISTRO) VALUES ('$nombre','$usuario','$password','$correo','$comunidad','$provincia','$calle','$numero','$piso','$puerta','$codigopostal', CURRENT_TIME())";

$resultado = $mysqli->query($consulta);

if(mysqli_affected_rows($mysqli)>0){
  echo"<script>alert('el formulario se ha rellenado satisfactoriamente.');
  window.location.href=\"Inicio.php\"</script>";
}else{
  echo"<script>alert('el formulario no se ha rellenado correctamente.');
  window.location.href=\"Registro.php\"</script>";
}

?>
