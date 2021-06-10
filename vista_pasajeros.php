<?php

    //variables POST


    include 'BD.php';
    include 'php/acciones_pasajeros.php';
    include 'php/classLogin.php';
    $usuario= new usuario();

    

	function cantidadTablas($cons){
		$db = conectar();
        $result = mysqli_query($db,$cons);
        $numRows = $result->num_rows;
        return $numRows;
	}

	function consulta($cons){
		$db = conectar();
		$result = mysqli_query($db, $cons);
		$data = $result->fetch_assoc();
		return $data;
	}
?>
<!--Funcion para traer lugares de la BD -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de pasajeros</title>
        <!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" >
</head>
<?php  try{ 
	$tipo_usuario = "";
	$usuario -> tipoUsuario($tipo_usuario);
	if ($tipo_usuario == ""){
		throw new Exception('Debe iniciar sesión antes de realizar esa acción.');
	}
	
    ?>
<body>

	<?php
		$id_usuario="";
		$usuario -> id($id_usuario);
    ?>
	
    <div class="card">
		<div class="card-header text-center">
			<h4>Ingrese la siguiente información de los pasajes extras:
		</div>
        <div class="mx-auto" style="width: 40rem;">
        <form action ="php/acciones_pasajeros.php" method ="POST">	
            <?php
            $idp = $_GET['idp'];
            $cantidad_asientos = $_GET['ca'];
            for ($i=1; $i<=$cantidad_asientos; $i++){ ?>
            
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <div class="mx-auto" style="width: 40rem;">	
                            <div class="form-group">
                                <label class="col-form-label mt-4" for="inputDefault">Nombre</label>
                                <input type="text" name="<?php echo "nombre".$i; ?>" value="" class="form-control" placeholder="" required="">
                            </div>

                            <div class="form-group">
                                <label class="col-form-label mt-4" for="inputDefault">Apellido</label>
                                <input type="text" name="<?php echo "apellido".$i; ?>" value="" class="form-control" placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label mt-4" for="inputDefault">DNI</label>
                                <input type="text" name="<?php echo "dni".$i; ?>" value="" class="form-control" placeholder="" required="">
                            </div>
                        </div>	  
                    </blockquote>
                </div>
                
            <?php }?>
            
            <input type="hidden" name="idp" value="<?php echo $idp ?>">
            <input type="hidden" name="cantidad_asientos" value="<?php echo $cantidad_asientos ?>">
            <div class='col-12'> <a class='btn btn-outline-primary' href='vista_busqueda.php'>Volver</a> <button type='submit' name='submit' class='btn btn-info'>Siguiente</button> </div>
            

        </form> 	
        </div>
    </div>


    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
<?php
	} catch (Exception $e){
			echo $e->getMessage();
	?>

		<?php	
	}
	?> 
</html>