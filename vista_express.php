<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
	include "php/classLogin.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
?>
<html>

<head>
	<title> Combi 19</title>
	<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" > 
	<script language="JavaScript" type="text/javascript" src ="js/validacionRegistro.js"> </script>
	<script  src= "js/Passwordcheckbox.js"></script>
</head>

<body style="margin: 1%" >
<?php try {
				$usuario -> iniciada($usuarioID);	
			?>
		<div class="mx-auto" style="max-width: 30rem;">
			<div class="card border-primary mb-3" style="max-width: 30rem;">
				<form name="registro" action="php/acciones_express.php"  method= "post" enctype="multipart/form-data" >
					<div class="card-header">
						<h2 class="text-center">Venta Express</h2>
					</div>

					<div class="card-body">
						<input type="text" class="form-control" name="nombre" placeholder=" Nombre" required> <br>          
						<input type="text" class="form-control" name="apellido" size=50 placeholder=" Apellido" required> <br>
						<input type="email" class="form-control" id="mail" name="user_mail"  placeholder=" Email de usuario" size=50 autofocus required> <br>
						<input type="text" class="form-control" name="dni" size=50 placeholder=" DNI" required> <br>          
						<input type="hidden" class="form-control" name="nacimiento" size=50 placeholder="Fecha de nacimiento" value="1">         
						<input type ="hidden" class="form-control" name="clave" size=50  minlength="6" placeholder=" Clave" value="Blow me Bully boys Blow">
						<input type="hidden" name="clave1" class="form-control" size=50   minlength= "6 " placeholder=" Confirmar Clave" value="Blow me Bully boys Blow"> 		
      				
						<div class="form-check form-switch">
							<input class="form-check-input" type="hidden" onclick="registrarsepassword()"><br><br>
						</div> 
						<div class="text-center">
							<a class="btn btn-outline-primary" href="pagprincipal.php">Volver</a>
							<input type="button" class="btn btn-primary" value="Siguiente"  onclick="validacion()">
							<br><br>
						</div>
						
					</div>
				</form>
			</div>
       </div>


   	<div class="div-foot">
			<figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
			</figcaption>
	</div>
</body>
<?php              
		} catch (Exception $e){
			$msg= $e->getMessage();
		?>
		
	<div class="mx-auto" style="max-width: 35rem;">
		<div class="alert alert-dismissible alert-info">	
		
				<?php echo $msg?> <br><br>					
				<a href="pagprincipal.php"> Volver a la pagina principal </a><br><br>	
				<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Cerrar Sesion </a>
		</div>
	</div>
	<?php } ?> 
</html>
