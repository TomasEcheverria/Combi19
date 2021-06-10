<?php

    $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));
    $idp = '';



        


    if(isset($_POST['submit'])){
        $idp = $_POST['idp'];

            $sql = "SELECT * FROM `insumos` WHERE (inventario>0) AND (activo=1)";
            $result = mysqli_query($db,$sql);
            $numRows = $result->num_rows;
            if ($numRows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $insumos[] = $row;
                }
            }


            if(!empty($insumos)){
                foreach ($insumos as $value) {
                    $idi = $value['idi'];
                    if (isset($_POST[$idi])){
                        $cantidad = $_POST[$idi];
                        $agregar_insumo = "INSERT INTO insumos_usuarios_viajes (`idp`, `idi`, `cantidad`, `activo`) VALUES
                            ('$idp', '$idi', '$cantidad', 0);";           
                         mysqli_query($db,$agregar_insumo);
                    }
                }
            }
        
        
        echo "Por el momento confio, 1% probabilidades, 99% de fe (?";
        header("Location: ../vista_pago.php?idp=".$idp);

    }
