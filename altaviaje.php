<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario ->id($id);
    $usuario -> tipoUsuario($tipo);
?>
<html>
<head>
	<title>Combi 19 </title>
	<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" > 
	<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" >
<script language="JavaScript" type="text/javascript" src ="js/validacionEditar.js"> </script>
<script  src= "js/menu.js"></script>
<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
</head>
 <?php 
    try {
    	$usuario -> administrador($tipo);
        if (isset ($_GET['error'])){
			$error=$_GET['error'];
		}
  ?>
  
<body style="background-color:LightGrey;" id="div_body" >
	<div class="div_body">

			<a class="btn btn-outline-primary" href="administracion.php">Volver</a>
            <?php echo menu($tipo);?>
		<div class=div_registro>
			<?php
		if (isset ($_GET['mensajeEditar'])){
			$mensaje = $_GET['mensajeEditar'];
			echo $mensaje;
		}
			?>

			<div class="mx-auto" style="max-width: 40rem;">
				<div class="card text-white bg-primary mb-3">
					<form name="publicarviaje" method="post" action="php/publicarviaje.php" enctype="multipart/form-data">
						<h2>Publicar viaje</h2>
						<p> Numero de viaje </p>
						<input type="number"  name="nro_viaje"  placeholder="Numero de viaje" size=50 autofocus    ></input><br><br>      
						<p> Precio del viaje </p>
						<input type="number"  name="precio"  placeholder="Precio viaje" size=50 autofocus    ></input><br><br>    
						<p> Fecha de salida </p>
						<input type="date"  name="fecha"  placeholder="Fecha de salida" size=50 autofocus    ></input><br><br>    
						<p> Email del conductor </p>
						<input type="text"  name="email"  placeholder="Chofer email" size=50 autofocus    ></input><br><br>    
						<p> Codigo de ruta </p>
						<input type="text"  name="codigo"  placeholder="Codigo ruta" size=50 autofocus    ></input><br><br>
						<input type="button" value="Submit" class="btn_editar" onclick = "altaviaje()">
					</form>
				</div>
			</div>
	</div>
</body>

	<div class="div-foot">
			<figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
			</figcaption>
	</div>

<?php
	} catch (Exception $e){
			echo $e->getMessage();
	?>
	<div class="body">
		 <br><br>		
			<a href="pagprincipal.php" > click aqui para volver a la pagina principal </a><br><br>	
			<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Click aqui para cerrar Sesion </a>
	</div>
		<div class= "div_foot">
		<p> Made by : Grupo 40 </p>
	</div>
		<?php	
	}
	?> 
</html>