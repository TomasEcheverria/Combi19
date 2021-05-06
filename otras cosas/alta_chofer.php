<?php
    include_once 'database.php';

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $dni = $_POST["dni"];
    $password = $_POST["password"];

    $db = connectDB();

    $sql = "INSERT INTO usuarios (`email`, `nombre`, `apellido`, `DNI`, `clave`, `tipo_usuario`, `suspendido`, `suscrito`, `nro_tarjeta`, `cod_seguridad`, `fecha_vencimiento`) VALUES
    ('$email', '$firstName', '$lastName', $dni, '$password', 'chofer', 0, 0, NULL, NULL, NULL);";
    mysqli_query($db,$sql);

    header("Location: ../choferes/vista_choferes.php?insert=success");