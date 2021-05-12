<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario ->id($id);
    $usuario -> tipoUsuario($tipo);
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
		<div class=div_registro>
			<?php
		if (isset ($_GET['mensajeEditar'])){
			$mensaje = $_GET['mensajeEditar'];
			echo $mensaje;
		}
			?>
		<div class= "div_editar">
		<form name="publicarviaje" method="post" action="php/publicarviaje.php" enctype="multipart/form-data">
			   <h2>Publicar viaje</h2>
			   <p> Numero de viaje </p>
               
               <input type="number"  name="nro_viaje"  placeholder="Numero de viaje" size=50 autofocus    ></input><br><br>           
			   <p> imprevisto </p>   
			   <p> email del conductor </p>
			   <input type="text"  name="email"  placeholder="Chofer email" size=50 autofocus    ></input><br><br>    
               <p> codigo de ruta </p>
			   <input type="text"  name="codigo"  placeholder="Codigo ruta" size=50 autofocus    ></input><br><br>
			   <input type="button" value="Editar" class="btn_editar" onclick = "altaviaje()">
              </form>
              </div>
            <div class= "div_foot">
			<p> Made by : Grupo 40
			</p>
		</div> 
		</div>
	</body>
	<?php
	} catch (Exception $e){
			echo $e->getMessage();
	?>
		 <br><br>		
			<a href="pagprincipal.php" > Click aqui para volver a la pagina principal </a><br><br>	
			<a href="php/cerrarSesion.php" onclick="return SubmitForm(this.form)" value="Eliminar"> Click aqui para cerrar Sesion </a>
		<div class= "div_foot">
		<p> Made by : Grupo 40 </p>
	</div>
		<?php	
	}
	?> 
</body>
</html>