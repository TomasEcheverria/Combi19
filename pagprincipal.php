<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	//$usuario -> id($id);
	$usuario -> id($id);
	$usuario -> tipoUsuario($tipo);
?>
<html>
	<head>
		<title>
			Combi 19 
		</title>
		<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" >
		<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" > 
		<script  src= "js/menu.js"></script>
		<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
	</head>
	<body style="margin: 1%">
		<!--Imagen   -->
        <div>
			<a  href="pagprincipal.php" >  
				<h1 class ="text-center"><img src="css/images/logo_is.png" class="div_icono"></h1>	
			</a>
		</div>
		<!--Boton menu   -->
			<?php echo menu($tipo); ?>
		<!--Comentarios   -->
		<div class="text-center" >
			<h1> Comentarios</h1>
		</div>
		<!--Primer Comentario   -->
		<div class ="container-fluid">
			<div class="card text-white bg-primary mb-3">
				<div class="card-header">30/01/1969 16:00</div>
				<div class="card-body">
					<h4 class="card-title">Usuario 1</h4>
					<p class="card-text">Don't let me down, don't let me down ...</p>
				</div>
			</div>				
		</div>
		<!--Segundo comentario   -->
		<div class ="container-fluid">
			<div class="card text-white bg-primary mb-3">
				<div class="card-header">30/01/1969 16:00</div>
				<div class="card-body">
					<h4 class="card-title">Usuario 2</h4>
					<p class="card-text">Don't let me down, don't let me down ...</p>
					</div>
			</div>				
		</div>
		<!--Tercer Comentario  -->
		<div class ="container-fluid">
			<div class="card text-white bg-primary mb-3">
				<div class="card-header">30/01/1969 16:00</div>
				<div class="card-body">
					<h4 class="card-title">Usuario 3</h4>
					<p class="card-text">Don't let me down, don't let me down ...</p>
					</div>
			</div>
		</div>
		<!--Footer   -->				
		</div>
			<figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
			</figcaption>
	</body>
</html>
