<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario -> id($id);
    $usuario -> tipoUsuario($tipo)
?>
<html>
	<head>
		<title>
			Combi 19
		</title>
		
		<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" >
		<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" > 
		<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
		<script  src= "js/menu.js"></script>
	</head>
	 <?php 
    try {
    	$usuario -> administrador($tipo);
 
 
  ?>
	<body>
		
		<div class="div_body" >

		<a class="btn btn-outline-primary" href="administracion.php">Volver</a>

      	<?php echo menu($tipo); ?>

 
		<div class ="text-center"><img src="css/images/logo_is.png" style="max-width: 15rem;"></div>	

		<div class="div_resultados">
		     <?php
			    $consulta="SELECT *  FROM viajes WHERE activo='1' ORDER BY fecha DESC";
			    $resultado = mysqli_query ($link, $consulta) or die ('Consulta query fallida: ' .mysqli_error($link));
				$result=mysqli_num_rows($resultado); ?>
				 <h3>
				 	<p><?php echo$result;?> Resultados encontrados.</p>
				 </h3>
				

				<table class="table table-striped">
					<thead class="table-dark">
            			<tr>
              				<th scope="col">Numero de viaje</th>
              				<th scope="col">asientos disponibles:</th>
              				<th scope="col">Tipo de combi:</th>
              				<th scope="col">Mail conductor:</th>
              				<th scope="col">Origen:</th>
							<th scope="col">Destino:</th>
							<th scope="col">Fecha:</th>
							<th scope="col">Hora:</th>
							<th scope="col">Precio:</th>
							<th scope="col">Estado:</th>	
							<th scope="col">Acciones:</th>	  
           		 		</tr>
        			</thead>
					<tbody>
				<?php
				
				
				
			    if($result>0){
			    	while ($viajes=mysqli_fetch_array ($resultado))
                       
                      
			    		{ ?>
						<?php   
                        $idv=$viajes['idv'];
                        $nro_viaje=$viajes['nro_viaje'];
				        $imprevisto=$viajes['imprevisto'];
						$fecha=$viajes['fecha'];
						$hora=$viajes['hora'];
				        $idc=$viajes['idc']; 
				        $idr=$viajes['idr'];
						$activo=$viajes['activo'];
						$precio=$viajes['precio'];
						$estado=$viajes['estado'];
        					$query51 ="SELECT * FROM usuarios WHERE id='$idc'";
        					$result51=mysqli_query ($link, $query51) or die ('Consulta query51 fallida: ' .mysqli_error($link));
       						 $chofer=(mysqli_fetch_array($result51)); 
		
       						 $query52 ="SELECT * FROM rutas WHERE idr='$idr'";
        					$result52=mysqli_query ($link, $query52) or die ('Consulta query51 fallida: ' .mysqli_error($link));
      						  $rutas=(mysqli_fetch_array($result52));
							
							
								$id= $chofer['id'];
								$query53 ="SELECT * FROM combis WHERE idu='$id'";
								$result53=mysqli_query ($link, $query53) or die ('Consulta query51 fallida: ' .mysqli_error($link));
      						  	$combi=(mysqli_fetch_array($result53));
								$asientos= $combi['cantidad_asientos'];

								//$query54="SELECT * FROM pasajes WHERE idv='$idv'";
								//$result54=mysqli_query ($link, $query54) or die ('Consulta query51 fallida: ' .mysqli_error($link));
      						  	//$pasajes=(mysqli_num_rows($result54));
									$query88="SELECT SUM(cantidad_asientos) FROM pasajes  WHERE idv='$idv' AND activo='1'";
									$result88=mysqli_query ($link, $query88) or die ('Consulta query88 fallida: ' .mysqli_error($link));
									$reservados=mysqli_fetch_array($result88);							
								
								$cantidad = $asientos - $reservados['0'];
								
								$rutas['codigo_postal_destino'];

								$query58="SELECT * FROM lugares WHERE idl='$rutas[codigo_postal_origen]'";
								$result58=mysqli_query ($link, $query58) or die ('Consulta query51 fallida: ' .mysqli_error($link));
      						  	$origen=(mysqli_fetch_array($result58));
								
								$query59="SELECT * FROM lugares WHERE idl='$rutas[codigo_postal_destino]'";
								$result59=mysqli_query ($link, $query59) or die ('Consulta query51 fallida: ' .mysqli_error($link));
								$destino=(mysqli_fetch_array($result59));

						if ($viajes['activo']== 1 ){	
						?>

						<tr>
							<td><?php  echo  $nro_viaje ?></td>
							<td><?php  echo  $cantidad ?></td>
							<td><?php  echo  $combi['tipo'] ?></td>
							<td><?php echo $chofer['email']; ?></td>
							<td><?php echo $origen['nombre']; ?></td>
							<td><?php echo $destino['nombre']; ?></td>
							<td><?php echo $fecha; ?></td>
							<td><?php echo $hora; ?></td>
							<td><?php echo $precio; ?></td>
							<td><?php echo $estado; ?></td>
							<td><a class="btn btn btn-outline-success" href="modificarviaje.php?idv=<?php echo $idv?>">Editar</a>
								<a class="btn btn-outline-danger ml-1" href="cancelarviaje.php?idv=<?php echo $idv?>">Borrar</a>
							</td>
						</tr>
							
			</div>	
			
    		<?php	
						}
			    	}
			    }
		      ?>
		</div>

		</tbody>
		</table>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<div class="div-foot">
			<figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
			</figcaption>
		</div>
	</body>
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

	<div class="div-foot">
		<figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
		</figcaption>
	</div>
		<?php	
	}
	?> 
</html>