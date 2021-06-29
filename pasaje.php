<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario ->id($id);
    $usuario -> tipoUsuario($tipo);
    $usuario ->email($email);
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
<script type="text/javascript" src="js/validacionMensaje.js"></script>
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

        $query2="SELECT * FROM pasajeros p  WHERE idp='$idp'";
        $result2= mysqli_query ($link, $query2) or die ('Consuluta query2 fallida: ' .mysqli_error($link));
        $cantidadpasajeros= mysqli_num_rows($result2);
        
        $query3="SELECT * FROM insumos_usuarios_viajes v INNER JOIN insumos i ON (v.idi=i.idi) WHERE idp='$idp'";
        $result3= mysqli_query ($link, $query3) or die ('Consuluta query3 fallida: ' .mysqli_error($link));
        $cantidadinsumos= mysqli_num_rows($result3);

        $query10="SELECT * FROM rutas  r  WHERE idr='$viaje[idr]'";
        $result10= mysqli_query ($link, $query10) or die ('Consuluta query10 fallida: ' .mysqli_error($link));
        $ruta= mysqli_fetch_array($result10);

        $query11="SELECT * FROM lugares WHERE idl='$ruta[codigo_postal_origen]'";
        $result11= mysqli_query ($link, $query11) or die ('Consuluta query11 fallida: ' .mysqli_error($link));
        $origen= mysqli_fetch_array($result11);

        $query12="SELECT * FROM lugares WHERE idl='$ruta[codigo_postal_destino]'";
        $result12= mysqli_query ($link, $query12) or die ('Consuluta query12 fallida: ' .mysqli_error($link));
        $destino= mysqli_fetch_array($result12);

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
                <?php if($pasaje['activo'] == 1){//pasaje activo
                ?>
                    Cantidad de asientos reservados :<?php echo $pasaje['cantidad_asientos']?> <br>
                    Precio total del pasaje :<?php echo "$".$pasaje['precio'];?> <br>
                    <?php if(($viaje['estado'] != "cancelado") and ($viaje['activo'] == 1)){ // el viaje no cancelado y activo ?>
                        <h1> Datos relacionados con el viaje </h1>
                        Numero del viaje:<?php echo $viaje['nro_viaje']; ?><br>
                        Imprevisto: <?php if($viaje['imprevisto'] == "" ){ echo "No hay ningun imprevisto";}else{ echo $viaje['imprevisto']; }?></br>
                        Precio individual por asiento <?php echo "$".$viaje['precio']; ?><br>
                        Estado del viaje <?php echo $viaje['estado'] ?><br>
                        Fecha  de salida <?php echo $viaje['fecha'] ?><br>
                        Hora de salida <?php echo $viaje['hora'] ?><br>
                        Lugar de salida <?php echo $origen['nombre']."/".$origen['provincia']; ?> <br>
                        Lugar de llegada <?php echo $destino['nombre']."/".$destino['provincia']; ?> <br>
                        Cantidad de pasajeros asociados a este viaje:<?php echo$cantidadpasajeros; ?><br>
                        Informacion de los pasajeros:<br>
                        <?php while($pasajero= mysqli_fetch_array($result2)){
                            echo "Nombre:".$pasajero['nombre']."Apellido:".$pasajero['apellido']."DNI:".$pasajero['dni']. "|" ;?><br>
                            <?php }?>
                        Informacion de los insumos :<br>
                        <?php while($insumo= mysqli_fetch_array($result3)){
                            echo $insumo['nombre'].": ".$insumo['cantidad']; ?><br>
                            <?php }?>
                        <?php if($viaje['estado'] == "finalizado") {//viaje finalizado?>
                            Pago viaje:<?php if($pasaje['pago'] == 1){ echo "si";}else { echo "no";}?><br>
                            Marcado como sospechoso de covid : <?php if($pasaje['sospechoso_covid'] == 1){ echo "si, a causa de esto se rembolso la totalidad del precio del pasaje";}else { echo "no";}?><br>
                            Realizo Comentario: <?php if($pasaje['comentario'] == 1){ echo "si";}else { echo "no";}?><br>
                        <?php $comentcondition; } ?>
                <?php } else { 
                        if(($viaje['estado'] == "cancelado") and ($viaje['activo'] == 1)){//viaje cancelado pero activo?>
                    Este viaje fue cancelado</br>
                    Cantida de plata rembolsada: <?php echo "$".$pasaje['precio']; ?><br>
                            <?php }else{
                                echo "Los datos de este viaje fueron borrados ";
                            }?>
                <?php }
            }else{//estos datos son si el pasaje esta desactivado ?>
            Este pasaje fue cancelado</br>
            Cantidad de plata rembolsada :<?php echo "$".$pasaje['precio']; ?> 
           <?php }?>
				</div>
            <?php if(($pasaje['activo'] == 1 )  and ($viaje['estado'] == "finalizado") and ($viaje['activo'] == 1) and ($pasaje['sospechoso_covid'] == 0) ){  //seccion de comentarios?>
                <?php if($pasaje['comentario'] == 0 ){?>
                        Usted no ha realizado un comentario.
                        <div class="escribir">		
		            <form   name="mensaje" action="php/publicarmensaje.php" method="post" enctype="multipart/form-data">	
			             <textarea  name="publicacion" placeholder="Texto del mensaje" cols="50" rows="10" maxlength="140"></textarea>
                         <input type="hidden" name="idv" value="<?php echo $viaje['idv'] ?>">
                         <input type="hidden" name="idp" value="<?php echo $pasaje['idp'] ?>">
                         <input type="button"  value="publicar" class="btn_buscar" onclick="validacion()"></button><br>
		         </div>
		             </form> 
              <?php  }else{
                $query4="SELECT * FROM comentarios WHERE activo='1' AND email='$email' AND idv='$viaje[idv]'";
                $result4= $result3= mysqli_query ($link, $query4) or die ('Consuluta query4 fallida: ' .mysqli_error($link));
                $comentario= mysqli_fetch_array($result4);
                ?>
                <div class ="container-fluid">
			<div class="card text-white bg-primary mb-3">
				<div class="card-header"><?php echo 'Fecha: '.$comentario['fecha_y_hora'].' Usuario:'.$comentario['email'];?></div>
				<div class="card-body">
					<h4 class="card-title"> <?php echo $comentario['texto_comentario'];?></h4>
					<p class="card-text"> 
				</div>
			</div>				
		</div>
			</div>
            <form name="borrarcomentario" method="post" action="php/borrarcomentario.php" enctype="multipart/form-data">
                 <input type="hidden" class="form-control"  name="idp"   value=<?php  echo $pasaje['idp'] ?> ></input>
                 <input type="hidden" class="form-control"  name="idcom"   value=<?php  echo $comentario['idcom'] ?> ></input>
                <input type="submit" value="Borrar comentario" class="btn btn-outline-danger ml-1" >
                    
            </form>


            <div class="escribir">
                    Complete y envie este formulario solo si desea de modificar el contenido del comentario existente
		            <form   name="mensaje" action="php/editarcomentario.php" method="post" enctype="multipart/form-data">	
                    <input type="hidden" class="form-control"  name="idcom"   value=<?php  echo $comentario['idcom'] ?> ></input>
                         <textarea  name="publicacion" placeholder="Escribir Mensaje" cols="50" rows="10" maxlength="140"></textarea>
                         <input type="button"  value="publicar" class="btn_buscar" onclick="validacion()"></button>
		         </div>
		             </form>
            <?php }?>
            <?php }?>
        <?php if(($pasaje['activo'] ==1 ) and ($viaje['activo'] == 1 ) and ($viaje['estado'] == "pendiente")){ //seccion de cancelacion ?>
           <?php
            echo"Puede cancelar el pasaje,pero si lo cancela ahora solo recibira: ";
             date_default_timezone_set("America/Argentina/Buenos_Aires");
             $today = date("Y-m-d");
             $date2 = $viaje['fecha'];
             $date1_ts = strtotime($today);
             $date2_ts = strtotime($date2);
             $diff = $date2_ts - $date1_ts;
            $dias= round($diff / 86400);
            $mitad= $pasaje['precio']/2;
            $price;
            if($dias >= 2){
                echo "El total del precio del pasaje:$".$pasaje['precio'];
                $price=$pasaje['precio'];
            }else{
                    echo "La mitad del precio del pasaje:$".$mitad;
                    $price=$mitad;
            }
             ?><br>
             <form name="cancelarpasaje" method="post" action="php/cancelarpasaje.php" enctype="multipart/form-data">
             <input type="hidden" class="form-control"  name="precio"   value=<?php  echo $price ?> ></input>
                 <input type="hidden" class="form-control"  name="idp"   value=<?php  echo $idp ?> ></input>
                <input type="submit" value="Cancelar Pasaje" class="btn btn-outline-danger ml-1" >
             </form>
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