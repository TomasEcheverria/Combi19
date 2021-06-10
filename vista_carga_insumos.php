<?php

    //variables POST


    include 'BD.php';
    include 'php/acciones_carga_insumos.php';
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
    function getInsumos(){
        $db = conectar();
        $sql = "SELECT * FROM `insumos` WHERE (inventario>0) AND (activo=1)";
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
<!--Funciones para traer información de la BD -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Insumos</title>
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
        $idp = $_GET['idp'];
    ?>
	
    <div class="card">
    
		<div class="card-header text-center">
			<h4>Selección de Insumos
		</div>
        <div class="mx-auto" style="width: 40rem;">
        <form action ="php/acciones_carga_insumos.php" method ="POST">	

            <?php 
                $insumos = getInsumos();
                if(!empty($insumos)){
                    foreach ($insumos as $value) {
                        $idi = $value['idi'];
                        $nombre = $value['nombre'];
                        $inventario = $value['inventario'];
                        $precio = $value['precio'];

            ?>
                
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <div class="mx-auto" style="width: 40rem;">	

                                <input type="checkbox" onclick="var input = document.getElementById('<?php echo $idi?>'); if(this.checked){ input.disabled = false; input.focus();}else{input.disabled=true;}" /><?php echo $nombre.". $".$precio ?>   
								    <input type="number" class="form-control" name="<?php echo $idi?>" value="" min=1 max=<?php echo $inventario ?> id="<?php echo $idi?>"  disabled="disabled" required="" placeholder="<?php echo "Disponibles ".$inventario ?>"/>
     
                            </div>	  
                        </blockquote>
                    </div>
            <?php 
                    }
                } else {
                    echo "<h2 class='text-center'>Lo sentimos. No hay insumos disponibles para mostrar.";
                }
            ?>

            <input type="hidden" name="idp" value="<?php echo $idp ?>">
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