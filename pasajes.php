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
        <?php $query1="SELECT * FROM pasajes WHERE idu='$id'";
			$result1= mysqli_query ($link, $query1) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
			while($pasaje= mysqli_fetch_array($result1)){ ?>

            <div class ="container-fluid">
			<div class="card text-white bg-primary mb-3">Numero de pasaje:<?php echo $pasaje['idp']; ?>
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