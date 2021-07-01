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
		$idv=$_POST['idv'];
		$exito=false;
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$today = date("Y-m-d");
        $time=$a=date("h:i:sa");
		
        
        $query1="SELECT * FROM viajes v  WHERE idv='$idv'";
        $result1= mysqli_query ($link, $query1) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
        $viaje= mysqli_fetch_array($result1);

       
            $exito=true;
            $query10="UPDATE viajes SET estado='finalizado' WHERE idv='$idv'";
            $result10= mysqli_query($link, $query10) or die('Consulta 10 fallida ' .mysqli_error($link));
       
            
            
 ?>


	<div class="text-center">
			
		<br> <br>
		<?php 
		if ((isset($exito)) and (($exito==true))){
		?>
		Viaje finalizado exitosamente <br><br>
		<a href="../viaje.php?idv=<?php echo $idv;?>"> Click aqui para volver al viaje   &nbsp;&nbsp;&nbsp; </a>
		<?php
		} else {?>
            No se pudo finalizar el viaje correctamente
        <?php }?>
	</div>
</body>
</html>