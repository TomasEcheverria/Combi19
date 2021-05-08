<?php
    include_once '../otras_cosas/database.php';

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $db = connectDB();
        $sql = "UPDATE usuarios SET activo=0 WHERE activo=1 AND email='$id'";
        mysqli_query($db,$sql);
    }

    header("Location: ../vista_choferes.php?delete=success");