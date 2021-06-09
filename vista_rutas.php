<!--Funcion para traer rutas de la BD -->
<?php



    include 'BD.php';
    include 'php/acciones_rutas.php';
    $db = conectar();
    include 'php/classLogin.php';
    $usuario= new usuario();
    $usuario -> tipoUsuario($tipo);


    //Consulta para obtener lugares
    $consulta_lugares = "SELECT * FROM lugares WHERE activo = 1";
    

    function getRutas(){
        $db = conectar();        
        $sql = "SELECT * FROM `rutas` WHERE activo=1 EXCEPT (SELECT r1.* FROM `rutas` r1 INNER JOIN `lugares` l1 ON (r1.codigo_postal_origen=l1.idl) AND (l1.activo=0) UNION (SELECT r2.* FROM `rutas` r2 INNER JOIN `lugares` l2 ON (r2.codigo_postal_destino=l2.idl) AND (l2.activo=0)))";
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
<?php try{ 
    $usuario -> administrador($tipo);
    ?>
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
                <label for="inputEmail4" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" placeholder="" value="<?php echo $descripcion?>" required="" min=0>
            </div>

            
            <?php $resultado = mysqli_query($db, $consulta_lugares); ?>
            <div class="col-md-6">
                <label for="inputZip" class="form-label">Lugar de origen</label>
                <select name="codigo_postal_origen" class="form-select" required="">
                    <option value="">--Seleccione--</option>
                    <?php while ($lugares = mysqli_fetch_assoc($resultado) ) : ?>
                        <option <?php echo $codigo_postal_origen === $lugares['idl'] ? 'selected' : ''; ?> value="<?php echo $lugares['idl']; ?>"> <?php echo $lugares['nombre'] . "-" . $lugares['provincia']; ?>
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
                        <<option <?php echo $codigo_postal_destino === $lugares['idl'] ? 'selected' : ''; ?> value="<?php echo $lugares['idl']; ?>"> <?php echo $lugares['nombre'] . "-" . $lugares['provincia']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>



            <div class="col-md-6">
                <label for="inputZip" class="form-label">Distancia en kilómetros</label>
                <input type="number" class="form-control" name="kilometros" placeholder="" value="<?php echo $kilometros?>" required="" min=0>
            </div>
                <?php if($update == true){
                    echo "<div class='col-12'> <a class='btn btn-outline-primary' href='administracion.php'>Volver</a> <button type='submit'name='update' class='btn btn-info'>Update</button> </div>";
                    }else{
                    echo "<div class='col-12'> <a class='btn btn-outline-primary' href='administracion.php'>Volver</a> <button type='submit' name='submit' class='btn btn-primary'>Submit</button> </div>";
                    }          
                ?>
            </form>
        </blockquote>
    </div>
    </div>


    <table class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th scope="col">Descripción</th>
              <th scope="col">Origen</th>
              <th scope="col">Destino</th>
              <th scope="col">Distancia en kilómetros</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php

              



              // Tabla de rutas
            $rutas = getRutas();
            if(!empty($rutas)){
                foreach ($rutas as $value) {
                    $idr = $value['idr'];
                  
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
                        "<td>". $value['descripcion'] . "</td>".
                        "<td>". $origen['nombre'] . " -" . $origen['provincia'] . "</td>".
                        "<td>". $destino['nombre'] . " -" . $destino['provincia'] . "</td>".
                        "<td>". $value['kilometros'] . " Km". "</td>".
                        "<td>".                    
                            "<a href='vista_rutas.php?edit=$idr'class='btn btn btn-outline-success'>Editar</a>".
                            "<a href='php/acciones_rutas.php?delete=$idr'class='btn btn-outline-danger ml-1'>Borrar</a>".
                        "</td>".
                    "</tr>";
              }

            if(isset($_GET['msg'])){
                switch ($_GET['msg']){
                    case 1:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "No es posible eliminar la ruta porque está siendo utilizada en un viaje pendiente o en curso.".
                            "</div>";
                        break;
                    case 2:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "Ya existe una ruta con la descripción, lugar de origen y destino ingresada.".
                            "</div>";
                        break;
                    case 3:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "El lugar de origen y destino no pueden ser el mismo.".
                            "</div>";
                        break;
                    case 4:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "No es posible editar la ruta porque está siendo utilizada en un viaje pendiente o en curso".
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
<?php
	} catch (Exception $e){
			echo $e->getMessage();
	?>
		 <div class="body">
		 <br><br>		
			<a href="pagprincipal.php" > click aqui para volver a la pagina principal </a><br><br>	
			<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Click aqui para cerrar Sesion </a>
	</div>	 
        <div class= "div_foot">
		<p> Made by : Grupo 40 </p>
	</div>
		<?php	
	}
	?> 
</html>