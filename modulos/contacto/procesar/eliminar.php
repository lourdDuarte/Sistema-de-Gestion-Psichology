
<?php

require_once '../../../class/Contacto.php';


$id = $_GET['idPersonaContacto'];
$modulo = $_GET['modulo'];
$idLlamada = $_GET['idLlamada'];



$contacto = Contacto::obtenerPorId($id);

$contacto->eliminar();

//highlight_string(var_export($contacto,true));

header("location: /programacion3/gestion/modulos/$modulo/detalle.php?id=$idLlamada");



?>