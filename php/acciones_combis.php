<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());

    $update= false;
    $id ='';
    $patente = '';
    $cantidad_asientos = 0;
    $tipo = '';
    $modelo = '';
    $email = '';



    // Alta de combis
    if(isset($_POST['submit'])){
        $patente = $_POST["patente"];
        $cantidad_asientos = $_POST["cantidad_asientos"];
        $tipo = $_POST["tipo"];
        $modelo = $_POST["modelo"];
        $email = $_POST["email"];
    
    
        $sql = "INSERT INTO combis (`patente`, `cantidad_asientos`, `tipo`, `modelo`, `email`, `activo`) VALUES
        ('$patente', '$cantidad_asientos', '$tipo', '$modelo', '$email', 1);";
        mysqli_query($db,$sql);
    
        header("Location: ../vista_combis.php");
    }





    //Baja de combis
    if(isset($_GET['delete'])){

        $id = $_GET['delete'];
        $sql = "UPDATE combis SET activo=0 WHERE activo=1 AND patente='$id'";
        mysqli_query($db,$sql);
        header("Location: ../vista_combis.php");

    }




    //Cambia el boton de submit a update, y trae los datos del insumo correspondiente 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;

        $sql = "SELECT * from combis WHERE activo=1 AND patente='$id'";
        $result = $db->query($sql) or die ($db->error());



        //Usuario buscado de la BD
        if($result->num_rows == 1){
            $row = $result->fetch_array();
            $patente = $row["patente"];
            $cantidad_asientos = $row["cantidad_asientos"];
            $tipo = $row["tipo"];
            $modelo = $row["modelo"];
            $email = $row["email"];
        }
    }




    
    //Actualiza los datos del insumo seleccionado
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $patente = $_POST["patente"];
        $cantidad_asientos = $_POST["cantidad_asientos"];
        $tipo = $_POST["tipo"];
        $modelo = $_POST["modelo"];
        $email = $_POST["email"];
        $sql = "UPDATE combis SET patente='$patente', cantidad_asientos='$cantidad_asientos', tipo='$tipo', modelo='$modelo' WHERE patente='$id'";
        $db->query($sql) or die($db->error);
        
        header("Location: ../vista_combis.php");
    }
    
