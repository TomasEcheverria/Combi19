<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario ->id($id);
    $usuario -> tipoUsuario($tipo);
    $idv=$_GET['idv'];
?>
<html>
<head>
	<title>Combi 19 </title>
	<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" > 
	<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" >
<script language="JavaScript" type="text/javascript" src ="js/validacionEditar.js"> </script>
<script  src= "js/menu.js"></script>
<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
<script type="text/javascript" src="js/validacionMensaje.js"></script>
</head>
 <?php 
    try {
    	$usuario -> chofer($tipo);
        $query1="SELECT * FROM viajes v  WHERE idv='$idv'";//selecciono el viaje 
        $result1= mysqli_query ($link, $query1) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
        $viaje= mysqli_fetch_array($result1);

        $query2="SELECT * FROM pasajeros p INNER JOIN pasajes pa ON (p.idp=pa.idp) WHERE pa.idv='$idv' AND p.activo=1 AND pa.activo=1";//selecciono pasajeros 
        $result2= mysqli_query ($link, $query2) or die ('Consuluta query2 fallida: ' .mysqli_error($link));
        $cantidadpasajeros= mysqli_num_rows($result2);
        
        $query10="SELECT * FROM rutas  r  WHERE idr='$viaje[idr]'";
        $result10= mysqli_query ($link, $query10) or die ('Consuluta query10 fallida: ' .mysqli_error($link));
        $ruta= mysqli_fetch_array($result10);

        $query11="SELECT * FROM lugares WHERE idl='$ruta[codigo_postal_origen]'";
        $result11= mysqli_query ($link, $query11) or die ('Consuluta query11 fallida: ' .mysqli_error($link));
        $origen= mysqli_fetch_array($result11);

        $query12="SELECT * FROM lugares WHERE idl='$ruta[codigo_postal_destino]'";
        $result12= mysqli_query ($link, $query12) or die ('Consuluta query12 fallida: ' .mysqli_error($link));
        $destino= mysqli_fetch_array($result12)  
          ?>
  
<body style="background-color:LightGrey;" id="div_body" >
	<div class="div_body">

			<a class="btn btn-outline-primary" href="mis_viajes.php">Volver</a>
            <?php echo menu($tipo);?>
		<div class=div_registro>Datos del viaje <?php echo $viaje['idv']; ?>
			<div class="mx-auto" style="max-width: 40rem;">
				<div class="card text-white bg-primary mb-3">  
                Datos del viaje :<?php  if($viaje['activo']){ echo "activo"; }else{  echo "El viaje fue eliminado";}?> <br>
              
                <?php if($viaje['activo'] == 1){//viaje activo
                ?>
                    <?php if(($viaje['estado'] != "cancelado") and ($viaje['activo'] == 1)){ // el viaje no cancelado y activo?>
                        <h1> Datos relacionados con el viaje </h1>
                        Numero del viaje:<?php echo $viaje['nro_viaje']; ?><br>
                        Imprevisto: <?php if ($viaje['imprevisto'] == "") {
                        echo "No hay ningun imprevisto";
                    } else {
                        echo $viaje['imprevisto'];
                    }?></br>
                        Precio individual por asiento <?php echo "$".$viaje['precio']; ?><br>
                        Estado del viaje <?php echo $viaje['estado'] ?><br>
                        Fecha  de salida <?php echo $viaje['fecha'] ?><br>
                        Hora de salida <?php echo $viaje['hora'] ?><br>
                        Lugar de salida <?php echo $origen['nombre']."/".$origen['provincia']; ?> <br>
                        Lugar de llegada <?php echo $destino['nombre']."/".$destino['provincia']; ?> <br>
                        Descripcion de la ruta <?php echo $ruta['descripcion']; ?>
                        Cantidad de pasajeros asociados a este viaje:<?php echo$cantidadpasajeros; ?><br>
                        Informacion de los pasajeros:<br>
                       <?php }else{ 
                           if(($viaje['estado'] == "cancelado") and ($viaje['activo'] == 1)){?>
                                Este viaje fue cancelado<br>
                                Fecha  de salida <?php echo $viaje['fecha'] ?><br>
                                Lugar de salida <?php echo $origen['nombre']."/".$origen['provincia']; ?> <br>
                                Lugar de llegada <?php echo $destino['nombre']."/".$destino['provincia']; ?> <br>
                    <?php   }?>
                <?php }
            }else{//estos datos si el viaje esta borrado ?>
                Los datos de este viaje fueron borrados
           <?php }?>
				</div>
           
        <h3>Listado de pasajeros</h3>
        <?php while($pasajero=mysqli_fetch_array($result2)){
            $idpasajero=$pasajero['idpasajero'];

        $query5="SELECT * FROM pasajeros WHERE idpasajero='$idpasajero'";
        $result5= mysqli_query ($link, $query5) or die ('Consuluta query5 fallida: ' .mysqli_error($link));
        $pasajero= mysqli_fetch_array($result5);

            ?>
            <div class="mx-auto" style="max-width: 40rem;">
		    <div class="card text-white bg-primary mb-3">
                
                Nombre y apellido del pasajero: <?php echo $pasajero['nombre']." ".$pasajero['apellido'];?><br>
                DNI:<?php echo $pasajero['dni']; ?><br>
            
            <?php if($viaje['estado'] == "pendiente"){//viaje pendiente?>
                <?php if ($pasajero['presente'] == 0) {?>
                <p>Este pasajero todavia no fue procesado. </p><br>
                <a class="div_info_usuario" href="vista_formulario.php?idpasajero=<?php echo $pasajero['idpasajero']?>"> Procesar este pasajero </a>
                <?php } else {?>
                        <p>Este passajero ya fue procesado</p><br>
                         <?php if ($pasajero['sospechoso_covid'] == 0) {echo "el pasajero no presento sintomas de covid";} else {echo "el pasajero si presento sintomas de covid";} ?><br>
                <?php }?>
            <?php }else{
                    if($viaje['estado'] == "finalizado"){//viaje finalizado 
                        if($pasajero['presente'] == 1){?>
                           <p>Este pasajero se presento</p>
                           <?php if($pasajero['sospechoso_covid'] == 1 ){ 
                               echo "Este pasjero presento sintomas de covid"; 
                               }else{ echo "Este pasajero no presento sintomas de covid"; } ?> 
                     <?php }else{
                         echo "Este pasajero no se presento";
                     } ?>
                <?php }else{ echo "Este viaje fue canceado"; }?>
            <?php }?>
            
            </div>
            </div>
        
        <?php } ?>
        <?php if(($viaje['estado'] == "pendiente") and ($viaje['activo'] == 1 )){?>
            <form name="iniciar_viaje" method="post" action="php/iniciar_viaje.php" enctype="multipart/form-data">
             <input type="hidden" class="form-control"  name="idv"   value=<?php  echo $idv ?> ></input>
             <input type="button"  name="Iniciar viaje" value="iniciar viaje" class="btn btn-outline-danger ml-1"  onclick="return SubmitForm(this.form)" value="Eliminar" >
             </form>
        <?php } ?>
        <?php if(($viaje['estado'] == "en curso") and ($viaje['activo'] == 1)){?>
            <form name="finalizar_viaje" method="post" action="php/finalizar_viaje.php" enctype="multipart/form-data">
             <input type="hidden" class="form-control"  name="idv"   value=<?php  echo $idv ?> ></input>
             <input type="button"  name="Finalizar viaje" value="Finalizar viaje" class="btn btn-outline-danger ml-1"  onclick="return SubmitForm(this.form)" value="Eliminar" >
             </form>
        <?php }?>

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