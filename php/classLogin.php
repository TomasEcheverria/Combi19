<?php
	session_start(); //iniciamos la sesion
	//creamos la clase usuario
	class usuario {
		//esta función será la encargada de comprobar si existe el usuario en la base de datos
		public function validar_usuario ($link) {
			//recogemos las variables post del formulario, colocamos mysql_real_scape_string para evitar inyecciones
			if ((isset ($_POST['nombre'])) and (isset ($_POST['cont']))){
				
				$nombre= $_POST['nombre'];//nombre va a ser el email
				$password= $_POST['cont'];//contraseña
				$_SESSION['nombrei']=$nombre;
				$_SESSION['conti']=$password;
				if((!empty($nombre)) || (!empty($password))){
				//validacion del lado del servidor
				if ((strlen($nombre)>=6) and (strlen($password)>=6) ){
					$nombre = mysqli_real_escape_string ($link, $_POST['nombre']);
					$password = mysqli_real_escape_string ($link, $_POST['cont']);
					//realizamos la consulta sql 
					$query58 = "SELECT * FROM usuarios WHERE email= '".$nombre."' AND clave= '".$password."';" ;
					$resultado58 = mysqli_query($link, $query58) or die ('Consulta query58 fallida ' .mysqli_error($link));;
					/*si el número de filas devuelto por la variable resultado es 1,significa que en la base de datos blog, en la tabla usuarios existe una fila que coincide con los datos ingresados.
					luego nos envia a la pagina inicioSesion, con las variables de sesion creados y exito setado */
					if($datosUsuario =mysqli_fetch_array($resultado58)) {
						$_SESSION['email'] = $datosUsuario ['email'];
						$_SESSION['nombre'] = $datosUsuario['nombre'];
						$_SESSION['apellido'] = $datosUsuario['apellido'];
						$_SESSION['DNI']=$datosUsuario['DNI'];
						$_SESSION['clave']=$datosUsuario['clave'];
						$_SESSION['tipo_usuario']=$datosUsuario['tipo_usuario'];
						$_SESSION['suspendido']=$datosUsuario['suspendido'];
						$_SESSION['suscripto']=$datosUsuario['suscripto'];
						$_SESSION['nro_tarjeta']=$datosUsuario['nro_tarjeta'];
						$_SESSION['cod_seguridad'] = $datosUsuario['cod_seguridad'];
						$_SESSION['fecha_vencimiento'] = $datosUsuario['fecha_vencimiento'];
					
					} else {
						$query58= $query58 = "SELECT * FROM usuarios WHERE email= '".$nombre."'";
						$resultado58 = mysqli_query($link, $query58) or die ('Consulta query58 fallida ' .mysqli_error($link));;
						if($datosUsuario =mysqli_fetch_array($resultado58)) {
							throw new Exception ('Contraseña incorrecta');
						} else {
							throw new Exception ('El nombre de usuario no se encunatra registrado');
						}
					}
				} else {
					throw new Exception ('No se completo correctamente el formulario de iniciar sesion');
				}//
				
			} else {
				throw new Exception ('No se completo el formulario de iniciar sesion');
			}
			}//segundo if
		}
		
		public function session (&$usuarioID){//me guardo el email del usuario en usuario id si es que existe algo en la sesion
			if (isset ($_SESSION['email'])){
				$usuarioID= $_SESSION['email'];
			}
		}
		
		public function iniciada ($usuarioID) { //tira la exception si la sesion NO esta iniciada
			if (!isset ($usuarioID)) { 
				throw new Exception ('Es necesario iniciar sesion para acceder a este contenido');
			}
		}
		
		public function noIniciada ($usuarioID) { //tira la exception si la sesion SI esta iniciada
			if (isset ($usuarioID)) {
				throw new Exception ('Sesion iniciada');
			}
		}
	    public function nombre(&$nombre){
	    	if(isset($_SESSION['nombre'])){
	    		$nombre=$_SESSION['nombre'];
	    	}
	    }	
	    	    public function apellido(&$apellido){
	    	if(isset($_SESSION['apellido'])){
	    		$apellido=$_SESSION['apellido'];
	    	}
	    }
	    	public function email(&$email){
	    	if(isset($_SESSION['email'])){
	    		$email=$_SESSION['email'];
	    	}
	    }
	      public function contrasenia(&$contrasenia){
	    	if(isset($_SESSION['clave'])){
	    		$contrasenia=$_SESSION['clave'];
	    	}
	    }
		public function DNI(&$DNI){
	    	if(isset($_SESSION['DNI'])){
	    		$DNI=$_SESSION['DNI'];
	    	}
	    }
	     public function id(&$id){
	    	if(isset($_SESSION['id'])){
	    		$id=$_SESSION['id'];
	    	}
	    }
		public function tipoUsuario(&$tipo){
	    	if(isset($_SESSION['tipo_usuario'])){
	    		$tipo=$_SESSION['tipo_usuario'];
	    	}
	    }
		public function suspendido(&$suspendido){
	    	if(isset($_SESSION['suspendido'])){
	    		$suspendido=$_SESSION['suspendido'];
	    	}
	    }
		public function suscrito(&$suscrito){
	    	if(isset($_SESSION['suscrito'])){
	    		$suscrito=$_SESSION['suscrito'];
	    	}
	    }
		public function nro_tarjeta(&$nro_trjeta){
	    	if(isset($_SESSION['nro_tarjeta'])){
	    		$nro_trjeta=$_SESSION['nro_tarjeta'];
	    	}
	    }
		public function cod_seguridad(&$cod_seguridad){
	    	if(isset($_SESSION['cod_seguridad'])){
	    		$cod_seguridad=$_SESSION['cod_seguridad'];
	    	}
	    }
		public function fecha_vencimiento(&$fecha_vencimiento){
	    	if(isset($_SESSION['fecha_vencimiento'])){
	    		$fecha_vencimiento=$_SESSION['fecha_vencimiento'];
	    	}
	    }
	}
?>

