function Checkfiles()
{
var fup = document.getElementById('imagen');
var fileName = fup.value;
var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "doc"  || ext== "png" || ext=="PNG" )
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
function validarfoto(){
	var texto= document.mensaje.publicacion.value;
	var valorfoto = document.mensaje.imagen.value;
	if(valorfoto){
		if(Checkfiles){
			if(texto.length <= 140){
				document.mensaje.submit();
			}else{
				alert('el texto puede tener como maximo 140 caracteres');
			}
		}
	}
	else{
		alert('no se cargo una foto');
	}
}
function validacion (){
	var texto= document.mensaje.publicacion.value;
	var imagenvalue= document.mensaje.imagen.value;
	if((texto) || (imagenvalue)){
			if(imagenvalue){
				validarfoto();
			}
			if(texto.length <= 140){
				document.mensaje.submit();
			}else{
				alert('el texto puede tener como maximo 140 caracteres');
			}
		}
	else{
		alert('no puede publicar un mensaje sin contenido');
	}
}
	