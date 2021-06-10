<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));
    $idp = '';
    $cantidad_asientos = 0;



    if(isset($_POST['submit'])){
        $cantidad_asientos = $_POST['cantidad_asientos'];
        $idp = $_POST['idp'];

        var_dump($_POST);
        $nombre_actual='';
        $dni_actual='';
        $apellido_actual='';
        //variables para el valor real
        $nombrei='';
        $dnii='';
        $apellidoi='';
        //variables para la iteracion
        
        for ($i=1;$i<=$cantidad_asientos;$i++){
            $nombrei = "nombre".$i;
            $apellidoi = "apellido".$i;
            $dnii = "dni".$i;
            $nombre_actual = $_POST[$nombrei];
            $dni_actual = $_POST[$dnii];
            $apellido_actual = $_POST[$apellidoi];
            $sql = "INSERT INTO pasajeros (`nombre`, `apellido`, `dni`, `idp`, `activo`) VALUES
            ('$nombre_actual', '$apellido_actual', '$dni_actual', '$idp', 0);";
            mysqli_query($db,$sql);
                  
        }
        echo "Por el momento confio, 1% probabilidades, 99% de fe (?";

        header("Location: ../vista_carga_insumos.php?idp=".$idp);

    }

  

   

    
