<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));

    $update= false;
    $id =0;
    $codigo_ruta = '';
    $codigo_postal_origen = 0;
    $codigo_postal_destino = 0;
    $kilometros = 0;




    // Alta de rutas
    if(isset($_POST['submit'])){
        $codigo_ruta = $_POST["codigo_ruta"];
        $codigo_postal_origen = $_POST["codigo_postal_origen"];
        $codigo_postal_destino = $_POST["codigo_postal_destino"];
        $kilometros = $_POST["kilometros"];
    
        $ruta_existe="SELECT * FROM rutas WHERE ((codigo_ruta='$codigo_ruta') AND activo=1)";
        $resultado_ruta_existe = mysqli_query($db,$ruta_existe);
        if (empty(mysqli_fetch_assoc($resultado_ruta_existe))){
            $sql = "INSERT INTO rutas (`codigo_ruta`, `codigo_postal_origen`, `codigo_postal_destino`, `kilometros`, `activo`) VALUES
            ('$codigo_ruta', '$codigo_postal_origen', '$codigo_postal_destino', '$kilometros', 1);";
            mysqli_query($db,$sql);      

        }

        header("Location: ../vista_rutas.php");
    }





    //Baja de rutas
    if(isset($_GET['delete'])){

        $id = $_GET['delete'];
        $viaje_existe = "SELECT * FROM viajes WHERE ((idr=$id) AND activo=1)";
        $resultado_viaje_existe = mysqli_query($db,$viaje_existe);
        if (empty(mysqli_fetch_assoc($resultado_viaje_existe))){
            
            $sql = "UPDATE rutas SET activo=0 WHERE activo=1 AND idr='$id'";
            mysqli_query($db,$sql);
        }
        header("Location: ../vista_rutas.php");

    }




    //Cambia el boton de submit a update, y trae los datos de la combi correspondiente 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;

        $sql = "SELECT * from rutas WHERE activo=1 AND idr='$id'";
        $result = $db->query($sql) or die("error". mysqli_error ($db));



        //Combi buscada en la BD
        if($result->num_rows == 1){
            $row = $result->fetch_array();
            $codigo_ruta = $row["codigo_ruta"];
            $codigo_postal_origen = $row["codigo_postal_origen"];
            $codigo_postal_destino = $row["codigo_postal_destino"];
            $kilometros = $row["kilometros"];
        }
    }




    //Actualiza los datos de la combi seleccionado
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $codigo_ruta = $_POST["codigo_ruta"];
        $codigo_postal_origen = $_POST["codigo_postal_origen"];
        $codigo_postal_destino = $_POST["codigo_postal_destino"];
        $kilometros = $_POST["kilometros"];
        $sql = "UPDATE rutas SET codigo_ruta='$codigo_ruta', codigo_postal_origen='$codigo_postal_origen', codigo_postal_destino='$codigo_postal_destino', kilometros='$kilometros' WHERE idr='$id'";
        $db->query($sql) or die($db->error);
        
        header("Location: ../vista_rutas.php");
    }

