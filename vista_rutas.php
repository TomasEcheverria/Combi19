<!--Funcion para traer rutas de la BD -->
<?php
    include 'BD.php';
    include 'php/acciones_rutas.php';
    $db = conectar();

    //Consulta para obtener lugares
    $consulta_lugares = "SELECT * FROM lugares WHERE activo = 1";
    $resultado = mysqli_query($db, $consulta_lugares);
    

    function getRutas(){
        $db = conectar();        
        $sql = "SELECT * FROM `rutas` WHERE activo = 1";
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
        <strong>Agregar Ruta</strong>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <form action ="php/acciones_rutas.php" class="row g-3" method ="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Código de ruta</label>
                <input type="number" class="form-control" name="codigo_ruta" placeholder="" value="<?php echo $codigo_ruta?>" required="" min=0>
            </div>


            <div class="col-md-6">
                <label for="inputZip" class="form-label">Lugar de origen</label>
                <select name="codigo_postal_origen" class="form-select">
                    <option value="">--Seleccione--</option>
                    <?php while ($lugares = mysqli_fetch_assoc($resultado) ) : ?>
                        <option value="<?php echo $lugares['codigo_postal']; ?>"> <?php echo $lugares['nombre'] . " " . $lugares['codigo_postal']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <?php $resultado = mysqli_query($db, $consulta_lugares); ?>                
            <div class="col-md-6">
                <label for="inputZip" class="form-label">Lugar de destino</label>
                <select name="codigo_postal_destino" class="form-select">
                    <option value="">--Seleccione--</option>
                    <?php while ($lugares = mysqli_fetch_assoc($resultado) ) : ?>
                        <option value="<?php echo $lugares['codigo_postal']; ?>"> <?php echo $lugares['nombre'] . " " . $lugares['codigo_postal']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>


            
            <div class="col-md-6">
                <label for="inputZip" class="form-label">Cantidad de kilómetros</label>
                <input type="number" class="form-control" name="kilometros" placeholder="" value="<?php echo $kilometros?>" required="" min=0>
            </div>
                <?php if($update == true){
                    echo "<div class='col-12'> <button type='submit'name='update' class='btn btn-info'>Update</button> </div>";
                    }else{
                    echo "<div class='col-12'> <button type='submit' name='submit' class='btn btn-primary'>Submit</button> </div>";
                    }          
                ?>
            </form>
        </blockquote>
    </div>
    </div>

    <table class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th scope="col">Código de ruta</th>
              <th scope="col">Código postal de origen</th>
              <th scope="col">Código postal de destino</th>
              <th scope="col">Cantidad de kilómetros</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php
              // Tabla de choferes
              $rutas = getRutas();
              foreach ($rutas as $value) {
                  $codigo_ruta = $value['codigo_ruta'];
                  echo 
                  "<tr>".
                    "<td>". $value['codigo_ruta'] . "</td>".
                    "<td>". $value['codigo_postal_origen'] . "</td>".
                    "<td>". $value['codigo_postal_destino'] . "</td>".
                    "<td>". $value['kilometros'] . "</td>".
                    "<td>".                    
                      "<a href='vista_rutas.php?edit=$codigo_ruta'class='btn btn btn-outline-success'>Editar</a>".
                      "<a href='php/acciones_rutas.php?delete=$codigo_ruta'class='btn btn-outline-danger ml-1'>Borrar</a>".
                    "</td>".
                  "</tr>";
              }
              ?>
          </tbody>
        </table>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>