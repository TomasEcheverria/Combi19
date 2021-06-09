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
	if(isset ($_POST['idc'])){
		$idcnuevo= $_POST['idc'];
		$idv= $_POST['viaje'];
		$viejo= $_POST['combi'];
		
		$query2 ="SELECT * FROM viajes v INNER JOIN combis c ON(v.idc=c.idu) WHERE idv='$idv'";//obtengo los datos del viaje y de la combi vieja
        $result2=mysqli_query ($link, $query2) or die ('Consulta query2 fallida: ' .mysqli_error($link));
        $datos=(mysqli_fetch_array($result2)); 
		
		$query3 ="SELECT * FROM combis  WHERE idc='$viejo'";//datos de la combi vieja 
        $result3=mysqli_query ($link, $query3) or die ('Consulta query3 fallida: ' .mysqli_error($link));
        $cvieja=(mysqli_fetch_array($result3)); 
		
		$query4 ="SELECT * FROM combis  WHERE idc='$idcnuevo'";//datos de la combi nueva
        $result4=mysqli_query ($link, $query4) or die ('Consulta query4 fallida: ' .mysqli_error($link));
        $cnueva=(mysqli_fetch_array($result4)); 
		
		$choferactual= $cnueva['idu'];

        $query55 ="SELECT * FROM usuarios WHERE id='$cnueva[idu]' AND activo='1' AND tipo_usuario='chofer'";
        $result55=mysqli_query ($link, $query55) or die ('Consulta query55 fallida: ' .mysqli_error($link));
        $chofer=(mysqli_fetch_array($result55));
		$row=mysqli_num_rows($result55);
		if($row == 0){
			$mensaje1 = 'La combi seleccionada no posee ningun chofer disponible asignado.';
			$full = false;
		}
		
		if($datos['estado'] == "en curso"){
			$mensaje2= 'El viaje se encuentra  en curso, ya es muy tarde para modificar la combi.';
			$full = false;
		}
		if($datos['estado'] == "finalizado"){
			$mensaje2= 'El viaje se encuentra  finalizado, ya es muy tarde para modificar la combi.';
			$full = false;
		}

		if(($cvieja['tipo'] == "Super Comoda") and ($cnueva['tipo'] == "Comoda")){
			$mensaje3='No se puede donwgradear el tipo de combi, seleccione una combi con el mismo o mejor tipo.';
			$full=false;
		}
		
		$query88="SELECT SUM(cantidad_asientos) FROM pasajes  WHERE idv='$idv' AND activo='1' AND fantasma='0'";
		$result88=mysqli_query ($link, $query88) or die ('Consulta query88 fallida: ' .mysqli_error($link));
		$reservados=mysqli_fetch_array($result88);

		if(($cnueva['cantidad_asientos'] - $reservados['0']) < 0){
			$mensaje3='La nueva combi tiene menos asientos que pasajes reservados para este viaje, la cantidad de asientos reservados es:'.$reservados['0'];
			$full=false;
		}
		if($cvieja['idc'] == $cnueva['idc']){
			$mensaje1='Se esta seleccionanado la combi ya asignada, selected indica la combi actual';
			$full=false;
		}else{
            $fecha= $datos['fecha'];
        
            $query89="SELECT * FROM viajes WHERE idc='$cnueva[idu]' AND activo='1'";
            $result89=mysqli_query($link, $query89) or die('Consulta 89 fallida ' .mysqli_error($link));
            while ($fechaviajes= mysqli_fetch_array($result89)) {
                if ($fecha == $fechaviajes['fecha']) {
                    $full= false;
                    $mensaje2="El conductor asignado a esta combi ya esta reservado en la fecha indicada,seleccione una fecha distinta a:".$fecha.".";
                }
            }
        }
			if($full){
			$query72= ("UPDATE viajes SET idc='$cnueva[idu]' WHERE idv='$idv'");
			$result72= mysqli_query ($link, $query72) or die ('Consuluta query72 fallida: ' .mysqli_error($link));
			$mensaje1= "El viaje  se ha editado correctamente";
			$error=false;
			}else{
				$mensajeEditar = $mensaje1 . $mensaje2 . $mensaje3;
	header ("Location: ../modificarviaje.php?idv=$idv&mensajeEditar=$mensajeEditar&error=$error");
			}
		     
	}else{
	$mensaje1="Por favor, no deje ningun campo en blanco";
	$mensajeEditar = $mensaje1 . $mensaje2 . $mensaje3;
	header ("Location: ../modificarviaje.php?idv=$idv&mensajeEditar=$mensajeEditar&error=$error");}
	
	$mensajeEditar = $mensaje1 . $mensaje2 . $mensaje3 ;//este solo se ejecuta si todo es correcto y se actualiza
	header ("Location: ../modificarviaje.php?idv=$idv&mensajeEditar=$mensajeEditar&error=$error");