<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));
    $update= false;
    $id =0;
    $provincia = '';
    $nombre = '';


    // Alta de lugares
    if(isset($_POST['submit'])){
        $provincia = $_POST["provincia"];
        $nombre = $_POST["nombre"];

        $lugar_existe="SELECT * FROM lugares WHERE (((provincia='$provincia') AND (nombre='$nombre')) AND activo=1)";
        $resultado_lugar_existe = mysqli_query($db,$lugar_existe);
        if (empty(mysqli_fetch_assoc($resultado_lugar_existe))){
      
            $sql = "INSERT INTO lugares (`provincia`, `nombre`, `activo`) VALUES
            ('$provincia', '$nombre', 1);";
            mysqli_query($db,$sql);
            header("Location: ../vista_lugares.php");
        }  else {
            header("Location: ../vista_lugares.php?msg=2");
        }


    }

    //Baja de lugares
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $viaje_existe = "SELECT v.* FROM viajes v INNER JOIN rutas r ON ((r.idr=v.idr) AND ((v.activo=1) AND (v.estado='pendiente' OR v.estado='en curso') AND (r.activo=1)) AND ((r.codigo_postal_origen='$id') OR (r.codigo_postal_destino='$id')))";
        $resultado_viaje_existe = mysqli_query($db,$viaje_existe);
        $ruta_existe= "SELECT * FROM rutas WHERE (((codigo_postal_origen='$id') OR (codigo_postal_destino='$id')) AND activo=1)";
        $resultado_ruta_existe = mysqli_query($db,$ruta_existe);

        if (empty(mysqli_fetch_assoc($resultado_viaje_existe)) && (empty(mysqli_fetch_assoc($resultado_ruta_existe)))){
            $sql = "UPDATE lugares SET activo=0 WHERE activo=1 AND idl='$id'"; 
            mysqli_query($db,$sql);                   
            header("Location: ../vista_lugares.php");
        }
        else {
            header("Location: ../vista_lugares.php?msg=1");
        }

        
    }

    //Cambia el boton de submit a update, y trae los datos del lugar correspondiente 
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $viaje_existe = "SELECT v.* FROM viajes v INNER JOIN rutas r ON ((r.idr=v.idr) AND ((v.activo=1) AND (v.estado='pendiente' OR v.estado='en curso') AND (r.activo=1)) AND ((r.codigo_postal_origen='$id') OR (r.codigo_postal_destino='$id')))";
        $resultado_viaje_existe = mysqli_query($db,$viaje_existe);
        if (empty(mysqli_fetch_assoc($resultado_viaje_existe))){
            $update = true;
            $sql = "SELECT * from lugares WHERE activo=1 AND idl='$id'";
            $result = $db->query($sql) or die("error". mysqli_error ($db));

            //Lugar buscado de la BD
            if($result->num_rows == 1){
                $row = $result->fetch_array();
                $provincia = $row["provincia"];
                $nombre = $row["nombre"];
            }
        }else {
            header("Location: ../vista_lugares.php?msg=3");
        }
    }
    
    //Actualiza los datos del lugar seleccionado
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $provincia = $_POST["provincia"];
        $nombre = $_POST["nombre"];
        $lugar_existe="SELECT * FROM lugares WHERE ((((provincia='$provincia') AND (nombre='$nombre')) AND activo=1) AND (idl<>'$id'))";
        $resultado_lugar_existe = mysqli_query($db,$lugar_existe);
        if (empty(mysqli_fetch_assoc($resultado_lugar_existe))){

            $sql = "UPDATE lugares SET provincia='$provincia', nombre='$nombre' WHERE idl='$id'";
            $db->query($sql) or die("error". mysqli_error ($db));
            header("Location: ../vista_lugares.php");
        }
        else {
            header("Location: ../vista_lugares.php?msg=2");
        }
    }
    
