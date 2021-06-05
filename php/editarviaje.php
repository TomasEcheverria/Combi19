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
	if(isset ($_POST['patente'])){
		$patente= $_POST['patente'];
		$viaje= $_POST['viaje'];
		
		$query50 ="SELECT * FROM combis  WHERE idv='$idv'";
        $result50=mysqli_query ($link, $query50) or die ('Consulta query50 fallida: ' .mysqli_error($link));
        $datos=(mysqli_fetch_array($result50)); 
		
		$choferactual= $datos['idc'];
		$fechaactual= $datos['fecha'];
		$numeroactual= $datos['nro_viaje'];

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


        $query56 ="SELECT * FROM rutas WHERE descripcion='$_POST[descripcion]'";
        $result56=mysqli_query ($link, $query56) or die ('Consulta query56 fallida: ' .mysqli_error($link));
        $ruta=(mysqli_fetch_array($result56)); 
		$row=mysqli_num_rows($result56);
		if(($row == 0) or (!$ruta['activo'])){
			$mensaje2 = 'no se encontro a ninguna ruta con la descripcion especificado';
			$full = false;
		}

		if($numeroactual != $nro_viaje){
		$query25= ("SELECT * FROM viajes WHERE activo='1'");//hacer consulta 
		$result25= mysqli_query ($link, $query25) or die ('Consulta fallida ' .mysqli_error($link));
		while ($viajetabla= mysqli_fetch_array ($result25)){
			if ($nro_viaje == $viajetabla['nro_viaje']){
				$full= false;
				$mensaje2="El numero de viaje  ya existe, por favor elija otro";
			}
		}
	}
		if(($choferactual != $chofer['id']) or ($fechaactual != $fecha)){
		$query57= ("SELECT * FROM viajes WHERE idc='$chofer[id]'");//hacer consulta 
		$result57= mysqli_query ($link, $query57) or die ('Consulta fallida ' .mysqli_error($link));
		while ($viajetabla= mysqli_fetch_array ($result57)){
			if ($fecha == $viajetabla['fecha']){
				$full= false;
				$mensaje2="El conductor especificado ya posee un viaje en la fecha indicada, por favor seleccione otro";
			}
		}
	}

	$query59 ="SELECT * FROM combis WHERE idu='$chofer[id]'";
	$result59=mysqli_query ($link, $query59) or die ('Consulta query59 fallida: ' .mysqli_error($link));
	$combi=(mysqli_fetch_array($result59)); 
	$cantidad=mysqli_num_rows($result59);
	if(($cantidad == 0) or (!$combi['activo'])){
		$mensaje2 = 'el conductor especificado no posee ninguna combi a su nombre';
		$full = false;
	}
	
			if($full){
			$query72= ("UPDATE viajes SET nro_viaje='$nro_viaje', imprevisto='$imprevisto', precio='$precio', estado='$estado', fecha='$fecha', idc='$chofer[id]', idr='$ruta[idr]' WHERE idv='$_POST[viaje]'");
			$result72= (mysqli_query ($link, $query72) or die ('Consuluta query72 fallida: ' .mysqli_error($link)));
			$mensaje1= "El viaje  se ha editado correctamente";
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