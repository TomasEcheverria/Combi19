<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
	include "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
    $usuario -> tipoUsuario($tipo)
?>
<html>
	<head>
		<title>
			Combi 19
		</title>
		<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" > 
		<script  src= "js/Passwordcheckbox.js"></script>
		<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
	</head>
		</div>
	<body class = "body" >
		<div class="div_body">
			<div class="div_superior" >
				<p> Combi 19 <img src="css/images/muro.jpg" class="div_icono">
				</p>
			</div>
	<?php
	try {
		$usuario -> administrador($tipo);	
		?>
        <a href="listarviajes.php"> listarViaje </a> 
		<div class= "div_foot">
		<p> Made by : Grupo 40 </p>
	</div> 
	</div>
	</body>
	
	<?php
	} catch (Exception $e){
			echo $e->getMessage();
	?>
		como <?php echo $_SESSION['nombreUsuario'] ?> <br><br>		
			<a href="pagprincipal.php" > Click aqui para volver a la pagina principal </a><br><br>	
			<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Click aqui para cerrar Sesion </a>
		<div class= "div_foot">
		<p> Made by : Grupo 40 </p>
	</div>
		<?php	
	}
	?> 
</html>
        