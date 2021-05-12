<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));
    $update= false;
    $id =0;
    $codigo_postal = 0;
    $nombre = '';


    // Alta de lugares
    if(isset($_POST['submit'])){
        $codigo_postal = $_POST["codigo_postal"];
        $nombre = $_POST["nombre"];
    
        
        $sql = "INSERT INTO lugares (`codigo_postal`, `nombre`, `activo`) VALUES
        ('$codigo_postal', '$nombre', 1);";
        mysqli_query($db,$sql);
    
        header("Location: ../vista_lugares.php");
    }

    //Baja de lugares
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $viaje_existe = "SELECT v.* FROM viajes v INNER JOIN rutas r ON ((r.idr=v.idr) AND ((v.activo=1) AND (r.activo=1)) AND ((r.codigo_postal_origen='$id') OR (r.codigo_postal_destino='$id')))";
        $resultado_viaje_existe = mysqli_query($db,$viaje_existe);

        $ruta_existe= "SELECT * FROM rutas WHERE (((codigo_postal_origen='$id') OR (codigo_postal_destino='$id')) AND activo=1)";
        $resultado_ruta_existe = mysqli_query($db,$ruta_existe);

        if (empty(mysqli_fetch_assoc($resultado_viaje_existe)) && (empty(mysqli_fetch_assoc($resultado_ruta_existe)))){
            $sql = "UPDATE lugares SET activo=0 WHERE activo=1 AND idl='$id'"; 
            mysqli_query($db,$sql);                   
        }
        else {
            echo "no hagas eso bro :(";
        }

        header("Location: ../vista_lugares.php");
    }

    //Cambia el boton de submit a update, y trae los datos del insumo correspondiente 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $sql = "SELECT * from lugares WHERE activo=1 AND idl='$id'";
        $result = $db->query($sql) or die("error". mysqli_error ($db));

        //Usuario buscado de la BD
        if($result->num_rows == 1){
            $row = $result->fetch_array();
            $codigo_postal = $row["codigo_postal"];
            $nombre = $row["nombre"];
        }
    }
    
    //Actualiza los datos del insumo seleccionado
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $codigo_postal = $_POST["codigo_postal"];
        $nombre = $_POST["nombre"];
        $sql = "UPDATE lugares SET codigo_postal='$codigo_postal', nombre='$nombre' WHERE idl='$id'";
        $db->query($sql) or die("error". mysqli_error ($db));
        
        header("Location: ../vista_lugares.php");
    }
    
