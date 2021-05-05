<?php

function connectDB(){

    $db = mysqli_connect('localhost', 'root', '','combi19');
    if(!$db){
        echo "Error, no se pudo conectar";
        exit;
    }

    return $db;
}
