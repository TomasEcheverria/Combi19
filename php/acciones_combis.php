<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));

    $update= false;
    $id ='';
    $patente = '';
    $cantidad_asientos = 0;
    $tipo = '';
    $modelo = '';
    $idu = '';



    // Alta de combis
    if(isset($_POST['submit'])){
        $patente = $_POST["patente"];
        $cantidad_asientos = $_POST["cantidad_asientos"];
        $tipo = $_POST["tipo"];
        $modelo = $_POST["modelo"];
        $idu = $_POST["idu"];
    
    
        $sql = "INSERT INTO combis (`patente`, `cantidad_asientos`, `tipo`, `modelo`, `idu`, `activo`) VALUES
        ('$patente', '$cantidad_asientos', '$tipo', '$modelo', '$idu', 1);";
        mysqli_query($db,$sql);
    
        header("Location: ../vista_combis.php");
    }





    //Baja de combis
    if(isset($_GET['delete'])){

        $id = $_GET['delete'];
        $sql = "UPDATE combis SET activo=0, idu='' WHERE activo=1 AND idc='$id'";
        mysqli_query($db,$sql);
        header("Location: ../vista_combis.php");

    }




    //Cambia el boton de submit a update, y trae los datos de la combi correspondiente 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;

        $sql = "SELECT * from combis WHERE activo=1 AND idc='$id'";
        $result = $db->query($sql) or die("error". mysqli_error ($db));



        //Combi buscada en la BD
        if($result->num_rows == 1){
            $row = $result->fetch_array();
            $patente = $row["patente"];
            $cantidad_asientos = $row["cantidad_asientos"];
            $tipo = $row["tipo"];
            $modelo = $row["modelo"];
            $idu = $row["idu"];
        }
    }




    //Actualiza los datos de la combi seleccionado
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $patente = $_POST["patente"];
        $cantidad_asientos = $_POST["cantidad_asientos"];
        $tipo = $_POST["tipo"];
        $modelo = $_POST["modelo"];
        $idu = $_POST["idu"];
        $sql = "UPDATE combis SET patente='$patente', cantidad_asientos='$cantidad_asientos', tipo='$tipo', modelo='$modelo', idu='$idu' WHERE idc='$id'";
        $db->query($sql) or die($db->error);
        
        header("Location: ../vista_combis.php");
    }
    
