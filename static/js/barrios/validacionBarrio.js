function validarBarrio() {
    
    var descripcion = document.getElementById("txtDescripcion").value;
   
    if (descripcion.trim() == "") {
        alert("El nombre no debe estar vacio");
        return;
    } else if (descripcion.length < 3 ) {
        alert("El nombre debe contener al menos 3 caracteres");
        return;
    }

    var form = document.getElementById("frmDatos");
    form.submit();
}