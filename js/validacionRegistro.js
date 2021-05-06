
function noesvacio(nombre,apellido){	
	valido = false;
	if(nombre != null) {
		if(apellido != null){
			valido = true;
		}
		else{
			alert('apellido esta vacio')
		}
	}
	else{
		alert('nombre esta vacio');
	}
	return valido;
}

function emailIsValid (email) {
  return /\S+@\S+\.\S+/.test(email);
}
function esAlfabetico(str){ 
			return /^[a-zA-Z]+$/.test(str);
}
function esAlfanumerico(str){ //Es igual a esAlfabetico pero tambien le suma que tambien sea numerico;
			return /^[a-zA-Z0-9]+$/.test(str);;
}
function Checkfiles()
{
var fup = document.getElementById('imagen');
var fileName = fup.value;
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "doc")
{
return true;
} 
else
{
alert("solo gifs o jpgs");
fup.focus();
return false;
}
}
function validarContrasenia(str){
			var numerosimbolo = 0; //variables para controlar
			var mayus = 0; //Que la contraseña tenga al menos
			var minus = 0; //Un caracter minuscula, mayuscula y un numero o simbolo.
			var i; //Variable i para el for, dah.
			for(i=0;i<str.length;i++){
				var caracterActual = str[i]; //Como el str es un string de caracteres (es una palabra), recorremos 
				if(!esAlfabetico(caracterActual)){  //caracter por caracter con la variable i;
					numerosimbolo++;  //Como no hay restriccion de algun caracter especial, si NO es alfabetico, significa que es un numero o un simbolo;
				}else{
					if(caracterActual == caracterActual.toUpperCase()){ //toUpperCase devuelve true si es mayuscula;
						mayus++; //Incrementamos si es mayuscula.
					}
					if(caracterActual == caracterActual.toLowerCase()){ //toLowerCase devuelve true si es minuscula;
						minus++; //Incrementamos si es minuscula;
					}
				}	//Acá significa que ya recorrimos toda la palabra recibida;
			}
			return (numerosimbolo>0 && ((mayus>0 && minus>0))); //Nos dará true si tiene numeros/simbolos Y al menos una letra mayuscula y al menos una letra minúscula. Si da false, saltará un alert.
}

function validacion(){
	var valormail = document.registro.user_mail.value;
	var valornombre = document.registro.nombre.value;
	var valorapellido = document.registro.apellido.value;
	var valorclave = document.registro.clave.value;
	var valorclave1 = document.registro.clave1.value;
	var valordni = document.registro.dni.value;
	if(valornombre){
		if(valorapellido){
		if(esAlfanumerico(valornombre) && esAlfanumerico(valorapellido)){
			if(emailIsValid(valormail)){
						if(valorclave.length >=6){
							if(valorclave == valorclave1){
								if(valordni >= 8){// consultar si se debe de verificar que las 2 contraseñas coincidan
										document.registro.submit();
								}
								else{
									alert('el dni es invalido');
								}
							}
							else{
								alert('las contraseñas no coinciden')
							}
							
						}
						else{
							alert('la clave debe de tener 6 o mas caracteres');
						}
				
				
			}
			else{
				alert('inserte un mail valido');
			}
		}
		else{
			alert('nombre y apellido deben de tener solo caracteres alfabeticos');
		}
		}
		else{
			alert('apellido esta vacio');
		}
	}
	else{
		alert('nombre esta vacio');
	}
}
