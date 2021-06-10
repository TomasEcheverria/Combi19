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
    $usuario -> tipoUsuario ($tipo);
    $usuario ->nombre($nombre);
    $usuario ->apellido($apellido);
    $usuario ->email($email);
    $usuario ->DNI($DNI);
    $usuario ->contrasenia($contrasenia);
    if($tipo == "pasajero"){
        $usuario ->suscrito($suscrito);
        $usuario ->nro_tarjeta($nro_tarjeta);
        $usuario ->cod_seguridad($cod_Seguridad);
        $usuario ->fecha_vencimiento($fecha_vencimiento);
        $numero_de_tarjeta = "XXXX XXXX XX" . substr($nro_tarjeta,-2);
        $mes_tarjeta = substr($fecha_vencimiento,5,2);
        $anio_tarjeta = substr($fecha_vencimiento,0,4);
    };
    $usuario -> session ($usuarioID);



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

    //Se utiliza para mostrar los datos protegidos para el usuario, cuando se esta en modo edicion
    function mostrarDatosProtegidos(){
        if(modoActual() == "save"){echo "text";} else{echo "password";}
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
                    </button>".
                    "<button class='btn btn-sm btn-secondary float-right' name='volver1' type='submit'>
                    <i class='mdi mdi-gamepad-circle'></i> Volver</button>"
                    ;
                break;
            case "edit":
                echo "<button class='btn btn-sm btn-info float-right' name='edit' type='submit'>
                    <i class='mdi mdi-gamepad-circle' ></i> Editar
                    </button>".
                    "<button class='btn btn-sm btn-secondary float-right' name='volver_menu' type='submit'>
                    <i class='mdi mdi-gamepad-circle'></i> Volver</button>";
                break;
        }
    }
    

    // En caso de que este en modo edicion se muestra el valor de la tarjeta, caso contrario solo se muestran los ultimos 2 digitos
    function valorTarjeta($n_tarjeta,$tarjeta_mask){
        if(isset($_GET['md'])){
            switch ($_GET['md']){
                case "save":
                    echo $n_tarjeta;
                    break;
                case "edit":
                    echo $tarjeta_mask;
                    break;
            }
        } else{
            echo $tarjeta_mask;
        }
    }

    $edicion = modoInput();
    try{
        $usuario-> iniciada($usuarioID);
?>
<body>
<?php
            if(isset($_GET['md'])){
                switch ($_GET['md']){
                    case "save":
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> 
                        Usted se encuentra en modo edicion. 
                        </div>";
                        break;
                    }
            }

            if(isset($_GET['result'])){
                switch ($_GET['result']){
                    case 1:
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'> 
                        ¡Gracias por suscribirte a combi 19!
                        </div>";
                        break;
                    case 2:
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> 
                        ¡Te acabas de desuscribir!
                        </div>";
                        break;
                        case 3:
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'> 
                            Tus datos han sido guardados
                            </div>";
                            break;                    
                    }
            }
    ?>
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
                                            <label for="name"><?php if ($tipo == "chofer"){echo "Telefono:";} else {echo "DNI:";} ?></label>
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
                                <?php if($tipo == "pasajero" and $suscrito): ?>
                                    <div class="row my-4">
                                        <div class="col-sm-2">
                                                <label for="name">Numero Tarjeta:</label>
                                        </div>
                                        <div class="col-sm-10">
                                                <input class="form-control"  name="numero_tarjeta" type="text" value="<?php valorTarjeta($nro_tarjeta,$numero_de_tarjeta)?>" <?php echo "$edicion"?>>
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-sm-2">
                                                <label for="name">Codigo de seguridad:</label>
                                        </div>
                                        <div class="col-sm-10">
                                                <input class="form-control"  name="cod_seguridad" type="<?php mostrarDatosProtegidos()?>" value="<?php echo $cod_Seguridad?>" <?php echo "$edicion"?>>
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-sm-2">
                                                <label for="name">Fecha vencimiento tarjeta:</label>
                                        </div>
                                        <div class="col-sm-10">

                                                <?php if( modoActual() != "save"):?>
                                                    <input class="form-control" id="fecha"  name="fecha_vto_tarjeta"
                                                 type="<?php mostrarDatosProtegidos()?>" value="<?php echo $fecha_vencimiento?>" <?php echo "$edicion"?> maxlength="10">
                                                <?php else: ?>

                                                    <div class="row">
                                                        <div class="form-group col-sm-4">
                                                            <label for="ccmonth">Mes</label>
                                                            <select  name="mes_tarjeta" class="form-control" id="<?php echo $mes_tarjeta ?>">
                                                                <option value="1" <?php if($mes_tarjeta == 1){echo "selected";} ?>>1</option>
                                                                <option value="2" <?php if($mes_tarjeta == 2){echo "selected";} ?>>2</option>
                                                                <option value="3" <?php if($mes_tarjeta == 3){echo "selected";} ?>>3</option>
                                                                <option value="4" <?php if($mes_tarjeta == 4){echo "selected";} ?>>4</option>
                                                                <option value="5" <?php if($mes_tarjeta == 5){echo "selected";} ?>>5</option>
                                                                <option value="6" <?php if($mes_tarjeta == 6){echo "selected";} ?>>6</option>
                                                                <option value="7" <?php if($mes_tarjeta == 7){echo "selected";} ?>>7</option>
                                                                <option value="8" <?php if($mes_tarjeta == 8){echo "selected";} ?>>8</option>
                                                                <option value="9" <?php if($mes_tarjeta == 9){echo "selected";} ?>>9</option >
                                                                <option value="10" <?php if($mes_tarjeta == 10){echo "selected";} ?>>10</option >
                                                                <option value="11" <?php if($mes_tarjeta == 11){echo "selected";} ?>>11</option>
                                                                <option value="12" <?php if($mes_tarjeta == 12){echo "selected";} ?>>12</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-sm-4">
                                                            <label for="ccyear">Año</label>
                                                            <select  name="año_tarjeta" class="form-control">
                                                                <option value="2021" <?php if($anio_tarjeta == 2021){echo "selected";} ?>>2021</option>
                                                                <option value="2022" <?php if($anio_tarjeta == 2022){echo "selected";} ?>>2022</option>
                                                                <option value="2023" <?php if($anio_tarjeta == 2023){echo "selected";} ?>>2023</option>
                                                                <option value="2024" <?php if($anio_tarjeta == 2024){echo "selected";} ?>>2024</option>
                                                                <option value="2025" <?php if($anio_tarjeta == 2025){echo "selected";} ?>>2025</option>
                                                                <option value="2026" <?php if($anio_tarjeta == 2026){echo "selected";} ?>>2026</option>
                                                                <option value="2027" <?php if($anio_tarjeta == 2027){echo "selected";} ?>>2027</option>
                                                                <option value="2028" <?php if($anio_tarjeta == 2028){echo "selected";} ?>>2028</option>
                                                                <option value="2029" <?php if($anio_tarjeta == 2029){echo "selected";} ?>>2029</option>
                                                                <option value="2030" <?php if($anio_tarjeta == 2030){echo "selected";} ?>>2030</option>
                                                                <option value="2031" <?php if($anio_tarjeta == 2031){echo "selected";} ?>>2031</option>
                                                                <option value="2032" <?php if($anio_tarjeta == 2032){echo "selected";} ?>>2032</option>
                                                                <option value="2033" <?php if($anio_tarjeta == 2033){echo "selected";} ?>>2033</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                <?php endif; ?>
                                                  
                                        </div>
                                    </div>
                                <?php endif; ?>
                        </div>
                        <div class="card-footer">
                                    <div class="text-center">
                                        <div class="row-sm">
                                        <?php if($tipo =="pasajero"): ?>
                                                <?php if(!$suscrito): ?>
                                                        <button class="btn btn-sm btn-success float-right" name="suscribirse1" type="submit">
                                                            <i class="mdi mdi-gamepad-circle " ></i> Suscribirse
                                                        </button>

                                                <?php else: ?>
                                                        <button class="btn btn-sm btn-danger float-right" name="desuscribirse" type="submit" onclick="return confirmarDesuscripcion()">
                                                            <i class="mdi mdi-gamepad-circle "></i> Desuscribirse
                                                        </button>
                                                <?php endif; ?>
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

