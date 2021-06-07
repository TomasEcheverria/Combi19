<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));

    $update= false;
    $id =0;
    $descripcion = '';
    $codigo_postal_origen = 0;
    $codigo_postal_destino = 0;
    $kilometros = 0;




    // Alta de rutas
    if(isset($_POST['submit'])){
        $descripcion = $_POST["descripcion"];
        $codigo_postal_origen = $_POST["codigo_postal_origen"];
        $codigo_postal_destino = $_POST["codigo_postal_destino"];
        $kilometros = $_POST["kilometros"];
        if ($codigo_postal_origen == $codigo_postal_destino)
        {
            header("Location: ../vista_rutas.php?msg=3");
        } else {

            $ruta_existe="SELECT * FROM rutas WHERE ((descripcion='$descripcion') AND activo=1)";
            $resultado_ruta_existe = mysqli_query($db,$ruta_existe);
            if (empty(mysqli_fetch_assoc($resultado_ruta_existe))){
                $sql = "INSERT INTO rutas (`descripcion`, `codigo_postal_origen`, `codigo_postal_destino`, `kilometros`, `activo`) VALUES
                ('$descripcion', '$codigo_postal_origen', '$codigo_postal_destino', '$kilometros', 1);";
                mysqli_query($db,$sql);      
                header("Location: ../vista_rutas.php");
            } else {
                header("Location: ../vista_rutas.php?msg=");

            }
        }


    }





    //Baja de rutas
    if(isset($_GET['delete'])){

        $id = $_GET['delete'];
        $viaje_existe = "SELECT * FROM viajes WHERE ((idr=$id) AND activo=1 AND (estado='pendiente' OR estado='en curso'))";
        $resultado_viaje_existe = mysqli_query($db,$viaje_existe);
        if (empty(mysqli_fetch_assoc($resultado_viaje_existe))){
            
            $sql = "UPDATE rutas SET activo=0 WHERE activo=1 AND idr='$id'";
            mysqli_query($db,$sql);        
            header("Location: ../vista_rutas.php");    
        }else {
            header("Location: ../vista_rutas.php?msg=1");
        }           


    }




    //Cambia el boton de submit a update, y trae los datos de la rutas correspondiente 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        
        $viaje_existe = "SELECT * FROM viajes WHERE ((idr=$id) AND activo=1 AND (estado='pendiente' OR estado='en curso'))";
        $resultado_viaje_existe = mysqli_query($db,$viaje_existe);
        if (empty(mysqli_fetch_assoc($resultado_viaje_existe))){
            $update = true;
            $sql = "SELECT * from rutas WHERE activo=1 AND idr='$id'";
            $result = $db->query($sql) or die("error". mysqli_error ($db));
        } else {
            header("Location: ../vista_rutas.php?msg=4");
        }


        //Ruta buscada en la BD
        if($result->num_rows == 1){
            $row = $result->fetch_array();
            $descripcion = $row["descripcion"];
            $codigo_postal_origen = $row["codigo_postal_origen"];
            $codigo_postal_destino = $row["codigo_postal_destino"];
            $kilometros = $row["kilometros"];
        }
    }




    //Actualiza los datos de la rutas seleccionado
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $descripcion = $_POST["descripcion"];
        $codigo_postal_origen = $_POST["codigo_postal_origen"];
        $codigo_postal_destino = $_POST["codigo_postal_destino"];
        $kilometros = $_POST["kilometros"];
        
        if ($codigo_postal_origen == $codigo_postal_destino)
        {
            header("Location: ../vista_rutas.php?msg=3");
        } else {
            //Se comprueba si la ruta existe antes de updatear
            $ruta_existe="SELECT * FROM rutas WHERE ((descripcion='$descripcion') AND activo=1 AND idr<>'$id')";
            $resultado_ruta_existe = mysqli_query($db,$ruta_existe);
            if (empty(mysqli_fetch_assoc($resultado_ruta_existe))){
                $sql = "UPDATE rutas SET descripcion='$descripcion', codigo_postal_origen='$codigo_postal_origen', codigo_postal_destino='$codigo_postal_destino', kilometros='$kilometros' WHERE idr='$id'";
                $db->query($sql) or die($db->error);
                header("Location: ../vista_rutas.php");            
            } else {
                header("Location: ../vista_rutas.php?msg=2");
            }
        }

    }

