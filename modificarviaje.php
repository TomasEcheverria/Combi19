<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario ->id($id);
    $usuario -> tipoUsuario($tipo);
    $idviaje = $_GET['idv']
?>
<html>
<head>
	<title>Combi 19 </title>
	<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" > 
<script language="JavaScript" type="text/javascript" src ="js/validacionEditar.js"> </script>
<script  src= "js/menu.js"></script>
<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
</head>
 <?php 
    try {
    	$usuario -> administrador($tipo);
         $query50 ="SELECT * FROM viajes  WHERE idv='$idviaje'";
        $result50=mysqli_query ($link, $query50) or die ('Consulta query50 fallida: ' .mysqli_error($link));
        $datos=(mysqli_fetch_array($result50)); 
       
        $idc =$datos['idc'];
        $query51 ="SELECT email FROM usuarios WHERE id='$datos[idc]'";
        $result51=mysqli_query ($link, $query51) or die ('Consulta query51 fallida: ' .mysqli_error($link));
        $chofer=(mysqli_fetch_array($result51)); 
		
        $query52 ="SELECT codigo_ruta FROM rutas WHERE idr='$datos[idr]'";
        $result52=mysqli_query ($link, $query52) or die ('Consulta query51 fallida: ' .mysqli_error($link));
        $ruta=(mysqli_fetch_array($result52)); 
        if (isset ($_GET['error'])){
			$error=$_GET['error'];
		}
  ?>
<body class="body" id="div_body" >
	<div class="div_body">
		<div class="div_superior"  > 
				 <a class = "div_superior" href="pagprincipal.php" >  
				<p> Combi 19 <img src="css/images/muro.jpg" class="div_icono">	
				</a></p>
			</div>
             <?php echo menu($tipo);?>
             <p> Modificacion del viaje <?php echo $idviaje?>
		<div class=div_registro>
			<p> Escriba solo los campos que desea modificar</p>
			<?php
		if (isset ($_GET['mensajeEditar'])){
			$mensaje = $_GET['mensajeEditar'];
			echo $mensaje;
		}
			?>
		<div class= "div_editar">
		<form name="editarviaje" method="post" action="php/editarviaje.php" enctype="multipart/form-data">
			   <h2>Editar Viaje</h2>
			   <p> Numero de viaje </p>
               <input type="hidden"  name="viaje"   value=<?php  echo $idviaje ?> ></input>
               <input type="number"  name="nro_viaje"  placeholder="Numero de viaje" size=50 autofocus   value=<?php echo $datos['nro_viaje']; ?> ></input><br><br>           
			   <p> imprevisto </p>
			   <input type="text"  name="imprevisto"  placeholder="imprevisto" size=50 autofocus   value=<?php echo $datos['imprevisto']; ?> ></input><br><br>    
			   <p> email del conductor </p>
			   <input type="text"  name="email"  placeholder="Chofer email" size=50 autofocus   value=<?php echo $chofer['email']; ?> ></input><br><br>    
               <p> codigo de ruta </p>
			   <input type="text"  name="codigo"  placeholder="Codigo ruta" size=50 autofocus   value=<?php echo $ruta['codigo_ruta']; ?> ></input><br><br>
			   <input type="button" value="Editar" class="btn_editar" onclick = "validacionesviaje()">
              </form>
              </div>
            <div class= "div_foot">
			<p> Made by : Grupo 40
			</p>
		</div> 
		</div>
	</body>
	    <?php
           } catch (Exception $e) {
           	   $mensaje=$e->getMessage();
               header ("Location: index.php?mensaje=$mensaje");	
    }  
    ?>
</body>
</html>