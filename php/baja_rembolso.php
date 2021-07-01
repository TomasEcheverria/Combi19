<?php
  include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "classLogin.php"; 
	$usuario= new usuario();
	$usuario ->id($id);
?>
<html>
<head> 
	<title> Combi 10 </title>
	<link rel="stylesheet" type="text/css" href= " ../css/bootstrap.min.css" media="all" > 
</head>
</body> 
<?php
		$idr=$_POST['idr'];
		$exito=false;
       

       
            $exito=true;
            $query10="UPDATE rembolso SET activo='0' WHERE idrem='$idr'";
            $result10= mysqli_query($link, $query10) or die('Consulta 10 fallida ' .mysqli_error($link));
       
            
            
 ?>


	<div class="text-center">
			
		<br> <br>
		<?php 
		if ((isset($exito)) and (($exito==true))){
		?>
		Plata rembolsada exitosamente<br><br>
		<a href="../rembolsos.php?"> Click aqui para volver al viaje   &nbsp;&nbsp;&nbsp; </a>
		<?php
		} else {?>
            No se pudo rembolsarla plata correctamente
        <?php }?>
	</div>
</body>
</html>