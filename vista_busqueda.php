<!--Funcion para traer rutas de la BD -->
<?php



    include 'BD.php';
    include 'php/acciones_busqueda.php';
    $db = conectar();
    include 'php/classLogin.php';
    $usuario= new usuario();
    $usuario -> tipoUsuario($tipo);


    //Consulta para obtener lugares
    $consulta_lugares = "SELECT * FROM lugares WHERE activo = 1 ORDER BY provincia";
    

    function getViajes(){
        $db = conectar();        
        $sql = "SELECT v.*, r.codigo_postal_origen, r.codigo_postal_destino FROM viajes v INNER JOIN rutas r ON (v.idr=r.idr) WHERE v.activo=1 AND r.activo=1 AND v.estado='pendiente'ORDER BY v.fecha";
        $result = mysqli_query($db,$sql);
        $numRows = $result->num_rows;
        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

?>
<!--Funcion para traer rutas de la BD -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de rutas</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>

    <div class="card">
    <div class="card-header text-center">
        <strong>Buscar Viaje</strong>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <form action ="php/acciones_busqueda.php" class="row g-3" method ="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            
            <?php $resultado = mysqli_query($db, $consulta_lugares); ?>                
            <div class="col-md-6">
                <label for="inputZip" class="form-label">Lugar de origen</label>
                <select name="codigo_postal_origen" class="form-select" required="">
                    <option value="">--Seleccione--</option>
                    <?php while ($lugares = mysqli_fetch_assoc($resultado) ) : ?>
                        <<option <?php echo $codigo_postal_origen === $lugares['idl'] ? 'selected' : ''; ?> value="<?php echo $lugares['idl']; ?>"> <?php echo $lugares['provincia'] . "-" . $lugares['nombre']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>



            <?php $resultado = mysqli_query($db, $consulta_lugares); ?>                
            <div class="col-md-6">
                <label for="inputZip" class="form-label">Lugar de destino</label>
                <select name="codigo_postal_destino" class="form-select" required="">
                    <option value="">--Seleccione--</option>
                    <?php while ($lugares = mysqli_fetch_assoc($resultado) ) : ?>
                        <<option <?php echo $codigo_postal_destino === $lugares['idl'] ? 'selected' : ''; ?> value="<?php echo $lugares['idl']; ?>"> <?php echo $lugares['provincia'] . "-" . $lugares['nombre']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>



            <div class="col-md-6">
                <label for="inputZip" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fecha" placeholder="" value="<?php echo $fecha?>" required="">
            </div>
                <?php if($update == true){
                    echo "<div class='col-12'> <a class='btn btn-outline-primary' href='pagprincipal.php'>Volver</a> <button type='submit'name='update' class='btn btn-info'>Update</button> </div>";
                    }else{
                    echo "<div class='col-12'> <a class='btn btn-outline-primary' href='pagprincipal.php'>Volver</a> <button type='submit' name='submit' class='btn btn-primary'>Buscar</button> </div>";
                    }          
                ?>
            </form>
        </blockquote>
    </div>
    </div>


    <table class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th scope="col">Origen</th>
              <th scope="col">Destino</th>
              <th scope="col">Fecha</th>
              <th scope="col">Hora</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>

            <?php

              
            if (isset($_GET['cpo']))
            {
                $cpo = $_GET['cpo'];
                $cpd = $_GET['cpd'];
                $fecha = $_GET['fecha'];
                $viajeget="SELECT v.*, r.codigo_postal_origen, r.codigo_postal_destino FROM viajes v INNER JOIN rutas r ON (v.idr=r.idr) WHERE v.activo=1 AND r.activo=1 AND v.estado='pendiente' AND ((codigo_postal_origen='$cpo' AND codigo_postal_destino='$cpd' AND fecha='$fecha'))";
                $resultadoget = mysqli_query($db,$viajeget); 
                while ($row = $resultadoget->fetch_assoc()) {
                    $viajes[] = $row;
                }
            } else {
                $viajes = getViajes(); 
            }

               // Tabla de viajes
            
            if(!empty($viajes)){
                foreach ($viajes as $value) {
                    $idv = $value['idv'];
                  
                    $idorigen= $value['codigo_postal_origen'];
                    $consulta_lugareso = "SELECT * FROM lugares WHERE idl = '$idorigen' ";

                    $iddestino= $value['codigo_postal_destino'];
                    $consulta_lugaresd = "SELECT * FROM lugares WHERE idl = '$iddestino' ";

                    $resultado_origen = mysqli_query($db, $consulta_lugareso);
                    $resultado_destino = mysqli_query($db, $consulta_lugaresd);

                    $origen= mysqli_fetch_assoc($resultado_origen);
                    $destino= mysqli_fetch_assoc($resultado_destino);
                    echo 
                    "<tr>".
                        
                        "<td>". $origen['nombre'] . " - " . $origen['provincia'] . "</td>".
                        "<td>". $destino['nombre'] . " - " . $destino['provincia'] . "</td>".
                        "<td>". $value['fecha'] . "</td>".
                        "<td>". $value['hora'] . " hs". "</td>".
                        "<td>".                    
                            "<a href='vista_ver_viaje.php?ver=$idv'class='btn btn btn-outline-success'>Ver Viaje</a>".
                        "</td>".
                    "</tr>";
              }
              

            if(isset($_GET['errormsg'])){
                switch ($_GET['errormsg']){
                    case 1:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "No es posible eliminar la ruta porque está siendo utilizada en un viaje pendiente.".
                            "</div>";
                        break;
                    case 2:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "Ya existe una ruta con el nombre ingresado.".
                            "</div>";
                        break;
                    case 3:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "El lugar de origen y destino no pueden ser el mismo.".
                            "</div>";
                        break;
                    case 4:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "Lo sentimos. No existen lugares con las características ingresadas.".
                            "</div>";
                        break;    
                }
            }

              

            }
            ?>
          </tbody>
        </table>
    
    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>