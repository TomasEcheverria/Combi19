<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));

    $update= false;
    $id =0;
    $codigo_postal_origen = 0;
    $codigo_postal_destino = 0;
    $fecha = '';
    $hora = '';



    // Alta de rutas
    if(isset($_POST['submit'])){
        $fecha = $_POST["fecha"];
        $codigo_postal_origen = $_POST["codigo_postal_origen"];
        $codigo_postal_destino = $_POST["codigo_postal_destino"];

        if ($codigo_postal_origen == $codigo_postal_destino)
        {
            header("Location: ../vista_busqueda.php?errormsg=3");
        } else {

            $viaje_existe="SELECT v.*, r.codigo_postal_origen, r.codigo_postal_destino FROM viajes v INNER JOIN rutas r ON (v.idr=r.idr) WHERE v.activo=1 AND r.activo=1 AND v.estado='pendiente' AND ((codigo_postal_origen='$codigo_postal_origen' AND codigo_postal_destino='$codigo_postal_destino' AND fecha='$fecha'))";
            $resultado_viajes = mysqli_query($db,$viaje_existe);             
            if ($consulta_viajes = mysqli_fetch_assoc($resultado_viajes)){
                header("Location: ../vista_busqueda.php?cpo=".$codigo_postal_origen."&cpd=".$codigo_postal_destino."&fecha=".$fecha);
            } else {
                header("Location: ../vista_busqueda.php?errormsg=4");
            }
        }


    }





 

    

