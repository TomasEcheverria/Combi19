<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario -> id($id);
	$usuario -> tipoUsuario($tipo);
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
		    
			    $consulta="SELECT *  FROM rembolso WHERE activo='1'";
			    $resultado = mysqli_query ($link, $consulta) or die ('Consulta query fallida: ' .mysqli_error($link));
				$result=mysqli_num_rows($resultado); ?>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
				<h3> <p>Listado de rembolsos a realizar </p></h3>
				 <h3>
				 	<p><?php echo $result;?> Rembolsos a realizar.</p>
				 </h3>
				
				<?php
				
			     
					$cantidad=0?>
				<?php	while ($rembolso=mysqli_fetch_array($resultado)) 
				      { 
					$cantidad=$cantidad+1;	?>

			<div class="div_usuario">
				<?php
                    $precio=$rembolso['precio'];
                    $tarjeta=$rembolso['tarjeta'];
                    $fecha=$rembolso['fecha'];
                        ?>
						
				<div class="div_info_usuario" >
						
						<p>Numero de rembolso:<?php  echo $rembolso['idrem']; ?></p>
						<p>Cantidad de plata a rembolsar:<?php echo $precio; ?></P>
						<p>Numero de tarjeta asociado:<?php echo $tarjeta;?></br>
						<p>Fecha del rembolso creado:<?php echo $fecha;?></br>
            <form name="baja_rembolso" method="post" action="php/baja_rembolso.php" enctype="multipart/form-data">
             <input type="hidden" class="form-control"  name="idr"   value=<?php  echo $rembolso['idrem'] ?> ></input>
             <input type="button"  name="Rembolsar " value="Rembolsar" class="btn_editar"  onclick="return SubmitForm(this.form)" value="Eliminar" >
             </form>
						
				</div>							
			</div>	
			
    	<?php
                    }?>
		
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