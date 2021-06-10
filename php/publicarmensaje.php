<?php
	include "../BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "classLogin.php";
	$usuario= new usuario();
	$usuario ->id($id);
    $usuario ->email($email);
    $idv=$_POST['idv'];
    $idp=$_POST['idp'];
    $fechayhora=date("Y-m-d H:i:s"); 
    $texto=$_POST['publicacion'];
    
    $query10="UPDATE pasajes SET comentario='1' WHERE idp='$idp'";
    $result10= mysqli_query($link, $query10) or die('Consulta 10 fallida ' .mysqli_error($link));

    $consulta="INSERT INTO comentarios(email,idv,fecha_y_hora,texto_comentario) VALUES ('$email',$idv,'$fechayhora','$texto')"; 
    $resultado = mysqli_query($link, $consulta)or die ('Consulta fallida ' .mysqli_error($link));

    $query11="SELECT * FROM comentarios WHERE email='$email' AND idv='$idv' AND fecha_y_hora='$fechayhora' AND texto_comentario='$texto' AND activo='1'";
    $resultado11 = mysqli_query($link, $query11)or die ('Consulta  query 11 fallida ' .mysqli_error($link));
    $comentario=mysqli_fetch_array($resultado11);

    $query10="UPDATE pasajes SET idcom='$comentario[idcom]' WHERE idp='$idp'";
    $result10= mysqli_query($link, $query10) or die('Consulta 10 fallida ' .mysqli_error($link));
    
    header("Location: ../pasajes.php");
?>
