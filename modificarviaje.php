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
         $query50 ="SELECT * FROM viajes v INNER JOIN combis c ON(v.idc=c.idu)  WHERE idv='$idviaje'";
        $result50=mysqli_query ($link, $query50) or die ('Consulta query50 fallida: ' .mysqli_error($link));
        $datos=(mysqli_fetch_array($result50)); 
        $idcactual =$datos['idc'];
		//echo "combi actual".$datos['idc'];//datos de la combi
		
    
		
		
      
        if (isset ($_GET['error'])){
			$error=$_GET['error'];
		}
  ?>
<body id="div_body" >
	<div class="div_body">
		
			<a class="btn btn-outline-primary" href="listarviajes.php">Volver</a>

             <?php echo menu($tipo);?>
             <p > Modificacion del viaje: <?php echo $idviaje?> </p>
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
						
						<input type="hidden" class="form-control"  name="viaje"   value=<?php  echo $idviaje ?> ></input>   
						<input type="hidden" class="form-control"   name="combi"   value=<?php  echo $idcactual ?> ></input>
						<p> Patente de  combi </p>
						<select name="idc"> <br><br> 
							<?php $query12="SELECT * FROM combis c INNER JOIN usuarios u ON (c.idu=u.id) WHERE c.activo='1' AND u.activo='1'";
								$result12= mysqli_query ($link, $query12) or die ('Consuluta query12 fallida: ' .mysqli_error($link));
                                while ($combi = mysqli_fetch_array($result12)) {
                                    ?>   
							<option value= "<?php echo $combi['idc'] ?>">  <?php if($idcactual == $combi['idc']){ echo "selected";}?> <?php echo $combi['patente']; ?> </option>
								<?php
                                } ?>
						</select> <br><br> 						
						
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