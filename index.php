<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
	include "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
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
		$usuario -> noIniciada($usuarioID);	
		$name='';
		$password='';
		if (isset($_GET['mensaje'])){
			$name=$_SESSION['nombrei'];// en nombrei pongamos el email que es la clave
			$password=$_SESSION['conti'];// aca la contraseña
		}
	?>
		<div class="div_registro">
		<div class="inicio_sesion">
			<form action="php/iniciarsesion.php" name="iniciarsesion" method="post" >
				<h2> Inciar Sesi&oacuten </h2>   
			         
				<input type="text" name="nombre" size=30 id="nombre" value="<?php echo $name ?>" placeholder="Nombre Usuario" ><br><br></p>
			          
				<input type="password" name="cont" size=30  id="contra"	value="<?php echo $password ?>" minlength="6" placeholder="Clave" ><br>
				<input type="checkbox" onclick="indexpassword()">Mostrar Contraseña<br></p>
				<input type="submit" value="Iniciar Sesion"  class="btn"><br><br>
				<a href="Registrarse.php" class="button">Registrarse como nuevo usuario </a><br><br>
				<br>
			</form>			
		</div>
		<br>
		<a href="pagprincipal.php" class="button"> Proceder a pagina principal como usuario invitado </a>
	</div>
	<?php
			if (isset($_GET['mensaje'])){
			?>
			<div class="div_registro">
		<?php echo ($_GET['mensaje'] . "<br><br>");
				echo ("Por favor intente nuevamente");	
			} ?>
		</div>
		<div class= "div_foot">
		<p> Made by :Grupo 40 </p>
	</div> 
	</div>
	</body>
	
	<?php
	} catch (Exception $e){
			echo $e->getMessage();
	?>
		como <?php echo $_SESSION['email'] ?> <br><br>		
			<a href="pagprincipal.php" > Click aqui para volver a la pagina principal </a><br><br>	
			<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Click aqui para cerrar Sesion </a>
		<div class= "div_foot">
		<p> Made by :Grupo 40 </p>
	</div>
		<?php	
	}
	?> 
</html>
        