<?php
	include "BD.php";// conectar y seleccionar la base de datos
	$link = conectar();
    include "php/classLogin.php";
    include "menu.php";
	$usuario= new usuario();
	$usuario -> session ($usuarioID);
	$usuario -> id($id);
?>
<html>
	<head>
		<title>
			The Wall
		</title>
		<link rel="stylesheet" type="text/css" href= "css/Estilos.css" media="all" > 
		<script  src= "js/menu.js"></script>
		<script type="text/javascript" src="js/confirmarCerrarSesion.js"></script>
		<script type="text/javascript" src="js/validacionMensaje.js"></script>
	</head>
 <?php 
    try {
    	$usuario -> iniciada($usuarioID);
 
 
  ?>
	<body class = "body" >
		<div class="div_body" id="div_body">
        <div class="div_superior" >
			 <a class = "div_superior" href="pagprincipal.php" >  
				<p> The Wall <img src="css/images/muro.jpg" class="div_icono">	
				</a></p>
			</div>
			<?php echo menu($id); ?>
			<div class="escribir">		
		<form   name="mensaje" action="php/publicacion.php?tipo=1" method="post" enctype="multipart/form-data">	
			<textarea  name="publicacion" placeholder="Escribir Mensaje" cols="50" rows="10" maxlength="140"></textarea>
			<input name="imagen" type="file"  class="btn_buscar" ><br>
			<input type="button"  value="publicar" class="btn_buscar" onclick="validacion()"></button>
		</div>
		</form>
		<div class= "div_superior">
			<p>  </p>
				<p> Mensajes</p>
			</div>
			<div class= "div_listadomensajes">
		   <?php 
		   		 $seguidores="SELECT * FROM siguiendo WHERE usuarios_id='$id'";
		         $r=mysqli_query ($link, $seguidores) or die ('Consulta seguidores fallida: ' .mysqli_error($link));
		         $totalM=0;  
		         while($res_seg=mysqli_fetch_array ($r)){
		         	$idSeguido=$res_seg['usuarioseguido_id'] ; 
		         	$consulta="SELECT COUNT(*) as total FROM mensaje WHERE usuarios_id='$idSeguido'";
       			    $resultado = mysqli_query ($link, $consulta) or die ('Consulta query fallida: ' .mysqli_error($link));
       			    $res_mensajes=mysqli_fetch_array ($resultado);
			        $total=$res_mensajes['total'];
			        $totalM=$totalM+$total;
		         }

			    $cantMostrar=10;
              
			    if(empty($_GET['pagina'])){
			    	$pagina=1;
			    }
			    else{
			    	$pagina=$_GET['pagina'];
			    }

			    $desde=($pagina-1)*$cantMostrar;
			    $totalPags=ceil($totalM / $cantMostrar); 
			    $consulta1="SELECT * FROM mensaje WHERE usuarios_id= ANY (SELECT usuarioseguido_id FROM siguiendo WHERE siguiendo.usuarios_id = '$id' ) ORDER BY fechayhora DESC LIMIT $desde,$cantMostrar ";
				 $resultado1 = mysqli_query ($link, $consulta1) or die ('Consulta query fallida: ' .mysqli_error($link));
				 $result=mysqli_num_rows($resultado1);
				 if($result>0){
			        while($datosM=mysqli_fetch_array ($resultado1)){// datos de los mensajes
			    	     $cons="SELECT * FROM usuarios WHERE id='$datosM[usuarios_id]'";
                    	 $res= mysqli_query ($link, $cons) or die ('Consulta query fallida: ' .mysqli_error($link));
                         $datosU=mysqli_fetch_array ($res);
                         $idImagen=$datosU['id']; ?>
			             <div class = "div_mensaje">
				              <div class = "div_img_usuario">
					             <a href="usuario.php?idu=<?php echo $datosM['usuarios_id']?>">
					                 <img src="php/mostrarimagen.php?id=<?php echo $idImagen ?>&tipo=1"  class="div_img_usuario_mensaje"/>
				     	         </a>
				              </div>
				 <?php if($datosM['usuarios_id']==$id){ 

				 	?>

				  <form  action="php/borrarMensaje.php" method="post">    
				              <button name="borrar" class="btn_borarr_mensaje"  onclick="return SubmitForm(this.form)" value="Eliminar">Borrar mensaje</button>
				              <input type="hidden" name="id" value="<?php echo $datosM['id']; ?>" />
				       
				         </form>
				   <?php
				   }
				   else{
				    ?>
				   		<form  action="php/seguir.php" method="post">    
				              <button name="seguir" class="btn_borarr_mensaje" onclick="return SubmitForm(this.form)" value="Eliminar"><?php $seguidorid=$datosM['usuarios_id'];
							  $query40=("SELECT * FROM siguiendo WHERE usuarios_id='$id' and usuarioseguido_id='$seguidorid'");
							 $result40 = mysqli_query ($link, $query40) or die ('Consulta query40 fallida: ' .mysqli_error($link));
							 $rows=mysqli_num_rows($result40);
							 $mesage='';
							 if($rows ==1 ){
								 $mesage='Dejar de seguir';
								 echo $mesage;
							 }else{
								$mesage='Seguir';
								echo $mesage;} ?></button>
				              <input type="hidden" name="id" value="<?php echo $id ?>" />
				              <input type="hidden" name="idSeguir" value="<?php echo $datosM['usuarios_id']; ?>" />
							  <input type="hidden" name="pagina" value="0" />
				         </form>

				  <?php } ?>
				<div class="div_info_mensaje">
					<a class="div_info_usuario" href="usuario.php?idu=<?php echo$datosM['usuarios_id']?>">
					<span> <?php echo $datosU['nombreusuario']; ?> </span> 
					</a>
					<span> <?php echo $datosM['fechayhora']; ?></span>  &nbsp;
					 <form action="php/megusta.php" method="post">
					             <button name="mg" class="btn_buscar"><?php $idm=$datosM['id'];
								 $query60= ("SELECT  * FROM me_gusta WHERE usuarios_id='$id' and mensaje_id='$idm'");
								$result60 = mysqli_query ($link, $query60) or die ('Consulta query60 fallida: ' .mysqli_error($link));
								$row=mysqli_num_rows($result60);
								$mensaje='';
								if($row== 1){
									$mensaje='No me  gusta';
								echo $mensaje;
								}else{
								$mensaje='Me gusta';
								echo $mensaje;}?></button>  &nbsp;
					             <input type="hidden" name="idM" value="<?php echo$datosM['id']; ?>" />
					             <input type="hidden" name="idU" value="<?php echo$id; ?>" />
								 <input type="hidden" name="pagina" value="0" />
							  <input type="hidden" name="numero" value="<?php echo$pagina ?>" />
					         </form>
					          <?php $query="SELECT * FROM me_gusta WHERE mensaje_id='$datosM[id]'";
					         $resul=mysqli_query($link,$query) or die ('Consulta query fallida: ' .mysqli_error($link));
					         $row=mysqli_num_rows($resul);
					         ?> 
					<p> Likes:<?php  echo $row; ?></p>
					<div  class="div_textomensaje">
						<p> <?php echo $datosM['texto'];  ?></p>
				    </div>
				    <?php if ($datosM['imagen_contenido']!=null){ $idImg=$datosM['id'];		?>

							     <img src="php/mostrarimagen.php?id=<?php echo $idImg ?>&tipo=2"class="div_img_mensaje"/> 
                              <?php   
                              }
                              ?>					
			   </div>
			</div>
			<?php } 
		}?>
			</div>
        <div class="div_paginado">
        	<ul>
        		
        		<?php if ($pagina !=1   ) {?>
              		<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
        		    <li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
        		<?php } ?>
                <?php  
                  for ($i=1; $i <= $totalPags; $i++) { 
                  	  
                    	if($i==$pagina){
                  	    	echo '<li class="pagSeleccionada">'.$i.'</li>';
                  	     }else{
                  	        echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                         }
                  }
                ?>
                <?php if ($pagina!=$totalPags )  {?>

                        <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
        		        <li><a href="?pagina=<?php echo $totalPags; ?>">>|</a></li>
                <?php } ?>
        	</ul>
        </div>
	</body>
	    <?php
           } catch (Exception $e) {
           	   $mensaje=$e->getMessage();
               header ("Location: index.php?mensaje=$mensaje");	
    }  
    ?>
    <footer>
    	        <div class= "div_foot">
			<p> Made by : Amarillo Lujan & Echeverria Tomas  </p>
		</div>
    </footer>
</html>