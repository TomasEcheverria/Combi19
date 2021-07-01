<?php

$db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());
//Para las alertas, borrar 0, guardar 1.
if(isset($_POST['update'])){
    $id = $_POST['id'];
    header("Location: ../vista_imprevistos.php?upd=$id");
}

if(isset($_POST['create'])){
    $id = $_POST['id'];
    header("Location: ../vista_imprevistos.php?upd=$id");
}

if(isset($_POST['save'])){
    $id = $_POST['id'];
    $imprevisto = $_POST['detalle_imprevisto'];
    $sql= "UPDATE viajes
    SET 
        viajes.imprevisto = '$imprevisto',
        viajes.estado_imprevisto = 'pendiente'
    WHERE viajes.idv = '$id'";

mysqli_query($db,$sql);
    header("Location: ../vista_imprevistos.php?sv=1");
}

if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $sql= "UPDATE viajes
    SET 
        viajes.imprevisto = '',
        viajes.estado_imprevisto = 'desactivado'
    WHERE viajes.idv = '$id'";

mysqli_query($db,$sql);
    header("Location: ../vista_imprevistos.php?sv=0");
}

if(isset($_POST['refresh'])){
    header("Location: ../vista_imprevistos.php");
}