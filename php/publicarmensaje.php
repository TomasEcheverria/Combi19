<?php
	include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "classLogin.php";
	$usuario= new usuario();
	$usuario ->id($id);
    $usuario ->email($email);
    $idv=$_POST['idv'];
    $fechayhora=date("Y-m-d H:i:s"); 
    $texto=$_POST['publicacion'];

    $consulta="INSERT INTO comentarios(email,idv,fecha_y_hora,texto_comentario) VALUES ('$email',$idv,'$fechayhora','$texto')"; 
    $resultado = mysqli_query($link, $consulta)or die ('Consulta fallida ' .mysqli_error($link));

    header("Location: ../pasajes.php");
?>
