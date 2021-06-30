<?php

    //variables POST


    include 'BD.php';
    include 'php/acciones_formulario.php';
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
    ?>
	
    <div class="card">
		<div class="card-header text-center">
			<h4>Formulario: Síntomas de Covid-19 </h4>
		</div>
        <div class="mx-auto" style="width: 40rem;">
        <form action ="php/acciones_formulario.php" method ="POST">	
            <?php
            $dni = $_GET['d'];?>
            
                <div class="card-body">
                    <h4> El pasajero presenta:</h4> <br> <br>
                    <blockquote class="blockquote mb-0">
                        <div class="mx-auto" style="width: 40rem;">	
                            <div class="form-group">
                                <div class="card border-primary mb-3" style="max-width: 30rem;">
                                <div class="form-check form-check-inline">
                                    <h4>Temperatura mayor a 37°C.</h4>
                                    <input class="form-check-input" type="radio" name="temperatura" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="temperatura" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="card border-primary mb-3" style="max-width: 30rem;">
                                <div class="form-check form-check-inline">
                                    <h4>Pérdida de gusto u olfato.</h4>
                                    <input class="form-check-input" type="radio" name="olfato" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="olfato" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="card border-primary mb-3" style="max-width: 30rem;">
                                <div class="form-check form-check-inline">
                                    <h4>Alguna clase de afección respiratoria.</h4>
                                    <input class="form-check-input" type="radio" name="afeccion" id="inlineRadio3" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="afeccion" id="inlineRadio4" value="0">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="card border-primary mb-3" style="max-width: 30rem;">
                                <div class="form-check form-check-inline">
                                    <h4>Dolor de garganta.</h4>
                                    <input class="form-check-input" type="radio" name="garganta" id="inlineRadio5" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="garganta" id="inlineRadio6" value="0">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>	  
                    </blockquote>
                </div>
                
            
            <input type="hidden" name="dni" value="<?php echo $dni ?>">
            
            <?php 
            if (isset($_GET['express'])){ ?>
                <input type="hidden" name="express" value="1">
            <?php } else{ ?>
                <input type="hidden" name="idpasajero" value="<?php echo $_GET['idpasajero'] ?>">
            <?php } ?>
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