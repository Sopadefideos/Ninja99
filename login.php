<?php
$mysqli = new mysqli('localhost', 'root', '123456', 'PWpractica');
$mysqli->set_charset("utf8");

$pagina = $_POST['pagina'];
$usuario = $_POST['usuario'];//esto es lo que recojes del formulario
$producto=$_POST['product'];
$password = md5($_POST['password']);//esto es lo que recojes del formulario

$consulta = "SELECT USUARIO, PASSWORD, ROL, ID_USUARIO, ESTADO FROM USUARIO where USUARIO =  '".$usuario."'";

$resultado = $mysqli->query($consulta);

//Si existe el usuario, validamos también la contraseña ingresada y el estado del usuario...
if($resultado->num_rows>0){
     if($dato = $resultado->fetch_assoc()){
        if($dato!=0){
          if($dato['PASSWORD'] == $password){
            session_start();
            //Guardamos dos variables de sesión que nos informará si está o no "logueado" un usuario
            $_SESSION["autentica"] = "SIP";
            $_SESSION["usuarioactual"] = $dato["USUARIO"];
            $_SESSION["idusuario"] = $dato["ID_USUARIO"];
            $_SESSION["usuariorol"] = $dato["ROL"];
            $_SESSION["carrito"]= array();
            $_SESSION["cantidad"] = array();
            $_SESSION["stockActual"]=array();
            $_SESSION['precioSinImpuestos']=0;
            $_SESSION['modoPago'];
            if($pagina!='details'){
            header('Location: '.$pagina.'.php');
          }else{
            header('Location: '.$pagina.'.php?product='.$producto.'');
          }
          }
          else{
            echo"<script>alert('La contraseña del usuario no es correcta.');
            window.location.href=\"$pagina.php\"</script>";
          }

       }else{
         echo"<script>alert('El usuario esta dado de BAJA.');window.location.href=\"$pagina.php\"</script>";

       }
        }
   }
  else{
     echo"<script>alert('El usuario no existe.');window.location.href=\"$pagina.php\"</script>";
  }

$resultado->free();
$mysqli->close();

 ?>
