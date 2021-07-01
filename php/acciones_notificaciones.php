<?php

$db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());

if(isset($_POST['resolver'])){

    $sql= "UPDATE viajes
    SET 
        viajes.estado_imprevisto = 'resuelto'
    WHERE viajes.estado_imprevisto = 'pendiente'";

mysqli_query($db,$sql);
    header("Location: ../vista_imprevistos_admin.php?sv=0");
}