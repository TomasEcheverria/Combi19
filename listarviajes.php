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
				        $idc=$viajes['idc']; 
				        $idr=$viajes['idr'];
						$activo=$viajes['activo'];
							
        					$query51 ="SELECT * FROM usuarios WHERE id='$idc'";
        					$result51=mysqli_query ($link, $query51) or die ('Consulta query51 fallida: ' .mysqli_error($link));
       						 $chofer=(mysqli_fetch_array($result51)); 
		
       						 $query52 ="SELECT * FROM rutas WHERE idr='$idr'";
        					$result52=mysqli_query ($link, $query52) or die ('Consulta query51 fallida: ' .mysqli_error($link));
      						  $ruta=(mysqli_fetch_array($result52));
						if(($chofer['activo'] == 1) and ($ruta['activo']  == 1 ) and ($viajes['activo']== 1 )){	
						?>
			<div class="div_usuario">
				<div class="div_btn_usuario">
                    <a href="modificarviaje.php?idv=<?php echo $idv?>">
                      Modificar viaje
                    </a>
                    <br>
					<form  action="php/bajaviaje.php" method="post">    
				                  <button name="borrar Viaje" class="btn_borarr_mensaje" onclick="return SubmitForm(this.form)" value="Eliminar">Borrar mensaje</button>
				                  <input type="hidden" name="idv" value="<?php echo $idv; ?>" />
				     </form>
				</div>
				<div class="div_info_usuario" >
						<a class="div_info_usuario" href="">
						<p>Numero de viaje : <?php  echo  $nro_viaje ?></p>
						<p>id conductor:<?php echo $idc ?> id ruta: <?php echo $idr ?>  ID:<?php echo $idv ?> </p>
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
           } catch (Exception $e) {
           	   $mensaje=$e->getMessage();
               header ("Location: index.php?mensaje=$mensaje");	
    }  
    ?>
</html>