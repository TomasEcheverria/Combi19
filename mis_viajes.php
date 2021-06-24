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
    $usuario-> iniciada($usuarioID);?>
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
			<h1> Listado de pasajes personales </h1>
		</div>
        <?php $query1="SELECT * FROM pasajes WHERE idu='$id' AND fantasma='0' ORDER BY idp DESC";
			$result1= mysqli_query ($link, $query1) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
			$cantidad= mysqli_num_rows($result1);?>
			<h2>Cantidad de pasajes personales:<?php echo $cantidad; ?> </h2>
			
		<?php	while($pasaje= mysqli_fetch_array($result1)){ 
				$query2="SELECT * FROM viajes WHERE idv='$pasaje[idv]'";
			$result2= mysqli_query ($link, $query2) or die ('Consuluta query2 fallida: ' .mysqli_error($link));
			$viaje=	mysqli_fetch_array($result2);
			?>

            <div class ="container-fluid">
			<div class="card text-white bg-primary mb-3">Numero de pasaje:<?php echo $pasaje['idp']; ?>
				<div class="card-header"><?php if($pasaje['activo'] == 1){
				echo 'Pasaje activo';}else{ echo "Pasaje cancelado";}?><br>
				<?php if($pasaje['comentario'] == 1){
				echo 'Se realizo un comentario';}else{ echo "No se realizo un comentraio";}?></div>
				<div class="card-body"> 
					<h4 class="card-title"> <?php echo "numero de viaje".$viaje['nro_viaje'];?><br>
					<?php 
					 echo 'Estado del viaje: '.$viaje['estado'];?><br>
					<?php echo"Fecha de salida: ".$viaje['fecha']; ?></h4><br>
					<a class="card-text" href="pasaje.php?idp=<?php echo $pasaje['idp']; ?>" > Mas informacion </a>
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