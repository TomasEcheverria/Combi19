<?php
  include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "classLogin.php"; 
?>
<html>
<head> 
	<title> Combi 10 </title>
	<link rel="stylesheet" type="text/css" href= " ../css/bootstrap.min.css" media="all" > 
</head>
</body> 
<?php
	//if(isset($_POST['borrar'])){ 
		$idv=$_POST['idv'];
		$total=$_POST['total'];
		$exito=false;
		$marcadas=true;
		$query50 ="SELECT * FROM viajes  WHERE idv='$idv'";
        $result50=mysqli_query ($link, $query50) or die ('Consulta query50 fallida: ' .mysqli_error($link));
        $datos=(mysqli_fetch_array($result50)); 
		for ($i = 1; $i <= $total; $i++) {
			if(!isset($_POST[$i])){
				$marcadas=false;
			}
		}
		if($marcadas){
		if($datos['estado'] == 'pendiente'){
		$query10="UPDATE viajes SET estado='cancelado' WHERE idv='$idv'";//EL ESTADO QUEDA EN CANCELADO
		$result10= mysqli_query ($link, $query10) or die ('Consulta 10 fallida ' .mysqli_error($link));
		 if($result10){
		 	 $exito=true;
		               }
		
		}
		}			
	//} 

 ?>


	<div class="text-center">
			
		<br> <br>
		<?php 
		if ((isset($exito)) and (($exito==true))){
		?>
		Viaje Borrado exitosamente <br><br>
		<a href="../listarviajes.php"> Click aqui para volver  &nbsp;&nbsp;&nbsp; </a>
		<?php
		} else { ?>
		 El viaje esta marcado como en curso <br><br>
		 <?php if (!$marcadas) {?> 
		No se marcaron todas las checkbox <?php echo $total; }?></br>
		<?php if($datos['estado'] !=  "pendiente"){ echo "Solo se podran cancelar aquellos viajes que estan en pendientes";}?>
		 <a href="../listarviajes.php"> Click aqui para volver  &nbsp;&nbsp;&nbsp; </a>
		<?php
		}
		?>
	</div>
</body>
</html>