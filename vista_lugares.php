<!--Funcion para traer lugares de la BD -->
<?php
    include 'BD.php';
    include 'php/acciones_lugares.php';
    include 'php/classLogin.php';
    $usuario= new usuario();
    $usuario -> tipoUsuario($tipo);


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
<?php try{ 
    $usuario -> administrador($tipo);
    ?>
<body>

    <div class="card">
    <div class="card-header text-center">
        <strong>Agregar lugar</strong>
    </div>
    <div class="card-body">


        
        <blockquote class="blockquote mb-0">
        
        <form action ="php/acciones_lugares.php" method ="POST">
        <?php if(!isset($_GET['add'])){ ?>
            <?php
            // Consulta super parchada para que al momento de editar, figure a demás de todos los conductores, el conductor seleccionado
            $sql2 = "SELECT DISTINCT `provincia`  FROM `lugares` WHERE activo=1 ORDER BY `provincia`ASC";
            $result2 = mysqli_query($db,$sql2);
            ?>
            
                <div class="col-md-3">
                    <label for="inputZip" class="form-label">Provincia</label>
                    <select name="provincia" class="form-select" required>
                        <option value="">--Seleccione--</option>
                        <?php while ($provincias = mysqli_fetch_assoc($result2) ) : ?>
                                <option <?php echo $provincia === $provincias['provincia'] ? 'selected' : ''; ?> value="<?php echo $provincias['provincia']; ?>"> <?php echo $provincias['provincia']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                    <?php if(!isset($_GET['edit'])){?>
                    <button type="button" class="btn btn-link">
                        <a href='vista_lugares.php?add'  >Agregar nueva</a>    
                    </button>
                    <?php }else { 
                        echo "<button type='button' class='btn btn-link'>" .
                        "<a href='vista_lugares.php?add&edit=$id' >Agregar nueva</a>" .
                        "</button>";
                     } ?>
                </div>
                
            <?php }else{ ?>

                
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Provincia</label>
                    <input type="text" class="form-control" name="provincia" placeholder="" value="<?php echo $provincia?>" required="">
                    
                </div>
                <?php if(!isset($_GET['edit'])){?>
                    <button type="button" class="btn btn-link">
                        <a href='vista_lugares.php?add'  >Volver a selección</a>    
                    </button>
                    <?php }else { 
                        echo "<button type='button' class='btn btn-link'>" .
                        "<a href='vista_lugares.php?edit=$id'  >Volver a selección</a>" .
                        "</button>";
                     } ?>
                
                
                
                <br>

            <?php } ?>

                <br>
                <div class="col-md-3">
                    <label for="inputZip" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="" value="<?php echo $nombre?>" required="">
                    <br>
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
              <th scope="col">Provincia</th>
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
                        "<td>". $value['provincia'] . "</td>".
                        "<td>". $value['nombre'] . "</td>".
                        "<td>".                    
                            "<a href='vista_lugares.php?edit=$idl'class='btn btn btn-outline-success'>Editar</a>".
                            "<a href='php/acciones_lugares.php?delete=$idl'class='btn btn-outline-danger ml-1'>Borrar</a>".
                        "</td>".
                    "</tr>";
                }
            }
            if(isset($_GET['msg'])){
                switch ($_GET['msg']){
                    case 1:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "No es posible eliminar el lugar seleccionado porque está siendo utilizado en una ruta.".
                            "</div>";
                        break;
                    case 2:
                        echo "<div class='alert alert-dismissible alert-warning'>". 
                            "Ya existe un lugar con el nombre y provincia ingresados.".
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