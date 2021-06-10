<?php
 $db = mysqli_connect('localhost', 'root', '','combi19') or die("error". mysqli_error ($db));


    if(isset($_POST['submit'])){
        $idp = $_POST['idp'];
        if ($_POST['suscrito']==1){
            $total = $_POST['total'];
            $sql = "UPDATE pasajes SET precio='$total', fantasma=0 WHERE idp='$idp'";
            $db->query($sql) or die("error". mysqli_error ($db));
            $sql = "UPDATE pasajeros SET activo=1 WHERE idp='$idp'";
            $db->query($sql) or die("error". mysqli_error ($db)); 

            $sql = "UPDATE insumos_usuarios_viajes SET activo=1 WHERE idp='$idp'";
            $db->query($sql) or die("error". mysqli_error ($db)); 

            
            $sql = "SELECT * FROM `insumos_usuarios_viajes` WHERE (idp='$idp') AND (activo=1) ";
            $result = mysqli_query($db,$sql);
            $numRows = $result->num_rows;
            if ($numRows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $iuv[] = $row;
                }
            }

            if(!empty($iuv)){
                foreach ($iuv as $value) {
                    $idi = $value['idi'];
                    $cantidad = $value['cantidad'];

                    $cons = "SELECT * FROM `insumos` WHERE (idi='$idi') AND (activo=1)";
                    $result = mysqli_query($db, $cons);
		            $insumoinfo = $result->fetch_assoc();

                    $cantidad= $insumoinfo['inventario']-$cantidad;
                    $sql = "UPDATE insumos SET inventario='$cantidad' WHERE idi='$idi'";
                    $db->query($sql) or die("error". mysqli_error ($db)); 
                }
            }

            header("Location: ../vista_busqueda.php?msg=1");
        }  else{
            if ( (is_numeric($_POST['nro1'])) && (is_numeric($_POST['nro2'])) && (is_numeric($_POST['nro3'])) && (is_numeric($_POST['nro4'])) && (is_numeric($_POST['nro5'])) ){
                $total = $_POST['total'];
                $sql = "UPDATE pasajes SET precio='$total', fantasma=0 WHERE idp='$idp'";
                $db->query($sql) or die("error". mysqli_error ($db));
                $sql = "UPDATE pasajeros SET activo=1 WHERE idp='$idp'";
                $db->query($sql) or die("error". mysqli_error ($db));  

                $sql = "UPDATE insumos_usuarios_viajes SET activo=1 WHERE idp='$idp'";
                $db->query($sql) or die("error". mysqli_error ($db)); 

                $sql = "UPDATE insumos_usuarios_viajes SET activo=1 WHERE idp='$idp'";
                $db->query($sql) or die("error". mysqli_error ($db)); 

                
                $sql = "SELECT * FROM `insumos_usuarios_viajes` WHERE (idp='$idp') AND (activo=1) ";
                $result = mysqli_query($db,$sql);
                $numRows = $result->num_rows;
                if ($numRows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $iuv[] = $row;
                    }
                }

                if(!empty($iuv)){
                    foreach ($iuv as $value) {
                        $idi = $value['idi'];
                        $cantidad = $value['cantidad'];

                        $cons = "SELECT * FROM `insumos` WHERE (idi='$idi') AND (activo=1)";
                        $result = mysqli_query($db, $cons);
                        $insumoinfo = $result->fetch_assoc();

                        $cantidad= $insumoinfo['inventario']-$cantidad;
                        $sql = "UPDATE insumos SET inventario='$cantidad' WHERE idi='$idi'";
                        $db->query($sql) or die("error". mysqli_error ($db)); 
                    }
                }

                header("Location: ../vista_busqueda.php?msg=1");
            } else {
                header("Location: ../vista_pago.php?msg=1&idp=".$idp);
            }
        }
        
    }