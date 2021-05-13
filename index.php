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

		<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" > 
		<script  src= "js/Passwordcheckbox.js"></script>
		<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
	</head>



	<body style="margin: 1%" >
		<div class="mx-auto">
			<a  href="pagprincipal.php" >  
				<div class ="text-center"><img src="css/images/logo_is.png" style="max-width: 15rem;"></div>	
			</a>
		</div> <br> 
		

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



		<div class="mx-auto" style="max-width: 30rem;">

			<div class="card border-primary mb-3" style="max-width: 30rem;">	
				<form action="php/iniciarsesion.php" name="iniciarsesion" method="post"> 			         

					<div class="card-header">
						<h2 class="text-center">Iniciar Sesión</h2>
					</div>

					<div class="card-body">

      					<label for="exampleInputEmail1" class="form-label mt-4">Dirección de Email</label>
      						<input type="email" class="form-control" name="nombre" id="nombre" value="<?php echo $name ?>" aria-describedby="emailHelp" placeholder="Email" required>
      					<small id="emailHelp" class="form-text text-muted">No compartiremos tu email con terceros.</small>
						<br>


      					<label for="exampleInputPassword1" class="form-label mt-4">Contraseña</label>
      						<input type="password" class="form-control"  name="cont" id="contra" value="<?php echo $password ?>" minlength="6" placeholder="Contraseña" required>
						<br>

      				<div class="form-check form-switch">
        				<input class="form-check-input" type="checkbox" onclick="indexpassword()" id="flexSwitchCheckDefault">
        				<label class="form-check-label" for="flexSwitchCheckDefault">Mostrar Contraseña</label>
      				</div> 
					<br>
					<div class="text-center">
						<input type="submit" value="Iniciar Sesion"  class="btn btn-primary"> <br> <br>
						<a href="Registrarse.php" class="button">Registrarse como nuevo usuario </a> <br> <br>
						<a href="pagprincipal.php" class="button"> Ingresar como invitado </a>
						<br>
					</div>
					</div>
				</form>			
			</div>


			
			<br>
			<br>
		</div>


		<div class="mx-auto" style="max-width: 35rem;">		
		<?php	if (isset($_GET['mensaje'])){ ?>		
			<div class="alert alert-dismissible alert-warning">
			<?php echo ($_GET['mensaje'] . "<br><br>");
				echo ("Por favor intente nuevamente");	
		} ?>
			</div>
		</div>


	</body>


		<?php
		} catch (Exception $e){
			$msg= $e->getMessage();
		?>
		
	<div class="mx-auto" style="max-width: 35rem;">
		<div class="alert alert-dismissible alert-info">	
		
				<?php echo $msg. " como ". $_SESSION['email'] ?> <br><br>					
				<a href="pagprincipal.php" > Volver a la pagina principal </a><br><br>	
				<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Cerrar Sesion </a>
		</div>
	</div>
	<?php } ?> 
	<div class="div-foot">
			<figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
			</figcaption>
	</div>
</html>
        