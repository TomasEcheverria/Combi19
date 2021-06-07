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
						<p> Hora </p>   						
			   			<input type="time"  name="hora"  placeholder="Hora de salida" size=50 autofocus  required ></input><br><br>
						<p> Fecha de salida </p>
						<input type="date"  name="fecha"  placeholder="Fecha de salida" size=50 autofocus    ></input><br><br>    
						<p> Email del conductor </p>
						<select name="idc"> <br><br> 
							<?php $query1= "SELECT * FROM usuarios WHERE activo='1' AND tipo_usuario='chofer'";
								$result1= mysqli_query ($link, $query1) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
                                while ($chofer = mysqli_fetch_array($result1)) {
                                    ?>   
							<option value= "<?php echo $chofer['id'] ?>"> <?php echo $chofer['email']; ?> </option>
								<?php
                                } ?>
						</select> <br><br> 
						



						<p> Datos de la ruta: </p>
						<p> descripcion|origen|destino </p>
						<select name="idr"> <br><br> 
							<?php $query2= "SELECT * FROM rutas  WHERE activo='1'";
								$result2= mysqli_query ($link, $query2) or die ('Consuluta query2 fallida: ' .mysqli_error($link));
                                while ($ruta = mysqli_fetch_array($result2)){
									$query3= "SELECT * FROM lugares WHERE activo='1' AND idl='$ruta[codigo_postal_origen]'";
									$result3= mysqli_query ($link, $query3) or die ('Consuluta query3 fallida: ' .mysqli_error($link));
									$origen= mysqli_fetch_array($result3);//origen

									$query4= "SELECT * FROM lugares WHERE activo='1' AND idl='$ruta[codigo_postal_destino]'";
									$result4= mysqli_query ($link, $query4) or die ('Consuluta query4 fallida: ' .mysqli_error($link));
									$destino= mysqli_fetch_array($result4);//destino
								   ?>   
							<option value= "<?php echo $ruta['idr'] ?>"> <?php echo $ruta['descripcion'].'|'.$origen['nombre'].'|'.$destino['nombre'];?> </option>
								<?php
                                } ?>
						</select> <br><br> -->
						
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