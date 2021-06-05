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
    <title>Suscribete a combi19</title>
</head>
<?php
    include 'php/classLogin.php';
    $usuario= new usuario();
    $usuario ->suscrito($suscrito);
?>

<body>
    <div class="container-sm">
        <div class="padding">
            <div class="row">
                <div class="col-sm">
                    <div class="card text-white bg-primary sm">
                        <div class="card-header text-center">
                            <strong>Tarjeta de Crédito </strong>
                            <small>Ingresa los datos de tu tarjeta</small>
                        </div>
                        <div class="card-body">
                            <form name="formulario_suscripcion" action="php/acciones_suscripcion.php"  method= "POST">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input class="form-control" name="name" type="text" placeholder="Enter your name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="ccnumber">Numero de tarjeta</label>
                                            <div class="input-group">
                                                <input class="form-control" type="text" name="numero_tarjeta" placeholder="0000 0000 0000 0000">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="ccmonth">Mes</label>
                                        <select  name="mes" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="ccyear">Año</label>
                                        <select  name="año" class="form-control">
                                            <option value="2014">2014</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="cvv">CVV/CVC</label>
                                            <input class="form-control" name="numero_cvv" id="cvv" type="text" placeholder="123">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center">
                                        <div class="row-sm">
                                            <!-- Boton de desuscribirse en caso de ya estar suscrito-->
                                            <?php if($suscrito): ?>
                                                    <button class="btn btn-sm btn-danger float-right" name="desuscribirse" type="submit">
                                                        <i class="mdi mdi-gamepad-circle " name="<?php echo $suscrito ?>"></i> Desuscribirse
                                                    </button>
                                            <?php else: ?>
                                                <button class="btn btn-sm btn-success float-right" name="suscribirse" type="submit" onclick="validarTarjetaDeCredito()">
                                                    <i class="mdi mdi-gamepad-circle" name="<?php echo $suscrito ?>" ></i> Suscribirse
                                                </button>
                                            <?php endif; ?>
                                            <!-- Boton de desuscribirse en caso de ya estar suscrito-->
                                                <button class="btn btn-sm btn-secondary float-right" name="volver" type="submit">
                                                <i class="mdi mdi-gamepad-circle"></i> Volver</button>
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
</html>
