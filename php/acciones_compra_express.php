<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));
    

    if(isset($_POST['submit'])){
        $idv = $_POST['idv'];
        $id_pasajero = $_POST['id_pasajero'];
        $precio_viaje = $_POST['precio'];
        
        $pasaje_existe="SELECT * FROM usuarios WHERE (id='$id_pasajero')AND (activo=1)";
        $resultado_pasaje_existe = mysqli_query($db,$pasaje_existe);
        $row = mysqli_fetch_assoc($resultado_pasaje_existe);
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $dni = $row['DNI'];
        //consulta de informacion necesaria del pasajero

        $agregar_pasaje = "INSERT INTO pasajes (`cantidad_asientos`, `precio`, `idu`, `idv`, `fantasma`, `activo`) VALUES
            (1, '$precio_viaje', '$id_pasajero', '$idv', 0, 1);";
        mysqli_query($db,$agregar_pasaje);
        //creacion de pasaje

        $pasaje_creado="SELECT * FROM pasajes WHERE (idu='$id_pasajero') AND (idv='$idv') AND (activo=1)";
        $resultado_pasaje_creado = mysqli_query($db,$pasaje_creado);
        $res = mysqli_fetch_assoc($resultado_pasaje_creado);
        $idp = $res['idp'];
        //consulta del mismo pasaje para obtener autoincrement

        $sql = "INSERT INTO pasajeros (`nombre`, `apellido`, `dni`, `idp`, `presente`, `activo`) VALUES
            ('$nombre', '$apellido', '$dni', '$idp', 1, 1);";
        mysqli_query($db,$sql);

        header("Location: ../vista_compra_express.php?msg=3");
        
        echo "Por el momento confio, 1% probabilidades, 99% de fe (?";
        echo "We do little trolling";

    }