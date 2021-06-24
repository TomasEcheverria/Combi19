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
        $sql = "SELECT v.idv, l1.nombre as origen, l2.nombre as destino, r.descripcion,v.fecha, v.hora, v.imprevisto, v.estado_imprevisto FROM `viajes` v
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

    function getCollapseState($idRow){
        // Si se apreto el boton editar, refresca la pagina, mostrando el detalle correspondiente
         if(isset($_GET['upd']) and ($_GET['upd'] == $idRow)){
            echo "collapse show";
         } else {
            echo "collapse";
         }
    }

    function getInputState($idRow){
        // Si se apreto el boton editar, refresca la pagina, permite que se modifique el texto del imprevisto
         if(isset($_GET['upd']) and ($_GET['upd'] == $idRow)){
            echo "";
         } else {
            echo "disabled";
         }
    }

    function getTooltip($idRow){
        // Si se apreto el boton editar, refresca la pagina, permite que se modifique el texto del imprevisto
         if(isset($_GET['upd']) and ($_GET['upd'] == $idRow)){
            echo "<p class='text-danger'>Solo se pueden Ingresar hasta 50 caracteres</p>";
         } else {
            echo "";
         }
    }

    function getButton($idRow,$imprevisto){
        // Devuelve el boton correspondiente a lo que se quiera hacer
         if(isset($_GET['upd']) and ($_GET['upd'] == $idRow)){
            echo "<button type='submit'name='save' class='btn btn-warning'>Guardar</button>";
         }else{
            echo $imprevisto != "" ? "<button type='submit'name='update' class='btn btn-primary'>Editar</button>"
            :"<button type='submit'name='create' class='btn btn-success'>Crear</button>";
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
    <?php if(isset($_GET['sv'])){
        switch ($_GET['sv']){
            case 1:
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'> 
                <strong> El imprevisto Fue modificado con exito </strong> 
                </div>";
                break;
            case 0:
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> 
                <strong> El imprevisto Fue eliminado con exito </strong> 
                </div>";
                break;
        }
    } ?>
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
                        $estado_imprevisto = $value['estado_imprevisto'];
                    ?> 
                    <tr id='tr_$id'>
                      <td> <?php echo $value['origen']; ?> </td>
                      <td> <?php echo $value['destino']; ?> </td>
                      <td> <?php echo $value['descripcion']; ?> </td>
                      <td> <?php echo $value['fecha']; ?> </td>
                      <td> <?php echo $value['hora']; ?> </td>
                      <td>                   
                         <button class='btn btn-outline-info' type='button' data-bs-toggle='collapse' data-bs-target='#collapseExample<?php echo $id_viaje?>' aria-expanded='false' aria-controls='collapseExample'>
                            Ver Imprevisto
                        </button>
                      </td>
                    </tr>
                    <tr class="seleccionada">
                        <!-- Aca va el codigo de la fila oculta -->
                        <td colspan='6' class='hiddenRow'> 
                            <div class='<?php getCollapseState($id_viaje) ?>' id='collapseExample<?php echo $id_viaje?>'>

                            <?php if($estado_imprevisto != "resuelto"): ?>

                                <form action ="php/acciones_imprevistos.php" class="row p-2 seleccionada" method ="POST">
                                    <input type="hidden" name="id" value="<?php echo $id_viaje ?>">
                                    <div class="row-sm">
                                            <h5 class="form-label"> <strong> Detalle </strong> </h5>
                                        </div>
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="text" class="form-control"  name="detalle_imprevisto" placeholder="" maxlength="49" 
                                             value="<?php echo $imprevisto != "" ? $imprevisto : "No hay Imprevistos"; ?>"<?php getInputState($id_viaje) ?>>
                                            <?php getTooltip($id_viaje) ?>                                             
                                        </div>
                                        <div class="col-2">
                                            <?php getButton($id_viaje,$imprevisto) ?>
                                            <?php if($imprevisto != ""): ?>
                                                <button type='submit'name='delete' class='btn btn-danger'>Borrar</button>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </form>

                            <?php else: ?>
                                <div class="row-sm">
                                    <h5> 
                                        <strong> Detalle </strong>
                                    </h5>
                                    <h6 class="detalle-imprevisto"> 
                                        <?php echo $imprevisto; ?> 
                                    </h6>
                                </div>
                            <?php endif;?>

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