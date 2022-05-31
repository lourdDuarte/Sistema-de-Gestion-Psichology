
function validarUsuario(){
	var divMensajeError = document.getElementById("mensajeError");
    var nombre = document.getElementById("txtNombre").value;
    var apellido =document.getElementById("txtApellido").value;
    var password = document.getElementById("txtPassword").value;
    var username = document.getElementById("txtUsername").value;
    var numeroDocumento = document.getElementById("txtNumeroDocumento").value;
    var fechaNacimiento = document.getElementById("txtFechaNacimiento").value;
    

    
    //nombre
    if (nombre.trim() == "") {
        
        alert("ERROR NOMBRE VACIO");
        //divMensajeError.innerHTML = "<font color='red'><h3>ERROR NOMBRE VACIO</h3></font><br><br>";
        return;
    }

    //apellido
    if (apellido.trim() == "") {
        
        alert("ERROR APELLIDO VACIO");
        //divMensajeError.innerHTML = "<font color='red'><h3>ERROR APELLIDO VACIO</h3></font><br><br>";
        return;
    }

    
    //username
    if (username.trim()== ""){
        alert("DEBE INGRESAR NOMBRE DE USUARIO");
        //divMensajeError.innerHTML = "<font color='red'><h3>DEBE INGRESAR NOMBRE DE USUARIO</h3></font><br><br>";
        return;
    }

    //password

    if (password.trim() == "") {
        
        alert("ERROR CONTRASEÑA VACIA");
        //divMensajeError.innerHTML = "<font color='red'><h3>ERROR CONTRASEÑA VACIA</h3></font><br><br>";
        return;
    }else if (password.length < 6) {

    	alert("CONTRASEÑA INSEGURA: ingrese al menos 6 caracteres");
        //divMensajeError.innerHTML = "<font color='red'><h3>CONTRASEÑA INSEGURA:ingrese al menos 6 caracteres</h3></font><br><br>";
    	return;
    }

    
    //documento
    if (numeroDocumento.trim() == "") {
        
        alert("DEBE INGRESAR NUMERO DE DOCUMENTO");
        //divMensajeError.innerHTML = "<font color='red'><h3>DEBE INGRESAR NUMERO DE DOCUMENTO</h3></font><br><br>";
        return;
    }

    if (fechaNacimiento.trim() == "") {
        
        alert("DEBE INGRESAR FECHA DE NACIMIENTO");
        //divMensajeError.innerHTML = "<font color='red'><h3>DEBE INGRESAR FECHA DE NACIMIENTO</h3></font><br><br>";
        return;
    }
    

    var form = document.getElementById("frmDatos");
    form.submit();
}