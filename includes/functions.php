<?php

function obtenerUsuarios() 
{
        require 'database.php';

        $sql = "SELECT * FROM usuarios;";

        $consulta = mysqli_query($db, $sql);

        echo "<pre>";
            var_dump (mysqli_fetch_assoc( $consulta ) );
        echo "</pre>";

}

obtenerUsuarios();