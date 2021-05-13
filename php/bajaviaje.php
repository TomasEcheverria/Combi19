<?php
  include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "classLogin.php"; 
	if(isset($_POST['borrar'])){
		$idv=$_POST['idv'];
		$exito=false;
		$query50 ="SELECT * FROM viajes  WHERE idv='$idv'";
        $result50=mysqli_query ($link, $query50) or die ('Consulta query50 fallida: ' .mysqli_error($link));
        $datos=(mysqli_fetch_array($result50)); 

		if($datos['estado'] != 'en curso'){
		$query10="UPDATE viajes SET activo='0' WHERE idv='$idv'";
		$result10= mysqli_query ($link, $query10) or die ('Consulta 10 fallida ' .mysqli_error($link));
		 if($result10){
		 	 $exito=true;
		               }
		}
					
	} 

 ?>
<html>
<head> 
	<title> Combi 10 </title>
	<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" > 
</head>
<body>
	<div class="text-center">
			
		<br> <br>
		<?php 
		if ((isset($exito)) and (($exito==true))){
		?>
		Viaje Borrado exitosamente <br><br>
		<a href="../listarviajes.php"> Click aqui para volver  &nbsp;&nbsp;&nbsp; </a>
		<?php
		} else { ?>
		 El viaje esta marcado como pendiente<br><br>
		 <a href="../listarviajes.php"> Click aqui para volver  &nbsp;&nbsp;&nbsp; </a>
		<?php
		}
		?>
	</div>
</body>
</html>