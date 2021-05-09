<?php
    include_once '../BD.php';

    $patente = $_POST["patente"];
    $tipo = $_POST["tipo"];
    $modelo = $_POST["modelo"];
    $email = $_POST["email"];
    $activo = $_POST["activo"];

    $db = conectar();

    $sql = "INSERT INTO combis (`patente`, `tipo`, `model`, `email`, `activo`) VALUES
    ('$patente', '$tipo', '$modelo', $email, '$activo');";
    mysqli_query($db,$sql);

//NO ESTA TERMINADO!!!!