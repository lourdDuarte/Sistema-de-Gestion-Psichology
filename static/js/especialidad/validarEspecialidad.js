function validarEspecialidad() {
    
    var tipo = document.getElementById("txtTipo").value;
   
    if (tipo.trim() == "") {
        alert("El tipo no debe estar vacio");
        return;
    } else if (tipo.length < 3 ) {
        alert("El tipo debe contener al menos 3 caracteres");
        return;
    }

    var form = document.getElementById("frmDatos");
    form.submit();
}