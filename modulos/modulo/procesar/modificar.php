<?php

require_once '../../../class/Modulo.php';

$id = $_POST['txtId'];
$descripcion = $_POST['txtDescripcion'];
$directorio = $_POST['txtDirectorio'];

session_start();

if (empty(trim($descripcion))) {
    $_SESSION['mensaje_error']= "DEBE DETERMINAR EL NOMBRE DEL MODULO";
     header("Location: ../modificar.php?id=$id");
    
    exit;
}


if (empty(trim($directorio))) {
    $_SESSION['mensaje_error']= "DEBE DETERMINAR EL DIRECTORIO";
    header("Location: ../modificar.php?id=$id");
    
    exit;
}

$modulo = Modulo::obtenerPorId($id);
$modulo->setDescripcion($descripcion);
$modulo->setDirectorio($directorio);


$modulo->actualizar();


header("location:../listado.php?mensaje=2");

?>