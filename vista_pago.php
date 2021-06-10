<?php
    include 'BD.php';
    include 'php/acciones_ver_viaje.php';
    include 'php/classLogin.php';
    $usuario= new usuario();
	$usuario ->id($id);
	$usuario->suspendido($suspended);
    



	function getOrigen($idr){
        $db = conectar();
        $sql = "SELECT lo.* FROM lugares lo INNER JOIN rutas r ON (r.codigo_postal_origen=lo.idl) AND (lo.activo=1) AND (r.activo=1) AND (r.idr='$idr')";
        $result = mysqli_query($db,$sql);
        $data = $result->fetch_assoc();
        return $data;
    }

	function getDestino($idr){
        $db = conectar();
        $sql = "SELECT lo.* FROM lugares lo INNER JOIN rutas r ON (r.codigo_postal_destino=lo.idl) AND (lo.activo=1) AND (r.activo=1) AND (r.idr='$idr')";
        $result = mysqli_query($db,$sql);
        $data = $result->fetch_assoc();
        return $data;
    }

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

    function getArrayConsulta($sql){
        $db = conectar();
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
    <title>Vista de viaje</title>
        <!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" >
</head>
<?php try{ 
	$tipo_usuario = "";
	$usuario -> iniciada($id);
    if ($suspended != 0) {
		throw new Exception ('Usted esta actualmente restringido de comprar viajes');//verificar si realmente esta suspendido, y si lo esta indicarle cuando es que expira
	}
    ?>
<body>

	<?php
        $idp = $_GET['idp'];
        $pasaje_viaje = consulta("SELECT p.*, v.* FROM `pasajes` p INNER JOIN `viajes` v ON (v.idv=p.idv) AND (idp='$idp') AND (fantasma=1) ");
        $id_chofer= $pasaje_viaje['idc'];
        $info_combi= consulta("SELECT * FROM `combis` WHERE (idu='$id_chofer') AND (activo=1)");
        $origen = getOrigen($pasaje_viaje['idr']);
        $destino = getDestino($pasaje_viaje['idr']);
		$id_usuario="";
		$usuario -> id($id_usuario);
        $info_usuario = consulta("SELECT * FROM `usuarios` WHERE (id='$id_usuario') AND (activo=1)");
    ?>
	
    <div class="card">
		<div class="card-header text-center">
			<h4>Resumen del viaje.</h4>
		</div>
		<div class="card-body">
			<blockquote class="blockquote mb-0">
				<div class="mx-auto" style="width: 40rem;">
					
					<fieldset disabled>
						<div class="mb-3">
							<label for="disabledTextInput" class="form-label">Origen y Destino:</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php  echo $origen['provincia']."/".$origen['nombre']." - ".$destino['provincia']."/".$destino['nombre']  ?>">
						</div>
						<div class="mb-3">
							<label for="disabledTextInput" class="form-label">Fecha:</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php  echo $fecha  ?>">
						</div>
						<div class="mb-3">
							<label for="disabledTextInput" class="form-label">Hora:</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php  echo $hora  ?>">
						</div>
						<div class="mb-3">
							<label for="disabledTextInput" class="form-label">Tipo de Combi:</label>
							<input type="text" id="disabledTextInput" class="form-control" placeholder="<?php  echo $info_combi['tipo']  ?>">
						</div>
					</fieldset>
				</div>	  
			</blockquote>		
        </div>         

        <div class="card-header text-center">
			<h5>Resumen de pago.</h5>
		</div>   
        <div class="card-body">
			<blockquote class="blockquote mb-0">
				<div class="mx-auto" style="width: 40rem;">
                    <?php
                        $precio_viaje = $pasaje_viaje['precio'];
                        $info_pasajero = getArrayConsulta("SELECT * FROM `pasajeros` WHERE (idp='$idp') AND (activo=0)");
                        if(!empty($info_pasajero)){
                            foreach ($info_pasajero as $value) {
                                $nombre_p = $value['nombre'];
                                $apellido_p = $value['apellido'];
                                $dni = $value['dni'];
                                if (($dni == $info_usuario['DNI']) && ($info_usuario['suscrito'] == 1)){
                                    echo "Pasaje para".$nombre_p." ".$apellido_p." ".$precio_viaje*0.90." 10% de Descuento!";
                                    echo "<br>";
                                } else {
                                    echo "Pasaje para".$nombre_p." ".$apellido_p." ".$precio_viaje;
                                }
                            }
                        }
                    ?>
                    

				</div>
            </blockquote>
        </div>
    </div>


    

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