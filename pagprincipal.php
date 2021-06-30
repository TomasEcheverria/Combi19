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

	function getViajesPendientes(){
        $db = conectar();
        // Trae un numero que cuenta la cantidad de viajes con estado_imprevisto pendiente
        $sql = "SELECT COUNT(*) as 'pendientes'
		FROM `viajes` v 
		WHERE v.estado_imprevisto = 'pendiente' ";
        $result = mysqli_query($db,$sql);
		$data = $result->fetch_assoc();
		return $data['pendientes'];
    }
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
			<?php echo menu($tipo); ?><br>
		<!--Notifiaciones de imprevistos pendientes  -->	
			<div class="row">
				<?php if(getViajesPendientes() > 0): ?>
					<h4>Imprevistos pendientes <span class="badge rounded-pill bg-warning"><?php echo getViajesPendientes(); ?></span> </h4>
				<?php else: ?>
					<h4>No hay imprevistos pendientes</h4>
				<?php endif; ?>							
				
			</div>
			
			<?php if(!isset($_SESSION['id'])){?>
				No se ha iniciado sesion , solo podra ver comentarios y buscar viajes.<br><br>
			<a href="index.php"> Click aqui para iniciar sesion</a>
				<?php }else{?>
					Usted a iniciado sesion como <?php echo $usuarioID?>	
				<?php }?>
		<!--Comentarios   -->
		<div class="text-center" >
			<h1> Comentarios</h1>
		</div>
		<?php $query1="SELECT * FROM comentarios WHERE activo='1'";
			$result1= mysqli_query ($link, $query1) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
			while($comentario= mysqli_fetch_array($result1)){ ?>
			
		
		<div class ="container-fluid">
			<div class="card text-white bg-primary mb-3">
				<div class="card-header"><?php echo 'Fecha: '.$comentario['fecha_y_hora'].' Usuario:'.$comentario['email'];?></div>
				<div class="card-body">
					<h4 class="card-title"> <?php echo $comentario['texto_comentario'];?></h4>
					<p class="card-text"> 
				</div>
			</div>				
		</div>
		<?php } ?>

			<!-- Footer -->
			<figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
			</figcaption>
	</body>
</html>
