function validarObraSocial() {
    
    var nombre = document.getElementById("txtNombre").value;
    var coSeguro = document.getElementById("txtCoSeguro").value;

   
    if (nombre.trim() == "") {
        alert("El nombre no debe estar vacio");
        return;
    } 

    if (coSeguro.trim() == "") {
        alert("El Co seguro no debe estar vacio");
        return;
    } 

    var form = document.getElementById("frmDatos");
    form.submit();
}