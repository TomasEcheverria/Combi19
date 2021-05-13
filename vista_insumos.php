<!--Funcion para traer insumos de la BD -->
<?php
    include 'BD.php';
    include 'php/acciones_insumos.php';
    include 'php/classLogin.php';
    $usuario= new usuario();
    $usuario -> tipoUsuario($tipo);


    function getInsumos(){
        $db = conectar();
        $sql = "SELECT * FROM `insumos` WHERE activo = 1";
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
<!--Funcion para traer insumos de la BD -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Insumos</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" >
        <link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" >
</head>
<?php try{ 
    $usuario -> administrador($tipo);
    ?>
<body class="body">

    <div class="card border-primary mb-3">
    <div class="card-header text-center">
        <h3>Agregar Insumo</h3>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <form action ="php/acciones_insumos.php" class="row g-3" method ="POST">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="" value="<?php echo $nombre?>" required="">
            </div>
            <div class="col-md-6">
                <label for="inputZip" class="form-label">Inventario</label>
                <input type="text" class="form-control" name="inventario" placeholder="" value="<?php echo $inventario?>" required="">
            </div>
            <div class="col-12">
                <label for="inputZip" class="form-label">Precio</label>
                <input type="text" class="form-control" name="precio" placeholder="" value="<?php echo $precio?>" required="">
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


            <?php
              // Tabla de insumos
              $insumos = getInsumos();
              if(!empty($insumos)){ // Esto seguramente deberia ser una excepcion
                  // Se chequea que existan datos para mostrar
                  $tabla = "
                  <table class='table table-striped'>
                  <thead class='table-primary'>
                    <tr>
                      <th scope='col'>Nombre</th>
                      <th scope='col'>Inventario</th>
                      <th scope='col'>Precio</th>
                      <th scope='col'>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>                         
                  ";
                  $datos_tabla = "";
                foreach ($insumos as $value) {
                    $id = $value['idi'];
                    $datos_tabla = $datos_tabla . 
                    "<tr>".
                      "<td>". $value['nombre'] . "</td>".
                      "<td>". $value['inventario'] . "</td>".
                      "<td>". $value['precio'] . "</td>".
                      "<td>".                    
                        "<a href='vista_insumos.php?edit=$id'class='btn btn btn-outline-success'>Editar</a>".
                        "<a href='php/acciones_insumos.php?delete=$id'class='btn btn-outline-danger ml-1'>Borrar</a>".
                      "</td>".
                    "</tr>";
                }
                echo $tabla . $datos_tabla;
              } else echo "<p class='text-center fs-1 text-muted'> <strong> No hay datos para mostrar </strong> </p>";

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