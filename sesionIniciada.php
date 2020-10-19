<div class="loggoutBoton">
  <em class="usuarioRegistrado">Usuario: <?php echo $_SESSION['usuarioactual']; ?></em>
  <?php
    if($paginaActual=='details'){
  ?>
      <a class="LogoutBoton" href="desconectar.php?pagina=<?php echo $paginaActual?>&product=<?php echo $producto ?>">Desconectar</a>
  <?php
    }else{
   ?>
   <a class="LogoutBoton" href="desconectar.php?pagina=<?php echo $paginaActual?>">Desconectar</a>
   <?php
    }
    ?>
    <a class="iconoCarrito" href="./Carrito.php"></a>
</div>
