<?php

    //variables POST


    include 'BD.php';
    include 'php/acciones_compra_express.php';
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
    <title>Vista Formulario</title>
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
        $viaje_info = consulta("SELECT * FROM `viajes` WHERE (idc='$id_usuario') AND (activo=1) AND (estado='en curso')");
        $idv = $viaje_info['idv'];
        $dni = $_GET['d'];
        $pasajero_info = consulta("SELECT * FROM `usuarios` WHERE (dni='$dni') AND (activo=1)");
        $id_pasajero = $pasajero_info['id'];
    ?>
	
    <div class="card">
		<div class="card-header text-center">
			<h4>Compra express del pasaje</h4>
		</div>
        <div class="mx-auto" style="width: 40rem;">
        <form action ="php/acciones_compra_express.php" method ="POST">	

                
                <div class="card-body">
                    <?php echo "<h3> Importe a recibir: $".$viaje_info['precio']."<br>"; ?>
                </div>
            
            <input type="hidden" name="idv" value="<?php echo $idv ?>">
            <input type="hidden" name="id_pasajero" value="<?php echo $id_pasajero ?>">
            <div class='col-12'> <a class='btn btn-outline-primary' href='vista_busqueda.php'>Volver</a> <button type='submit' name='submit' class='btn btn-info'>Confirmar pago</button> </div>
        
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