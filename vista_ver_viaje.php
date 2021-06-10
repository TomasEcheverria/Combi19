<?php
    include 'BD.php';
    include 'php/acciones_ver_viaje.php';
    include 'php/classLogin.php';
    $usuario= new usuario();
    



	function getOrigen($idr){
        $db = conectar();
        $sql = "SELECT lo.* FROM lugares lo INNER JOIN rutas r ON (r.codigo_postal_origen=lo.idl) AND (lo.activo=1) AND (r.activo=1) AND (r.idr='$idr')";
        $result = mysqli_query($db,$sql);
        $data = $result->fetch_assoc();
        return $data;
    }

	function getDestino($idr){
        $db = conectar();
        $sql = "SELECT lo.* FROM lugares lo INNER JOIN rutas r ON (r.codigo_postal_destino=lo.idl) AND (lo.activo=1) AND (r.activo=1) AND (r.idr='$idr')";
        $result = mysqli_query($db,$sql);
        $data = $result->fetch_assoc();
        return $data;
    }

	function cantidadTablas($cons){
		$db = conectar();
        $result = mysqli_query($db,$cons);
        $numRows = $result->num_rows;
        return $numRows;
	}

	function consulta($cons){
		$db = conectar();
		$result = mysqli_query($db, $cons);
		$data = $result->fetch_assoc();
		return $data;
	}
?>
<!--Funcion para traer lugares de la BD -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de viaje</title>
        <!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" >
</head>
<?php try{ 
	$tipo_usuario = "";
	$usuario -> tipoUsuario($tipo_usuario);
	if ($tipo_usuario == ""){
		throw new Exception('Debe iniciar sesión antes de realizar esa acción.');
	}
	
    ?>
<body>

	<?php
        $origen = getOrigen($idr);
		$destino = getDestino($idr);
		$info_combi = consulta("SELECT c.cantidad_asientos, c.tipo FROM combis c INNER JOIN usuarios u ON (c.idu=u.id) AND (c.activo=1) AND (u.activo=1) AND (u.id='$idc')");
		$asientos_comprados = cantidadTablas("SELECT pos.* FROM pasajeros pos INNER JOIN pasajes pes ON (pos.idp=pes.idp) AND (pos.activo=1) AND (pes.fantasma=0) AND (pes.activo=1) AND (pes.idv='$id')");
		$asientos_disponibles = $info_combi['cantidad_asientos'] - $asientos_comprados;
		$id_usuario="";
		$usuario -> id($id_usuario);
    ?>
	
    <div class="card">
		<div class="card-header text-center">
			<?php
			echo "<h4>Viaje de  ".$origen['provincia']."-".$origen['nombre']."  a  ".$destino['provincia']."-".$destino['nombre']. "</h4>"
			?>
		</div>
		<div class="card-body">

			<blockquote class="blockquote mb-0">
				<div class="mx-auto" style="width: 40rem;">
					
					<fieldset disabled>
						<div class="mb-3">
							<label for="disabledTextInput" class="form-label">Origen:</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php  echo $origen['provincia']."-".$origen['nombre']  ?>">
						</div>
						<div class="mb-3">
							<label for="disabledTextInput" class="form-label">Destino:</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php  echo $destino['provincia']."-".$destino['nombre']  ?>">
						</div>
						<div class="mb-3">
							<label for="disabledTextInput" class="form-label">Fecha:</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php  echo $fecha  ?>">
						</div>
						<div class="mb-3">
							<label for="disabledTextInput" class="form-label">Hora:</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php  echo $hora  ?>">
						</div>
						<div class="mb-3">
							<label for="disabledTextInput" class="form-label">Precio por asiento:</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php  echo "$".$precio  ?>">
						</div>
						<div class="mb-3">
							<label for="disabledTextInput" class="form-label">Tipo de Combi:</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php  echo $info_combi['tipo']  ?>">
						</div>
					</fieldset>
						

					<form action ="php/acciones_ver_viaje.php" method ="POST">		              
							
								<?php if (!(isset($_GET['p']))){
									echo "<div class='col-12'> <a class='btn btn-outline-primary' href='vista_busqueda.php'>Volver</a> <a class='btn btn-info' href='vista_ver_viaje.php?ver=$id&p=1'>Comprar Pasaje</a>";
									}else{
										
										
										if ($asientos_disponibles>0){
								?>
									<h4> Asientos disponibles: </h4> <p> <?php echo $info_combi['cantidad_asientos'] - $asientos_comprados ?> </p>
									<input type="hidden" name="id" value="<?php echo $id ?>">
									<input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
									<input type="checkbox" name="cantidad_asientos" value=0 checked onclick="var input = document.getElementById('cantidad_asientos'); if(this.checked){ input.disabled = true; input.focus();}else{input.disabled=false;}" />Comprar para mí. <br> <br> Comprar para mí y otras personas:
									<input type="number" name="cantidad_asientos" value="" min=1 max=<?php echo $asientos_disponibles ?> id="cantidad_asientos"  disabled="disabled" required="" placeholder=""/>
									<br> <br> <br>
									
									<div class='col-12'> <a class='btn btn-outline-primary' href='vista_busqueda.php'>Volver</a> <button type='submit' name='submit' class='btn btn-info'>Siguiente</button> </div>
									
								<?php }else {
									echo "Lo sentimos. No hay más asientos disponibles disponibles.";
									echo "<br><br> <a class='btn btn-outline-primary' href='vista_busqueda.php'>Volver</a>";
									}
						 		} ?>      
							
					</form>    
				</div>	  
			</blockquote>	
    </div>


    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
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