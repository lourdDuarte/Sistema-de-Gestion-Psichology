function validarModulo(){
	var descripcion = document.getElementById("txtDescripcion").value;
	var directorio = document.getElementById("txtDirectorio").value;

	if(descripcion.trim() == ""){
		alert("DEBE DETERMINAR EL NOMBRE DEL MODULO");
  	//divMensajeError.innerHTML = "<font color 'red'> DEBE DETERMINAR EL NOMBRE DEL MODULO</font><br><br>";
	return;
	}

	if(directorio.trim() == 0){
		alert("DEBE DETERMINAR EL DIRECTORIO");
  	//divMensajeError.innerHTML = "<font color 'red'>DEBE DETERMINAR EL DIRECTORIO</font><br><br>";
	return;
	}
}