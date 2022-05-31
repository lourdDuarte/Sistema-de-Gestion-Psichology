<?php

require_once '../../../class/Modulo.php';

$id=$_GET['id'];

$modulo=Modulo::obtenerPorId($id);

$modulo->getDescripcion();
$modulo->getDirectorio();

$modulo->eliminar();

highlight_string(var_export($modulo,true));

//header('location:../listado.php');


?>