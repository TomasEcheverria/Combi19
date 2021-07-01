<?php

$db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());
//Para las alertas, borrar 0, guardar 1.


if(isset($_POST['resolver'])){
    $id = $_POST['id'];
    $imprevisto = $_POST['detalle_imprevisto'];
    $sql= "UPDATE viajes
    SET 
        viajes.estado_imprevisto = 'resuelto'
    WHERE viajes.idv = '$id'";

mysqli_query($db,$sql);
    header("Location: ../vista_imprevistos_admin.php?sv=1");
}

if(isset($_POST['refresh'])){
    header("Location: ../vista_imprevistos_admin.php");
}