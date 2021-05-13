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
		<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
		<script  src= "js/menu.js"></script>
	</head>
	 <?php 
    try {
    	$usuario -> administrador($tipo);
 
 
  ?>
	<body class = "body"  id="div_body">
		<div class="div_body" >
                	<div class="div_superior"  >
					 <a class = "div_superior" href="pagprincipal.php" >  
				<p> Combi 19 <img src="css/images/muro.jpg" class="div_icono">	
				</a></p>
			</div>
      <?php echo menu($tipo); ?>
		<div class="div_resultados">
		     <?php
			    $consulta="SELECT *  FROM viajes WHERE activo='1'";
			    $resultado = mysqli_query ($link, $consulta) or die ('Consulta query fallida: ' .mysqli_error($link));
				$result=mysqli_num_rows($resultado); ?>
				 <h3>
				 	<p><?php echo$result;?> Resultados encontrados.</p>
				 </h3>
				
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

								$query54="SELECT * FROM pasajes WHERE idv='$idv'";
								$result54=mysqli_query ($link, $query54) or die ('Consulta query51 fallida: ' .mysqli_error($link));
      						  	$pasajes=(mysqli_num_rows($result54));

								$cantidad = $asientos - $pasajes;
								echo ($rutas['codigo_postal_destino']);

								$query58="SELECT * FROM lugares WHERE idl='$rutas[codigo_postal_origen]'";
								$result58=mysqli_query ($link, $query58) or die ('Consulta query51 fallida: ' .mysqli_error($link));
      						  	$origen=(mysqli_fetch_array($result58));
								
								$query59="SELECT * FROM lugares WHERE idl='$rutas[codigo_postal_destino]'";
								$result59=mysqli_query ($link, $query59) or die ('Consulta query51 fallida: ' .mysqli_error($link));
								$destino=(mysqli_fetch_array($result59));

						if(($chofer['activo'] == 1) and ($rutas['activo']  == 1 ) and ($viajes['activo']== 1 )){	
						?>
			<div class="div_usuario">
				<div class="div_btn_usuario">
                    <a href="modificarviaje.php?idv=<?php echo $idv?>">
                      Modificar viaje
                    </a>
                    <br>
					<form  action="php/bajaviaje.php" method="post">    
				                  <button name="borrar" class="btn_borarr_mensaje" onclick="return SubmitForm(this.form)" value="Eliminar">Borrar Viaje</button>
				                  <input type="hidden" name="idv" value="<?php echo $idv; ?>" />
				     </form>
				</div>
				<div class="div_info_usuario" >
						<a class="div_info_usuario" href="">
						<p>Numero de viaje : <?php  echo  $nro_viaje ?></p>
						<p> asientos disponibles: <?php  echo  $cantidad ?></p>
						<p> Tipo de combi:<?php  echo  $combi['tipo'] ?></p>
						<p>Mail conductor:<?php echo $chofer['email']; ?>  </p>
						<p>Origen:<?php echo $origen['nombre']; ?>  </p>
						<p>Destino:<?php echo $destino['nombre']; ?>  </p>
						<p> Fecha: <?php echo $fecha; ?>  </p>
						<p>Hora:  <?php echo $hora; ?>  </p>
						</a>
				</div>							
			</div>	
			
    	<?php	
						}
			    	}
			    }
		      ?>
		</div>
        <div class= "div_foot">
			<p> Made by : Grupo 40 </p>
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
		<div class= "div_foot">
		<p> Made by : Grupo 40 </p>
	</div>
		<?php	
	}
	?> 
</html>