<?php
    include '../includes/dbh.php';
    include '../includes/choferes.php';
    include '../includes/query_choferes.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <ul class="list-group list-group-flush">
  <?php
      $choferes = new Chofer();
      $nombreChoferes = $choferes->showAllChoferes();
    foreach ($nombreChoferes as $key => $value) {
        echo "<li class='list-group-item'>". $value . "</li>";
    }
    ?>
</ul>
<form action ="../includes/alta_chofer.php" class="row g-3" method ="POST">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="firstName" placeholder="" value="" required="">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Apellido</label>
    <input type="text" class="form-control" name="lastName" placeholder="" value="" required="">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Email</label>
    <input type="email" class="form-control" name="email">
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">DNI</label>
    <input type="text" class="form-control" name="dni">
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Contraseña</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>
