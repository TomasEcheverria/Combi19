<!--Funcion para traer insumos de la BD -->
<?php
    include 'BD.php';
    include 'php/acciones_insumos.php';
    include 'php/classLogin.php';
    $usuario= new usuario();
    $usuario -> tipoUsuario($tipo);
    $usuario -> session ($usuarioID);
    $usuario -> id($id);
    $idChofer = $id;

    function getViajes($idChofer){
        $db = conectar();
        // Trae id del viaje, origen, destino, descripcion, fecha, hora e imprevisto.
        $sql = "SELECT v.idv, l1.nombre as origen, l2.nombre as destino, r.descripcion,v.fecha, v.hora, v.imprevisto FROM `viajes` v
        INNER JOIN usuarios u ON u.id = v.idc
        INNER  JOIN rutas r ON r.idr = v.idr
        INNER JOIN lugares l1 ON r.codigo_postal_origen = l1.idl
        INNER JOIN lugares l2 ON r.codigo_postal_destino = l2.idl
        WHERE v.estado <> 'pendiente' AND v.idc = $idChofer";
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
    <title>Vista de Imprevistos</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" >
        <link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" >
</head>
<?php try{ 
    $usuario-> iniciada($usuarioID);
    ?>
<body>

    <div class="container text-center">
        <h1>
            Imprevistos de mis viajes
        </h1>
    </div>
            <?php
              $viajes = getViajes($idChofer);
              if(!empty($viajes)): ?>
                  <table class='table table-striped table-sm p-2'>
                  <thead class='table-primary'>
                    <tr>
                      <th scope='col'>Origen</th>
                      <th scope='col'>Destino</th>
                      <th scope='col'>Descripcion</th>
                      <th scope='col'>Fecha</th>
                      <th scope='col'>Hora</th>
                      <th scope='col'>Imprevisto</th>
                    </tr>
                  </thead>
                  <tbody>                         
                <?php foreach ($viajes as $value): ?>
                    <?php
                        $id_viaje = $value['idv'];
                        $imprevisto = $value['imprevisto'];
                    ?> 
                    <tr id='tr_$id'>
                      <td> <?php echo $value['origen']; ?> </td>
                      <td> <?php echo $value['destino']; ?> </td>
                      <td> <?php echo $value['descripcion']; ?> </td>
                      <td> <?php echo $value['fecha']; ?> </td>
                      <td> <?php echo $value['hora']; ?> </td>
                      <td>                   
                         <button class='btn btn-success' type='button' data-bs-toggle='collapse' data-bs-target='#collapseExample<?php echo $id_viaje?>' aria-expanded='false' aria-controls='collapseExample'>
                            Ver Imprevisto
                        </button>
                      </td>
                    </tr>
                    <tr>
                        <td colspan='6' class='hiddenRow'> 
                            <div class='collapse' id='collapseExample<?php echo $id_viaje?>'>

                                <form action ="php/acciones_imprevistos.php" class="row p-2 seleccionada" method ="POST">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <div class="row-sm">
                                            <h5 class="form-label"> <strong> Detalle </strong> </h5>
                                        </div>
                                    <div class="row">

                                        <div class="col-9">
                                            <input type="text" class="form-control" name="nombre" placeholder="" value="<?php echo $imprevisto != "" ? $imprevisto : "No hay Imprevistos"; ?>" required="">
                                        </div>
                                        <div class="col-2">
                                            <button type='submit'name='update' class='btn btn-primary'>Update</button> </div>
                                        </div>

                                    </div>

                                </form>

                            </div>
                        </td>
                    </tr>
                <?php endforeach;?>
                <?php else: ?> 
                    <p class='text-center fs-1 text-muted'> <strong> No hay datos para mostrar </strong> </p>
                <?php endif; ?>
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