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
        $imprevisto = $_POST['imprevisto'];
		$idv = $_POST['viaje'];

        $query55 ="SELECT id FROM usuarios WHERE email='$_POST[email]'";
        $result55=mysqli_query ($link, $query55) or die ('Consulta query55 fallida: ' .mysqli_error($link));
        $chofer=(mysqli_fetch_array($result55));
		$row=mysqli_num_rows($result55);
		if(($row == 0) or (!$chofer['activo'])){
			$mensaje2 = 'no se encontro a un chofer con el email especificado';
			$full = false;
		}


        $query56 ="SELECT idr FROM rutas WHERE codigo_ruta='$_POST[codigo]'";
        $result56=mysqli_query ($link, $query56) or die ('Consulta query56 fallida: ' .mysqli_error($link));
        $ruta=(mysqli_fetch_array($result56)); 
		$row=mysqli_num_rows($result56);
		if(($row == 0) or (!$ruta['activo'])){
			$mensaje2 = 'no se encontro a ninguna ruta con el mail especificado';
			$full = false;
		}

		$email= $_POST['email'];
		$codigo = $_POST['codigo'];	
			if($full){
			$query72= ("UPDATE viajes SET nro_viaje='$nro_viaje', imprevisto='$imprevisto', idc='$chofer[id]', idr='$ruta[idr]' WHERE idv='$_POST[viaje]'");
			$result72= (mysqli_query ($link, $query72) or die ('Consuluta query72 fallida: ' .mysqli_error($link)));
			$mensaje1= "El usuario  se ha editado correctamente";
			$error=false;
			}else{
				$mensajeEditar = $mensaje1 . $mensaje2 . $mensaje3;
	header ("Location: ../modificarviaje.php?idv=$idv&mensajeEditar=$mensajeEditar&error=$error");
			}
		     
	}else{
	$mensaje1="Por favor, no deje ningun campo en blanco (el imprevisto es opcional).";
	$mensajeEditar = $mensaje1 . $mensaje2 . $mensaje3;
	header ("Location: ../modificarviaje.php?idv=$idv&mensajeEditar=$mensajeEditar&error=$error");}
	
	$mensajeEditar = $mensaje1 . $mensaje2 . $mensaje3 ;
	header ("Location: ../modificarviaje.php?idv=$idv&mensajeEditar=$mensajeEditar&error=$error");