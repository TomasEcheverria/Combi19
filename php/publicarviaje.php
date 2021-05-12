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
	if((isset ($_POST['nro_viaje'])) and (isset ($_POST['email'])) and (isset ($_POST['codigo'])) ){
		$nro_viaje= $_POST['nro_viaje'];
		$fecha= $_POST['fecha'];
		$precio= $_POST['precio'];
		$email= $_POST['email'];
		$codigo = $_POST['codigo'];	

        $query55 ="SELECT * FROM usuarios WHERE email='$_POST[email]'";
        $result55=mysqli_query ($link, $query55) or die ('Consulta query55 fallida: ' .mysqli_error($link));
        $chofer=(mysqli_fetch_array($result55));
		$row=mysqli_num_rows($result55);
		if(($row == 0) or (!$chofer['activo'])){
			$mensaje2 = 'no se encontro a un chofer con el email especificado';
			$full = false;
		}
        if($chofer['tipo_usuario'] != "chofer"){
            $full=false;
            $mensaje2= 'el usuario especificado no es un conductor, seleccione un conductor';
        }


        $query56 ="SELECT * FROM rutas WHERE codigo_ruta='$_POST[codigo]'";
        $result56=mysqli_query ($link, $query56) or die ('Consulta query56 fallida: ' .mysqli_error($link));
        $ruta=(mysqli_fetch_array($result56)); 
		$row=mysqli_num_rows($result56);
		if(($row == 0) or (!$ruta['activo'])){
			$mensaje2 = 'no se encontro a ninguna ruta con el codigo especificado';
			$full = false;
		}
        
        $query25= ("SELECT nro_viaje FROM viajes");//hacer consulta 
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
				$mensaje2="El conductor especificado ya posee un viaje en la fecha indicada";
			}
		}

			if($full){
            $query31= "INSERT INTO viajes (nro_viaje, precio, estado, fecha, idc, idr) values ('$_POST[nro_codigo]', '$precio', 'pendiente', '$fecha','$chofer[id]', '$ruta[idr]')";//falta subir la imagen y su tipo
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