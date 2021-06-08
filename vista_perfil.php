<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href= "css/bootstrap.min.css" media="all" >
    <script src="js/validacionTarjetaDeCredito.js"></script>
    <title>Datos del perfil</title>
</head>
<?php
    include 'php/classLogin.php';
    $usuario= new usuario();
    $usuario ->suscrito($suscrito);
    $usuario ->nombre($nombre);
    $usuario ->apellido($apellido);
    $usuario ->email($email);
    $usuario ->DNI($DNI);
    $usuario ->contrasenia($contrasenia);
    $usuario ->nro_tarjeta($nro_tarjeta);
    $usuario -> session ($usuarioID);
    $numero_de_tarjeta = "XXXX XXXX XX" . substr($nro_tarjeta,-2);

    // Para saber en que modo esta el boton de edicion
    function modoActual(){
        if(isset($_GET['md'])){
            switch ($_GET['md']){
                case "save":
                    return "save";
                    break;
                case "edit":
                    return "edit";
                    break;
            }
        } else{
            return "edit";
        }
    }

    // Para indicar al input si se puede editar o no
    function modoInput(){
        $modo = modoActual();
        if($modo == "edit"){
            return "readonly";
        }
    }

    // Devolvera el boton correspondiente para cuando se deba editar o guardar.
    function devolverBoton(){
        $modo = modoActual();
        switch ($modo){
            case "save":
                echo "<button class='btn btn-sm btn-warning float-right' name='save' type='submit'>
                    <i class='mdi mdi-gamepad-circle' ></i> Guardar
                    </button>";
                break;
            case "edit":
                echo "<button class='btn btn-sm btn-info float-right' name='edit' type='submit'>
                    <i class='mdi mdi-gamepad-circle' ></i> Editar
                    </button>";
                break;
        }
    }

    $edicion = modoInput();
    try{
        $usuario-> iniciada($usuarioID);
?>
<body>
    <div class="container-sm">
        <div class="padding">
            <div class="d-flex justify-content-center">
                <div class="col-sm-8">
                    <div class="card text-white bg-primary sm">
                        <div class="card-header text-center">
                            <strong>Datos de mi perfil </strong>
                        </div>
                        <div class="card-body">
                            <form name="formulario_suscripcion" action="php/acciones_suscripcion.php"  method= "POST">
                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">Nombre:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="nombre" type="text" value="<?php echo $nombre?>" <?php echo "$edicion"?>>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">Apellido:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="apellido" type="text" value="<?php echo $apellido?>" <?php echo "$edicion"?>>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">Email:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="email" type="text" value="<?php echo $email?>" <?php echo "$edicion"?>>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">DNI:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="dni" type="text" value="<?php echo $DNI?>" <?php echo "$edicion"?>>
                                    </div>
                                </div>

                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">Contraseña:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="clave" type="password" value="<?php echo $contrasenia?>" <?php echo "$edicion"?>>
                                    </div>
                                </div>
                                <?php if($suscrito): ?>
                                    <div class="row my-4">
                                        <div class="col-sm-2">
                                                <label for="name">Numero Tarjeta:</label>
                                        </div>
                                        <div class="col-sm-10">
                                                <input class="form-control"  name="numero_tarjeta" type="text" value="<?php echo $numero_de_tarjeta?>" readonly>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                        </div>
                        <div class="card-footer">
                                    <div class="text-center">
                                        <div class="row-sm">
                                                <?php if(!$suscrito): ?>
                                                        <button class="btn btn-sm btn-success float-right" name="suscribirse1" type="submit">
                                                            <i class="mdi mdi-gamepad-circle " ></i> Suscribirse
                                                        </button>
                                                <?php else: ?>
                                                        <button class="btn btn-sm btn-danger float-right" name="desuscribirse" type="submit">
                                                            <i class="mdi mdi-gamepad-circle "></i> Desuscribirse
                                                        </button>
                                                <?php endif; ?>
                                                <?php devolverBoton() ?>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>   
</body>
<?php
	} catch (Exception $e){
			echo $e->getMessage();
	?>
		 <div class="mensajes">
		 <br><br>		
			<a href="pagprincipal.php"  class=""> click aqui para volver a la pagina principal </a><br><br>	
			<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Click aqui para cerrar Sesion </a>
	</div>	 
		 <div class= "div_foot">
		<p> Made by : Grupo 40 </p>
	</div>
		<?php	
	}
	?> 
</html>
