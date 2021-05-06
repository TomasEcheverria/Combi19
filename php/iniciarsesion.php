<?php
	include "../BD.php";
	$link = conectar();
	include "classLogin.php";
	$usuario= new usuario();
	try {
		$usuario -> validar_usuario($link);
		header("Location: ../pagprincipal.php");
	} catch (Exception $e){
		$mensaje= $e->getMessage();
		header("Location: ../index.php?mensaje=$mensaje");
	}
?>
