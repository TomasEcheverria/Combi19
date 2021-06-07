<!--Funcion para traer combis de la BD -->
<?php
    include 'BD.php';
    include 'php/acciones_combis.php';
    $db = conectar();
    include 'php/classLogin.php';
    $usuario= new usuario();
    $usuario -> tipoUsuario($tipo2);

    //Consulta para obtener choferes
    $consulta_choferes = "SELECT * FROM usuarios WHERE activo=1 AND tipo_usuario = 'chofer' AND id NOT IN (SELECT idu FROM combis)";
    $resultado = mysqli_query($db, $consulta_choferes);




    function getCombis(){
        $db = conectar();
        $sql = "SELECT * FROM `usuarios` u INNER JOIN `combis` c ON (u.id=c.idu) WHERE c.activo=1 AND u.activo=1";
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
<!--Funcion para traer combis de la BD -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Combi</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<?php try{ 
    $usuario -> administrador($tipo2);
    ?>
<body>

    <div class="card">
    <div class="card-header text-center">
        <strong>Agregar Combi</strong>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <form action ="php/acciones_combis.php" class="row g-3" method ="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Patente</label>
                <input type="text" class="form-control" name="patente" placeholder="" value="<?php echo $patente?>" required="">
            </div>
            
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Cantidad de asientos</label>
                <input type="number" class="form-control" name="cantidad_asientos" placeholder="" value="<?php echo $cantidad_asientos?>" required="" min=1 max=99>
            </div>
            

            <div class="col-md-6">
                <label for="inputZip" class="form-label">Tipo</label>
                <select name="tipo" class="form-select" required>
                    <option value="">--Seleccione--</option>
                    <option <?php echo $tipo == "Comoda" ? 'selected' :''; ?> value="Comoda">Comoda</option>
                    <option <?php echo $tipo == "Super Comoda" ? 'selected' :''; ?> value="Super Comoda">Super Comoda</option>
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="inputZip" class="form-label">Modelo</label>
                <input type="text" class="form-control" name="modelo" placeholder="" value="<?php echo $modelo?>" required="">
            </div>

            
            <?php
            // Consulta super parchada para que al momento de editar, figure a demás de todos los conductores, el conductor seleccionado
            $sql2 = "SELECT * FROM `usuarios` u INNER JOIN `combis` c ON (u.id=c.idu) WHERE c.activo=1 AND u.activo=1 AND u.id='$idu'";
            $result2 = mysqli_query($db,$sql2);
            ?>

            <div class="col-md-6">
                <label for="inputZip" class="form-label">Chofer</label>
                <select name="idu" class="form-select" required>
                    <option value="">--Seleccione--</option>
                    <?php while ($mismo_chofer = mysqli_fetch_assoc($result2) ) : ?>
                        <option <?php echo $idu === $mismo_chofer['id'] ? 'selected' : ''; ?> value="<?php echo $mismo_chofer['id']; ?>"> <?php echo $mismo_chofer['nombre'] . " " . $mismo_chofer['apellido']; ?>
                        </option>
                    <?php endwhile; ?>
                    <?php while ($choferes = mysqli_fetch_assoc($resultado) ) : ?>
                        <option value="<?php echo $choferes['id']; ?>"> <?php echo $choferes['nombre'] . " " . $choferes['apellido']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
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
              <th scope="col">Patente</th>
              <th scope="col">Cantidad de asientos</th>
              <th scope="col">Tipo</th>
              <th scope="col">Modelo</th>
              <th scope="col">Chofer</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php
            
            // Tabla de Combis
            $combis = getCombis();
            if(!empty($combis)){
                foreach ($combis as $value) {
                    $idc = $value['idc'];
                    echo 
                    "<tr>".
                        "<td>". $value['patente'] . "</td>".
                        "<td>". $value['cantidad_asientos'] . "</td>".
                        "<td>". $value['tipo'] . "</td>".
                        "<td>". $value['modelo'] . "</td>".
                        "<td>". $value['nombre'] . " " . $value['apellido'] . " " . $value['DNI'] . "</td>".
                        "<td>".                    
                            "<a href='vista_combis.php?edit=$idc'class='btn btn btn-outline-success'>Editar</a>".
                            "<a href='php/acciones_combis.php?delete=$idc'class='btn btn-outline-danger ml-1'>Borrar</a>".
                        "</td>".
                    "</tr>";
                }
            }
            if(isset($_GET['msg'])){
                switch ($_GET['msg']){
                    case 1:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "No es posible eliminar la combi porque esta siendo utilizada en un viaje pendiente o en curso".
                            "</div>";
                        break;
                    case 2:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "No es posible editar la combi porque esta siendo utilizada en un viaje pendiente o en curso".
                            "</div>";
                        break;
                    case 3:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "La patente ingresada ya esta siendo usada por una combi.".
                            "</div>";
                        break;
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