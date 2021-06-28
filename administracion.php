<?php
	include "BD.php";// conectar y seleccionar la base de datos
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
	<body class="text-center" style="margin: 1%">
	<div class="mx-auto" >
			<a  href="pagprincipal.php" >  
				<div class ="text-center"><img src="css/images/logo_is.png" style="max-width: 5rem;"></div>	
			</a>
		</div> <br> 
	<h2> Acciones de administrador </h2>
	<?php
	try {
		$usuario -> administrador($tipo);	
		?>
		<!-- List Group -->
		<div class="mx-auto" style="max-width: 30rem;" >
			<div class="list-group" >
				<h5> <a href="listarviajes.php" class="list-group-item list-group-item-action " > Listar viajes </a> </h5>
				<h5> <a href="altaviaje.php" class="list-group-item list-group-item-action "> Publicar un viaje </a> </h5>
				<h5><a href="vista_imprevistos_admin.php" class="list-group-item list-group-item-action "> Administrar Imprevistos </a> </h5>
				<h5> <a href="vista_choferes.php" class="list-group-item list-group-item-action "> Adminstrar choferes </a> </h5>
				<h5><a href="vista_insumos.php" class="list-group-item list-group-item-action "> Administrar insumos </a> </h5>
				<h5><a href="vista_combis.php" class="list-group-item list-group-item-action "> Administrar combis </a> </h5>
				<h5> <a href="vista_lugares.php" class="list-group-item list-group-item-action "> Administrar lugares </a> </h5>
				<h5><a href="vista_rutas.php" class="list-group-item list-group-item-action "> Administrar rutas </a> </h5>
			</div> 
		</div>
		<a class="btn btn-outline-primary" href="pagprincipal.php">Volver</a>
	</body>
	<br><br><br><br><br><br><br><br><br><br><br><br>
	<div class="div-foot">
			<figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
			</figcaption>
	</div>
	
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
        