<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario -> id($id);
	$usuario -> tipoUsuario($tipo);
    $idv = $_GET['idv'];
?>
<head>
		<title>
			Combi 19 
		</title>
		<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" >
		<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" > 
		<script  src= "js/menu.js"></script>
		<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
		<script language="JavaScript" type="text/javascript" src ="js/validacionEditar.js"> </script>
	</head>
    

    <?php 
    try {
    	$usuario -> administrador($tipo);
 
 
  ?>
	<body class = "body"  id="div_body">
		<div class="div_body" >
                	<div class="div_superior"  >
					 <a class = "div_superior" href="pagprincipal.php" >  
				<img src="css/images/logo_is.png" class="div_icono">	
				</a>
			</div>
      <?php echo menu($tipo);?>
		<div class="div_resultados">
		     <?php
		    
			    $consulta="SELECT *  FROM pasajes WHERE idv='$idv' AND fantasma='0' AND activo='1'";
			    $resultado = mysqli_query ($link, $consulta) or die ('Consulta query fallida: ' .mysqli_error($link));
				$result=mysqli_num_rows($resultado); ?>
				<h3> <p> Cancelacion del viaje:<?php echo $idv?> </p></h3>
				 <h3>
				 	<p><?php echo$result;?> Pasajes para este viaje.</p>
				 </h3>
				
				<?php
				
			    if($result>0){ 
					$cantidad=0?>
				<form name="cancelarviaje"  id="cancelarviaje" method="post" action="php/bajaviaje.php" enctype="multipart/form-data">
					<input type="hidden" class="form-control"  name="idv"   value=<?php  echo $idv ?> ></input>
					<input type="hidden" class="form-control"  name="total"   value=<?php  echo $result; ?> ></input>
				<?php	while ($pasaje=mysqli_fetch_array($resultado)) 
				      { 
					$cantidad=$cantidad+1;	?>

			<div class="div_usuario">
				<?php
                     
                $query51 ="SELECT * FROM usuarios WHERE id='$pasaje[idu]'";
                $result51=mysqli_query($link, $query51) or die('Consulta query51 fallida: ' .mysqli_error($link));
                $usuario=(mysqli_fetch_array($result51));
                
                        $asientos=$pasaje['cantidad_asientos'];
                        $precio=$pasaje['precio'];
                        $email= $usuario['email'];  ?>
						
				<div class="div_info_usuario" >
						
						<p>Nombre de pasajero: <?php  echo $email; ?></p>
						<p>Cantidad de asientos:<?php echo $asientos; ?></P>
						<p>Precio total del pasaje:<?php echo $precio;?></br>
						<label> <input type="checkbox" class="ces"id='c' name="<?php echo $cantidad; ?>"> Rembolsar este pasaje </label> </br>
						
				</div>							
			</div>	
			
    	<?php
                    }?>
			<input type="button" value="Cancelar viaje" name="borrar" class="btn_editar" onclick="toggle()">
			   </form>
		<?php } ?>
		</div>
        <figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
		</figcaption>
	</body>
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