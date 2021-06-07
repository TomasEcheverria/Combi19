<?php
	include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "classLogin.php";
	$usuario= new usuario();
	$usuario ->id($id);
	$mensaje1='';
	$mensaje2='';
	$mensaje3='';
	$error=true;
	$full = true;
	if((isset ($_POST['nro_viaje'])) and (isset ($_POST['precio']))  and (isset ($_POST['hora'])) and  (isset ($_POST['fecha'])) and (isset ($_POST['idc'])) and (isset ($_POST['idr'])) ){
		$nro_viaje= $_POST['nro_viaje'];
		$fecha= $_POST['fecha'];
		$precio= $_POST['precio'];
		$idc= $_POST['idc'];
		$idr = $_POST['idr'];	
		$hora=$_POST['hora'];

        $query55 ="SELECT * FROM usuarios WHERE id='$idc' AND activo='1' AND tipo_usuario='chofer'";
        $result55=mysqli_query ($link, $query55) or die ('Consulta query55 fallida: ' .mysqli_error($link));
        $chofer=(mysqli_fetch_array($result55));
		$row=mysqli_num_rows($result55);
		if($row == 0) {
			$mensaje2 = 'no se encontro a un chofer con el email especificado';
			$full = false;
		}
        

        $query56 ="SELECT * FROM rutas WHERE idr='$_POST[idr]' AND activo='1'";
        $result56=mysqli_query ($link, $query56) or die ('Consulta query56 fallida: ' .mysqli_error($link));
        $ruta=(mysqli_fetch_array($result56)); 
		$row=mysqli_num_rows($result56);
		if($row == 0){
			$mensaje2 = 'no se encontro a ninguna ruta con los datos especificados';
			$full = false;
		}
		
        
        $query25= ("SELECT nro_viaje FROM viajes WHERE activo='1'");//hacer consulta 
		$result25= mysqli_query ($link, $query25) or die ('Consulta fallida ' .mysqli_error($link));
		while ($viajetabla= mysqli_fetch_array ($result25)){
			if ($nro_viaje == $viajetabla['nro_viaje']){
				$full= false;
				$mensaje2="El numero de viaje  ya existe, por favor elija otro";
			}
		}

		$query57= ("SELECT * FROM viajes WHERE idc='$chofer[id]'");//hacer consulta 
		$result57= mysqli_query ($link, $query57) or die ('Consulta fallida ' .mysqli_error($link));
		while ($viajetabla= mysqli_fetch_array ($result57)){
			if ($fecha == $viajetabla['fecha']){
				$full= false;
				$mensaje2="El conductor especificado ya posee un viaje en la fecha indicada, seleccione otra fecha que no sea:".$fecha;
			}
		}
		
		$query59 ="SELECT * FROM combis WHERE idu='$idc' AND activo='1'";
        $result59=mysqli_query ($link, $query59) or die ('Consulta query59 fallida: ' .mysqli_error($link));
        $combi=(mysqli_fetch_array($result59)); 
		$cantidad=mysqli_num_rows($result59);
		if ($cantidad == 0) {
			$mensaje2 = $_POST['idc'].'el conductor especificado no posee ninguna combi a su nombre';
			$full = false;
		}

			if($full){
            $query31= "INSERT INTO viajes (nro_viaje, precio, estado, fecha, hora, idc, idr) values ('$_POST[nro_viaje]', '$precio', 'pendiente', '$fecha', '$_POST[hora]','$idc', '$idr')";//falta subir la imagen y su tipo
            $result31= mysqli_query ($link, $query31) or die ('Consuluta query1 fallida: ' .mysqli_error($link));
			$mensaje1= "El viaje se publico correctamente";
			$error=false;
			}else{
				$mensajeEditar = $mensaje1 . $mensaje2 . $mensaje3;
	header ("Location: ../altaviaje.php?mensajeEditar=$mensajeEditar&error=$error");
			}
		     
	}else{
	$mensaje1="Por favor, no deje ningun campo en blanco (el imprevisto es opcional).";
	$mensajeEditar = $mensaje1 . $mensaje2 . $mensaje3;
	header ("Location: ../altaviaje.php?mensajeEditar=$mensajeEditar&error=$error");}
	
	$mensajeEditar = $mensaje1 . $mensaje2 . $mensaje3 ;
	header ("Location: ../altaviaje.php?mensajeEditar=$mensajeEditar&error=$error");