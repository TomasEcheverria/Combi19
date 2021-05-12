<?php
    include 'php/dbh.php';
    include 'php/choferes.php';
    include 'php/query_choferes.php';
    include __DIR__.'/php/alta_chofer.php';
    include 'php/classLogin.php';
    $usuario= new usuario();
    $usuario -> tipoUsuario($tipo); 
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Bienvenido a Combi 19</title>
  </head>
  <?php try{ 
    $usuario -> administrador($tipo);
    ?>
    
  <body>

  <div class="card">
    <div class="card-header text-center">
        <strong>Agregar Chofer</strong>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
      <!-- Formulario para agregar un chofer -->
        <form action ="php/alta_chofer.php" class="row g-3" method ="POST">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="firstName" placeholder="" value="<?php echo $nombre?>" required="">
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Apellido</label>
            <input type="text" class="form-control" name="lastName" placeholder="" value="<?php echo $apellido?>" required="">
          </div>
          <div class="col-12">
            <label for="inputAddress" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="" value="<?php echo $correo?>" required="">
          </div>
          <div class="col-md-2">
            <label for="inputZip" class="form-label">DNI</label>
            <input type="text" class="form-control" name="dni" placeholder="" value="<?php echo $dni?>" required="">
          </div>
          <div class="col-12">
            <label for="inputAddress2" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="" value="<?php echo $clave?>" required="">
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
              <th scope="col">Nombre</th>
              <th scope="col">Apellido</th>
              <th scope="col">Dni</th>
              <th scope="col">Correo</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // Tabla de choferes
                $choferes = new Chofer();
                $nombreChoferes = $choferes->showAllChoferes();

                //chequear si se trajeron datos
                if(!empty($nombreChoferes)){
                  foreach ($nombreChoferes as $value) {
                    $id = $value['id'];
                    echo 
                    "<tr>".
                      "<td>". $value['nombre'] . "</td>".
                      "<td>". $value['apellido'] . "</td>".
                      "<td>". $value['DNI'] . "</td>".
                      "<td>".$value['email'] . "</td>".
                      "<td>".                    
                        "<a href='vista_choferes.php?edit=$id'class='btn btn btn-outline-success'>Editar</a>".
                        "<a href='php/baja_chofer.php?delete=$id'class='btn btn-outline-danger ml-1'>Borrar</a>".
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
