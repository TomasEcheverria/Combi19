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
		
        if (isset($_GET['msg'])){
            if ($_GET['msg']==1){
            ?>  <div class="text-center">
                <div class="alert alert-dismissible alert-warning">
                    <h4 class="alert-heading">Atención.</h4>
                    <p class="mb-0">El pasajero es sospechoso de covid-19, por lo que no es posible venderle un pasaje.</p>                    
                </div>
                <div class='col-12'> <a class='btn btn-outline-primary' href='pagprincipal.php'>Volver</a> </div>
                </div>
            <?php }
            if ($_GET['msg']==2){
                $linkv = "viaje.php?idv=".$idv
                ?>
                <div class="text-center">
                <div class="alert alert-dismissible alert-warning">
                    <h4 class="alert-heading">Atención.</h4>
                    <p class="mb-0">El pasajero es sospechoso de covid-19, por lo que no podrá realizar el viaje.</p>
                </div>
                <div class='col-12'> <a class='btn btn-outline-primary' href="<?php echo $linkv ?>">Volver</a> </div>
                </div>
                <?php  
            }
            if ($_GET['msg']==3){
                ?>
                <div class="text-center">
                <div class="alert alert-dismissible alert-success">
                    <h4 class="alert-heading">Atención.</h4>
                    <p class="mb-0">Se ha realizado exitosamente la compra del pasaje express.</p>
                </div>
                <div class='col-12'> <a class='btn btn-outline-primary' href="pagprincipal.php">Volver</a> </div>
                </div>
                <?php  
            }
        } else {

        $precio = $viaje_info['precio'];
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
            <input type="hidden" name="precio" value="<?php echo $precio ?>">
            <input type="hidden" name="id_pasajero" value="<?php echo $id_pasajero ?>">
            <div class='col-12'> <a class='btn btn-outline-primary' href='vista_busqueda.php'>Volver</a> <button type='submit' name='submit' class='btn btn-info'>Confirmar pago</button> </div>     
        </form>

        </div>
    </div>

    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
<?php
    }
	} catch (Exception $e){
			echo $e->getMessage();
	?>

		<?php	
	}
	?> 
</html>