<?php
session_start();

session_destroy();
$pagina=$_GET['pagina'];
$producto=$_GET['product'];
if($pagina=='details'){
  header('Location: '.$pagina.'.php?product='.$producto.'');
}elseif ($pagina!='ModificarUsuario' && $pagina!='panelAdministrador') {
  header('Location: '.$pagina.'.php');
}else{
  header('Location: Inicio.php');
}
exit();
 ?>
