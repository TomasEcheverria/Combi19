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
<?php try{ 
    $usuario-> chofer($tipo);?>
    <body style="margin: 1%">
		<!--Imagen   -->
        <div>
			<a  href="pagprincipal.php" >  
				<h1 class ="text-center"><img src="css/images/logo_is.png" class="div_icono"></h1>	
			</a>
		</div>
		<!--Boton menu   -->
			<?php echo menu($tipo); ?><br>
		<!--Pasjes   -->
		<div class="text-center" >
			<h1> Listado de viajes a realizar</h1>
		</div>
        <?php $query1="SELECT * FROM viajes  WHERE idc='$id' AND activo='1' ORDER BY fecha DESC";
			$result1= mysqli_query ($link, $query1) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
			
			
			$query2="SELECT * FROM viajes  WHERE idc='$id' AND activo='1' AND estado!='finalizado' ORDER BY fecha ASC";//solo va a existir 1 viaje en curso
			$result2= mysqli_query ($link, $query2) or die ('Consuluta query2 fallida: ' .mysqli_error($link));
			$primero= mysqli_fetch_array($result2); 
			$cantidad= mysqli_num_rows($result2);?>

			
			<?php if($primero['estado'] == "pendiente") {?>
			<h3> Siguiente viaje a realizar </h3>
			<?php }else{?><h3> Viaje en curso </h3> <?php } ?>
			 <div class ="container-fluid">
			<div class="card text-white bg-primary mb-3">Numero de viaje :<?php echo $primero['nro_viaje']; ?>
				<div class="card-header"><?php if($primero['activo'] == 1){
				echo 'Viaje activo';}else{ echo "Viaje borrado";}?><br>
				<div class="card-body"> 
					<h4 class="card-title"> 
					<?php 
					 echo 'Estado del viaje: '.$primero['estado'];?><br>
					<?php echo"Fecha de salida: ".$primero['fecha']; ?><br>
					<?php if($primero['imprevisto'] !=''){ 
						echo "Imprevisto: ".$primero['imprevisto']; 
						} ?>
					</h4><br>
					<a class="card-text" href="viaje.php?idv=<?php echo $primero['idv']; ?>" > Mas informacion </a>
				</div>
			</div>				
		</div>
		
		<h2>Cantidad de viajes a realizar <?php echo $cantidad; //todos los viajes o los finalizados en otro lado? ?> </h2>
		<?php	while($viaje= mysqli_fetch_array($result2)){ ?>

			<div class ="container-fluid">
			<div class="card text-white bg-primary mb-3">Numero de viaje :<?php echo $viaje['nro_viaje']; ?>
				<div class="card-header"><?php if($viaje['activo'] == 1){
				echo 'Viaje activo';}else{ echo "Viaje borrado";}?><br>
				<div class="card-body"> 
					<h4 class="card-title"> 
					<?php 
					 echo 'Estado del viaje: '.$viaje['estado'];?><br>
					<?php echo"Fecha de salida: ".$viaje['fecha']; ?><br>
					<?php if($viaje['imprevisto'] !=''){ 
						echo "Imprevisto: ".$viaje['imprevisto']; 
						} ?>
					</h4><br>
					<a class="card-text" href="viaje.php?idv=<?php echo $viaje['idv']; ?>" > Mas informacion </a>
				</div>
			</div>				
		</div>
		<?php } ?> 
 	<?php	$query3="SELECT * FROM viajes  WHERE idc='$id' AND activo='1' AND estado='finalizado' ORDER BY fecha ASC";//solo va a existir 1 viaje en curso
		$result3= mysqli_query ($link, $query3) or die ('Consuluta query3 fallida: ' .mysqli_error($link));
		$cantidadf= mysqli_num_rows($result3);?>
		
		<h3> Viajes finalizados </h3>
		<?php	while($viaje= mysqli_fetch_array($result3)){ ?>

<div class ="container-fluid">
<div class="card text-white bg-primary mb-3">Numero de viaje :<?php echo $viaje['nro_viaje']; ?>
	<div class="card-header"><?php if($viaje['activo'] == 1){
	echo 'Viaje activo';}else{ echo "Viaje borrado";}?><br>
	<div class="card-body"> 
		<h4 class="card-title"> 
		<?php 
		 echo 'Estado del viaje: '.$viaje['estado'];?><br>
		<?php echo"Fecha de salida: ".$viaje['fecha']; ?><br>
		<?php if($viaje['imprevisto'] !=''){ 
			echo "Imprevisto: ".$viaje['imprevisto']; 
			} ?>
		</h4><br>
		<a class="card-text" href="viaje.php?idv=<?php echo $viaje['idv']; ?>" > Mas informacion </a>
	</div>
</div>				
</div>
<?php } ?> 
				
			<!-- Footer -->
			<figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
			</figcaption>
	</body>
<?php
	} catch (Exception $e){
			echo $e->getMessage();
	?>
		 <div class="mensajes">
		 <br><br>		
			<a href="pagprincipal.php"  class=""> click aqui para volver a la pagina principal </a><br><br>	
			<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Click aqui para cerrar Sesion </a>
	</div>	 
		 <div class= "div_foot">
		<p> Made by : Grupo 40 </p>
	</div>
		<?php	
	}
	?> 

</html>