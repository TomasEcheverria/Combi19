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

       if(($viaje['fecha'] <= $today) and ($viaje['hora'] <= $time)) {
            $exito=true;
            $query10="UPDATE viajes SET estado='en curso' WHERE idv='$idv'";
            $result10= mysqli_query($link, $query10) or die('Consulta 10 fallida ' .mysqli_error($link));
       }
            
            
 ?>


	<div class="text-center">
			
		<br> <br>
		<?php 
		if ((isset($exito)) and (($exito==true))){
		?>
		Viaje iniciado exitosamente <br><br>
		<a href="../viaje.php?idv=<?php echo $idv;?>"> Click aqui para volver al viaje   &nbsp;&nbsp;&nbsp; </a>
		<?php
		} else {
            if($viaje['fecha'] >= $time){ ?>
		   Todavia no es la fecha de iniciar el viaje : <?php echo $viaje['fecha']?> <br><br>
		<a href="../viaje.php?idv=<?php echo $idv;?>"> Click aqui para volver al viaje   &nbsp;&nbsp;&nbsp; </a>
        <?php
		}else{?> 
        Todavia no es la hora para iniciar el viaje : <?php echo $viaje['hora'];?><br><br>
            <a href="../viaje.php?idv=<?php echo $idv;?>"> Click aqui para volver al viaje   &nbsp;&nbsp;&nbsp; </a>

         <?php } ?>
        <?php }?>
	</div>
</body>
</html>