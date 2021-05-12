<!--Funcion para traer lugares de la BD -->
<?php
    include 'BD.php';
    include 'php/acciones_lugares.php';

    function getLugares(){
        $db = conectar();
        $sql = "SELECT * FROM `lugares` WHERE activo = 1";
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
<!--Funcion para traer lugares de la BD -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de lugares</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>

    <div class="card">
    <div class="card-header text-center">
        <strong>Agregar lugar</strong>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <form action ="php/acciones_lugares.php" class="row g-3" method ="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Código Postal</label>
                <input type="number" class="form-control" name="codigo_postal" placeholder="" value="<?php echo $codigo_postal?>" required="" min=0>
            </div>
            <div class="col-md-6">
                <label for="inputZip" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="" value="<?php echo $nombre?>" required="">
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
              <th scope="col">Código Postal</th>
              <th scope="col">Nombre</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php
            // Tabla de lugares
            $lugares = getLugares();
            if(!empty($lugares)){
                foreach ($lugares as $value) {
                    $idl = $value['idl'];
                    echo 
                    "<tr>".
                        "<td>". $value['codigo_postal'] . "</td>".
                        "<td>". $value['nombre'] . "</td>".
                        "<td>".                    
                            "<a href='vista_lugares.php?edit=$idl'class='btn btn btn-outline-success'>Editar</a>".
                            "<a href='php/acciones_lugares.php?delete=$idl'class='btn btn-outline-danger ml-1'>Borrar</a>".
                        "</td>".
                    "</tr>";
                }
            }
            ?>
            
          </tbody>
        </table>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>