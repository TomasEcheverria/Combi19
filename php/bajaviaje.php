<?php
  include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "classLogin.php"; 
	if(isset($_POST['borrar'])){
		$id=$_POST['id'];
		$query10="DELETE FROM me_gusta WHERE mensaje_id='$id'";
		$result10= mysqli_query ($link, $query10) or die ('Consulta 10 fallida ' .mysqli_error($link));
		 $consulta1="DELETE FROM mensaje WHERE id='$_POST[id]'";
		 $resultado1 = mysqli_query ($link, $consulta1) or die ('Consulta 1 query fallida: ' .mysqli_error($link));
		 if($resultado1){
		 	 $exito=true;
		               }
	} 
 ?>
<html>
<head> 
	<title> Mensajes </title>
	<link rel="stylesheet" type="text/css" href= " ../css/Estilos.css" media="all" > 
</head>
<body class = "body" >
	<div class="div_body">
			<div class="div_superior" >
				<p> The Wall <img src="../css/images/muro.jpg" class="div_icono">
				</p>
			</div>
	<br> <br>
	<?php 
	if ((isset($exito)) and (($exito==true))){
	?>
	Mensaje Borrado <br><br>
	<a href="../pagprincipal.php"> Click aqui para volver  &nbsp;&nbsp;&nbsp; </a>
	<?php
	} 
	?>
	</div>
</body>
</html>