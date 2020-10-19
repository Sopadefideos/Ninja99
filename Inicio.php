<!DOCTYPE HTML>
<html lang="ES">
<head>
  <meta charset="utf-8">
  <link href="./css/estilos.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="./imagenes/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <title> Ninja 99 </title>
  <link rel="stylesheet" href="./css/flexslider.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="./js/jquery.flexslider.js"></script>
	<script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider({
    	touch: true,
    	pauseOnAction: false,
    	pauseOnHover: false,
    });
  });
</script>
</head>

<body>

  <header>
    <img class="LogoNinja" src="./imagenes/LogoNinja.png" alt="Ninja99" title="Ninja99">
    <?php
    session_start();
    $paginaActual = "Inicio";
    if(isset($_SESSION['autentica'])==false){
      include('login.html');
  }
  else{
    include('sesionIniciada.php');
    if($_SESSION['usuariorol']==1){
      include 'linkAdminsitrador.html';
    }
  }
     ?>
  </header>

  <nav>
    <ul class="menu">
        <li><a class="Inicio" href="./Inicio.php"></a></li>
        <li><a class="Hombre" href="./Hombre.php"></a></li>
        <li><a class="Mujer" href="./Mujer.php"></a></li>
        <?php
          if(isset($_SESSION['autentica'])==true){
        ?>
          <li><a class="Usuario" href="./ModificarUsuario.php"></a></li>
        <?php
          }
         ?>
    </ul>
  </nav>

  <article>
    <div class="flexslider">
  		<ul class="slides">
  			<li>
  				<img src="imagenes/thumb-1920-214604.png" alt="">
  				<section class="flex-caption">
  					<p class="slider">LAS MEJORES TABLAS</p>
  				</section>
  			</li>
  			<li>
  				<img src="imagenes/229015784-spitfire-wallpaper-skateboard.jpg" alt="">
  				<section class="flex-caption">
  					<p class="slider">MARCAS DE ENSUEÑO</p>
  				</section>
  			</li>
  			<li>
  				<img src="imagenes/wallpaper.wiki-Cool-Thrasher-Magazine-Wallpaper-PIC-WPD002506.jpg" alt="">
  				<section class="flex-caption">
  					<p class="slider">CONVIERTETE EN PROFESIONAL</p>
  				</section>
  			</li>
  		</ul>
  	</div>
  </article>

  <?php
    include('footer.html');
  ?>

</body>

</html>
