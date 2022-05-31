
function validarPerfil(){
	var descripcion = document.getElementById("txtDescripcion").value;
	var modulos = document.getElementById("cboModulos").value;

	if(descripcion.trim() == ""){
		alert("DESCRIPCION VACIA");
  	//divMensajeError.innerHTML = "<font color 'red'> DESCRIPCION VACIA</font><br><br>";
	return;
	}

	if(modulos.trim() == 0){
		alert("INDIQUE MODULOS DE ACCESO");
  	//divMensajeError.innerHTML = "<font color 'red'>INDIQUE MODULOS DE ACCESO</font><br><br>";
	return;
	}
}