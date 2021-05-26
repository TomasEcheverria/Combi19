<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario ->id($id);
    $usuario -> tipoUsuario($tipo);
    $idviaje = $_GET['idv']
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
         $query50 ="SELECT * FROM viajes  WHERE idv='$idviaje'";
        $result50=mysqli_query ($link, $query50) or die ('Consulta query50 fallida: ' .mysqli_error($link));
        $datos=(mysqli_fetch_array($result50)); 
       
        $idc =$datos['idc'];
        $query51 ="SELECT email FROM usuarios WHERE id='$datos[idc]'";
        $result51=mysqli_query ($link, $query51) or die ('Consulta query51 fallida: ' .mysqli_error($link));
        $chofer=(mysqli_fetch_array($result51)); 
		
        $query52 ="SELECT descripcion FROM rutas WHERE idr='$datos[idr]'";
        $result52=mysqli_query ($link, $query52) or die ('Consulta query51 fallida: ' .mysqli_error($link));
        $ruta=(mysqli_fetch_array($result52)); 
        if (isset ($_GET['error'])){
			$error=$_GET['error'];
		}
  ?>
<body id="div_body" >
	<div class="div_body">
		
			<a class="btn btn-outline-primary" href="listarviajes.php">Volver</a>

             <?php echo menu($tipo);?>
             <p > Modificacion del viaje <?php echo $idviaje?>
		<div class=div_registro>
			<p class="table"> Escriba solo los campos que desea modificar</p>

			<?php
		if (isset ($_GET['mensajeEditar'])){
			$mensaje = $_GET['mensajeEditar'];

			echo "<h5 class='table'>". $mensaje . "</h2>";
		}
			?>

		<div class="mx-auto" style="max-width: 40rem;">
			<div class="card text-white bg-primary mb-3">

				<form name="editarviaje" method="post" action="php/editarviaje.php" enctype="multipart/form-data">
					<div class="card-header">
						<h2 >Editar Viaje</h2>
					</div>

					<div class="card-body">
						<p > Numero de viaje </p>
						<input type="hidden" class="form-control" aria-describedby="emailHelp"  name="viaje"   value=<?php  echo $idviaje ?> ></input>
						<input type="number"  name="nro_viaje"  placeholder="Numero de viaje" size=50 autofocus   value=<?php echo $datos['nro_viaje']; ?> ></input><br><br>           
						<p> Imprevisto </p>
						<input type="text"  name="imprevisto"  placeholder="imprevisto" size=50 autofocus   value=<?php echo $datos['imprevisto']; ?> ></input><br><br>    
						<p> Precio del viaje </p>
						<input type="number"  name="precio"  placeholder="Precio viaje" size=50 autofocus    value=<?php echo $datos['precio']; ?> ></input><br><br>    
						<p> Fecha de salida </p>
						<input type="date"  name="fecha"  placeholder="Fecha de salida" size=50 autofocus   value=<?php echo $datos['fecha']; ?>  ></input><br><br>    
						
						<p> Estado del viaje </p>
						<input type="text"  name="estado"  placeholder="Estado del viaje" size=50 autofocus   value=<?php echo $datos['estado']; ?>  ></input><br><br>    
						<p> Email del conductor </p>
						<input type="text"  name="email"  placeholder="Chofer email" size=50 autofocus   value=<?php echo $chofer['email']; ?> ></input><br><br>    
						<p> Descripcion de ruta </p>
						<input type="text"  name="descripcion"  placeholder="Descripcion ruta" size=50 autofocus   value=<?php echo $ruta['descripcion']; ?> ></input><br><br>
						<input type="button" value="Editar" class="btn_editar" onclick = "validacionesviaje()">
					</div>
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