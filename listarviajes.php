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

			<div class="div_usuario">
				<?php   
                        $idv=$viajes['idv'];
                        $nro_viaje=$viajes['nro_viaje'];
				         $imprevisto=$viajes['imprevisto'];
				         $idc=$viajes['idc']; 
				         $idr=$viajes['idr'];?>
				<div class="div_btn_usuario">
                    <a href="modificarviaje.php?idv=<?php echo $idv?>">
                      Modificar viaje
                    </a>
                    <br>
                    <a> </a><!-- acordarse de poner el borrar pagina como formulario, fijarse con el boton de eliminar mensaje y su forma-->
				</div>
				<div class="div_info_usuario" >
						<a class="div_info_usuario" href="usuario.php?idu=<?php echo$idBusqueda?>">
						<p>Numero de viaje : <?php  echo  $nro_viaje ?></p>
						<p>id conductor:<?php echo $idc ?> id ruta: <?php echo $idr ?>  ID:<?php echo $idv ?> </p>
						</a>
				</div>							
			</div>	
			
    	<?php	
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