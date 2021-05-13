<?php
	include "BD.php";// conectar y seleccionar la base de datoss
	$link = conectar();
	include "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
    $usuario -> tipoUsuario($tipo);
	$usuario->email($email)
?>
<html>
	<head>
		<title>
			Combi 19
		</title>
		<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" >
		<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" >  
		<script  src= "js/Passwordcheckbox.js"></script>
		<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
	</head>
	<body class="body">
	<h1> Acciones de administrador </h1>
	<?php
	try {
		$usuario -> administrador($tipo);	
		?>
		<!-- List Group -->
		<div class="list-group">
       		<h5> <a href="listarviajes.php" class="list-group-item list-group-item-action " > Listar viajes </a> </h5>
			<h5> <a href="altaviaje.php" class="list-group-item list-group-item-action "> Publicar un viaje </a> </h5>
			<h5> <a href="vista_choferes.php" class="list-group-item list-group-item-action "> Adminstrar choferes </a> </h5>
			<h5><a href="vista_insumos.php" class="list-group-item list-group-item-action "> Administrar insumos </a> </h5>
			<h5><a href="vista_combis.php" class="list-group-item list-group-item-action "> Administrar combis </a> </h5>
			<h5> <a href="vista_lugares.php" class="list-group-item list-group-item-action "> Administrar lugares </a> </h5>
			<h5><a href="vista_rutas.php" class="list-group-item list-group-item-action "> Administrar rutas </a> </h5>
		</div> 
		<div class= "div_foot">
		<p> Made by : Grupo 40 </p>
		</div> 
	</body>
	
	<?php
	} catch (Exception $e){
			echo $e->getMessage();
	?>
		 <br><br>		
			<a href="pagprincipal.php" > Click aqui para volver a la pagina principal </a><br><br>	
			<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Click aqui para cerrar Sesion </a>
		<div class= "div_foot">
		<p> Made by : Grupo 40 </p>
	</div>
		<?php	
	}
	?> 
</html>
        