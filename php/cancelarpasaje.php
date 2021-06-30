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
		$idp=$_POST['idp'];
		$exito=false;
		$price=$_POST['precio'];
		date_default_timezone_set("America/Argentina/Buenos_Aires");
		$today = date("Y-m-d");
		
        
        $query1="SELECT * FROM pasajes p  WHERE idp='$idp'";
        $result1= mysqli_query ($link, $query1) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
        $pasaje= mysqli_fetch_array($result1);

		$consulta="SELECT *  FROM viajes WHERE idv=$pasaje[idv]";
        $resultado = mysqli_query ($link, $consulta) or die ('Consulta consulta fallida: ' .mysqli_error($link));
        $viaje= mysqli_fetch_array($resultado);

        if(($pasaje['activo'] == 0 ) or ($viaje['estado'] != "pendiente")){
            $exito=false;
        }else{
            $query10="UPDATE pasajes SET activo='0', precio='$price' WHERE idp='$idp'";//Desactivo pasaje
            $result10= mysqli_query($link, $query10) or die('Consulta 10 fallida ' .mysqli_error($link));
           
            $query11="UPDATE pasajeros SET activo='0' WHERE idp='$idp'";//Desactivo pasajeros
            $result11= mysqli_query($link, $query11) or die('Consulta 11 fallida ' .mysqli_error($link));
           
            $query12="UPDATE insumos_usuarios_viajes SET activo='0' WHERE idp='$idp'";//Desactivo insumos comprados
            $result12= mysqli_query($link, $query12) or die('Consulta 12 fallida ' .mysqli_error($link));
            
			
			$query13= "INSERT INTO rembolso (precio, tarjeta, fecha) values ('$price', '$pasaje[tarjeta]', '$today')";
			$result13= mysqli_query ($link, $query13) or die ('Consuluta query13 fallida: ' .mysqli_error($link) );
			$exito= true;
			if ($result13) {
                $exito=true;
            }
        }
            
            
 ?>


	<div class="text-center">
			
		<br> <br>
		<?php 
		if ((isset($exito)) and (($exito==true))){
		?>
		Pasaje cancelado exitosamente <br><br>
		<a href="../pasajes.php"> Click aqui para volver  &nbsp;&nbsp;&nbsp; </a>
		<?php
		} else { ?>
		 El viaje debe de tener un estado pendiente, y el pasaje activo para que este se pueda eliminar <?php echo $idp;?><br><br>
		<?php
		}
		?>
	</div>
</body>
</html>