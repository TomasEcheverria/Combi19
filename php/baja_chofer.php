<?php
    include_once '../BD.php';

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $db = conectar();
        $sql = "UPDATE usuarios SET activo=0 WHERE activo=1 AND email='$id'";
        mysqli_query($db,$sql);
    }

    header("Location: ../vista_choferes.php?delete=success");