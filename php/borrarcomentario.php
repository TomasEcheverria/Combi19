<?php
include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "classLogin.php";
	$usuario= new usuario();
	$usuario ->id($id);
    $usuario ->email($email);
    $idp=$_POST['idp'];
    $idcom=$_POST['idcom'];
    $query="UPDATE comentarios SET activo='0' WHERE idcom='$idcom'";
    $result10= mysqli_query ($link, $query) or die ('Consulta  fallida ' .mysqli_error($link));

    $query1="UPDATE pasajes SET comentario='0',idcom='' WHERE idp='$idp'";
    $result1= mysqli_query ($link, $query1) or die ('Consulta query1 fallida ' .mysqli_error($link));
    header("Location: ../pasajes.php");
?>