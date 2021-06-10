<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario ->id($id);
    $usuario -> tipoUsuario($tipo);
    $idp=$_GET['idp'];
?>
<html>
<head>
	<title>Combi 19 </title>
	<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" > 
	<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" >
<script language="JavaScript" type="text/javascript" src ="js/validacionEditar.js"> </script>
<script  src= "js/menu.js"></script>
<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
</head>
 <?php 
    try {
    	$usuario -> iniciada($usuarioID);
        $query1="SELECT * FROM pasajes p  WHERE idp='$idp' AND fantasma='0'";
        $result1= mysqli_query ($link, $query1) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
        $pasaje= mysqli_fetch_array($result1);

        $consulta="SELECT *  FROM viajes WHERE idv=$pasaje[idv]";
        $resultado = mysqli_query ($link, $consulta) or die ('Consulta consulta fallida: ' .mysqli_error($link));
        $viaje= mysqli_fetch_array($resultado);

        if(($viaje['estado'] == "finalizado") and ($viaje['activo'] == 0)){//revisar
            $informacion="Este viaje finalizo se finalizo exitosamente y fue borrado";
            $cancelado=false;
        }else{
            if(($viaje['estado'] == "pendiente") and ($viaje['activo'] == 0)){
                $informacion="Este viaje fue cancelado";
                $cancelado=false;
            }
        }   
          ?>
  
<body style="background-color:LightGrey;" id="div_body" >
	<div class="div_body">

			<a class="btn btn-outline-primary" href="pasajes.php">Volver</a>
            <?php echo menu($tipo);?>
		<div class=div_registro>Datos del Pasaje <?php echo $pasaje['idp']; ?>
			<div class="mx-auto" style="max-width: 40rem;">
				<div class="card text-white bg-primary mb-3">  
                Estado del pasaje   :<?php  if($pasaje['activo']){ echo "activo"; }else{  echo "El pasaje fue cancelado";}?> <br>
                <?php if($pasaje['activo'] == 1){
                ?>
                    Cantidad de asientos reservados :<?php echo $pasaje['cantidad_asientos']?> <br>
                    Precio total del pasaje :<?php echo $pasaje['precio']?> <br>
                    <?php if(($viaje['estado'] != "cancelado") and ($viaje['activo'] == 1)){?>
                        <h1> Datos relacionados con el viaje </h1>
                        Numero del viaje:<?php echo $viaje['nro_viaje']; ?><br>
                        Imprevisto: <?php if($viaje['imprevisto'] == "" ){ echo "No hay ningun imprevisto";}else{ echo $viaje['imprevisto']; }?></br>
                        Precio individual por asiento <?php echo $viaje['precio'] ?><br>
                        Estado del viaje <?php echo $viaje['estado'] ?><br>
                        Fecha  de salida <?php echo $viaje['fecha'] ?><br>
                        Hora de salida <?php echo $viaje['hora'] ?><br>
                        <?php if($viaje['estado'] == "finalizado") {?>
                            Pago viaje: <?php echo $pasaje['pago']; ?> <br>
                            Marcado como sospechoso de covid : <?php if($pasaje['sospechoso_covid'] == 1){ echo "si";}else { echo "no";}?><br>
                            Realizo Comentario: <?php if($pasaje['comentario'] == 1){ echo "si";}else { echo "no";}?><br>
                        <?php $comentcondition; } ?>
                <?php } else { // el viaje no esta activo
                        if(($viaje['estado'] == "cancelado") and ($viaje['activo'] == 1)){?>
                    Este viaje fue cancelado</br>
                    Cantida de plata rembolsada: <?php echo $pasaje['precio']; ?><br>
                            <?php }else{
                                echo "Los datos de este viaje fueron borrados ";
                            }?>
                <?php }
            }else{//estos datos son si el pasaje esta desactivado ?>
            Este pasaje fue cancelado</br>
            Cantidad de plata rembolsada :<?php echo $pasaje['precio']; ?> 
           <?php }?>
				</div>
			</div>
        <?php if(($pasaje['activo'] ==1 ) and ($viaje['activo'] == 1 ) and ($viaje['estado'] == "pendiente")){?>
           <?php
            echo"Puede cancelar el pasaje,pero si lo cancela ahora solo recibira: ";
             date_default_timezone_set("America/Argentina/Buenos_Aires");
             $today = date("Y-m-d");
             $date2 = $viaje['fecha'];
             $date1_ts = strtotime($today);
             $date2_ts = strtotime($date2);
             $diff = $date2_ts - $date1_ts;
            $dias= round($diff / 86400);
            if($dias >= 2){
                echo "El total del precio del pasaje".$pasaje['precio'];
      }
             ?><br>
            <a class="btn btn-outline-danger ml-1" href="cancelarviaje.php?idv=<?php echo $idv?>">Cancelar pasaje</a>
      <?php  }
        ?>
    </div>
    <?php
      ?>  
</body>

	<div class="div-foot">
			<figcaption class="blockquote-footer">
				<cite title="Source Title">Made by : Grupo 40 </cite>
			</figcaption>
	</div>

<?php
	} catch (Exception $e){
			echo $e->getMessage();
	?>
	<div class="body">
		 <br><br>		
			<a href="pagprincipal.php" > click aqui para volver a la pagina principal </a><br><br>	
			<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Click aqui para cerrar Sesion </a>
	</div>
		<div class= "div_foot">
		<p> Made by : Grupo 40 
        </p>
	</div>
		<?php	
	}
	?> 
</html>