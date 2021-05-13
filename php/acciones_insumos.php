<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die($db->error());
    $update= false;
    $id ='';
    $nombre = '';
    $inventario = '';
    $precio = '';

    // Alta de insumos
    if(isset($_POST['submit'])){
        $nombre = $_POST["nombre"];
        $inventario = $_POST["inventario"];
        $precio = $_POST["precio"];
    
        $nombre_existe ="SELECT * FROM insumos WHERE ((nombre='$nombre') AND activo=1)";
        $resultado_nombre_existe = mysqli_query($db,$nombre_existe);
        // Se agrega solo si el nombre que se quiere usar no existe
        if(empty(mysqli_fetch_assoc($resultado_nombre_existe))){

            $sql = "INSERT INTO insumos (`nombre`, `inventario`, `precio`, `activo`) VALUES
            ('$nombre', '$inventario', '$precio', 1);";
            mysqli_query($db,$sql);

        }


    
        header("Location: ../vista_insumos.php");
    }

    //Baja de insumos
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $sql = "UPDATE insumos SET activo=0 WHERE activo=1 AND idi='$id'";
        mysqli_query($db,$sql);
        header("Location: ../vista_insumos.php");
    }

    //Cambia el boton de submit a update, y trae los datos del insumo correspondiente 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;

        $sql = "SELECT * from insumos WHERE activo=1 AND idi='$id'";
        $result = $db->query($sql) or die ($db->error());

        //Usuario buscado de la BD
        if($result->num_rows == 1){
            $row = $result->fetch_array();
            $nombre = $row["nombre"];
            $inventario = $row["inventario"];
            $precio = $row["precio"];
        }
    }
    
    //Actualiza los datos del insumo seleccionado
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $nombre = $_POST["nombre"];
        $inventario = $_POST["inventario"];
        $precio = $_POST["precio"];

        $nombre_existe_edit="SELECT * FROM combis WHERE (((nombre='$nombre') AND (idi<>'$id')) AND activo=1)";
        $resultado_nombre_existe_edit =  mysqli_query($db,$nombre_existe_edit);

        
        if(empty(mysqli_fetch_assoc($resultado_nombre_existe_edit))){

            $sql = "UPDATE insumos SET nombre='$nombre', inventario='$inventario', precio='$precio' WHERE idi='$id'";
            $db->query($sql) or die($db->error);
        }
       
        header("Location: ../vista_insumos.php");
    }
    
