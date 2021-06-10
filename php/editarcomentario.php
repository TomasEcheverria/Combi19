<?php
include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "classLogin.php";
	$usuario= new usuario();
	$usuario ->id($id);
    $usuario ->email($email);
    $texto=$_POST['publicacion'];
    $idcom=$_POST['idcom'];
    $query="UPDATE comentarios SET texto_comentario='$texto' WHERE idcom='$idcom'";
    $result10= mysqli_query ($link, $query) or die ('Consulta  fallida ' .mysqli_error($link));

    header("Location: ../pasajes.php");
?>