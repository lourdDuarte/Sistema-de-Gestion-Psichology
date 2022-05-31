<?php

require_once '../../../class/ObraSocial.php';

$id= $_GET['id'];

$obraSocial= ObraSocial::ObtenerPorId($id);

$obraSocial->eliminar();

header('location: ../listado.php?mensaje=3');


?>

