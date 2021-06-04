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
                            <form name="formulario_suscripcion" action="php/acciones_perfil.php"  method= "POST">
                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">Nombre:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="name" type="text" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">Apellido:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="apellido" type="text" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">Email:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="email" type="text" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">DNI:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="dni" type="text" placeholder="Enter your name">
                                    </div>
                                </div>

                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">Contraseña:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="clave" type="text" placeholder="Enter your name">
                                    </div>
                                </div>

                                <div class="row my-4">
                                    <div class="col-sm-2">
                                            <label for="name">Numero Tarjeta:</label>
                                    </div>
                                    <div class="col-sm-10">
                                            <input class="form-control"  name="numero_tarjeta" type="text" placeholder="0000 0000 0000 0000">
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