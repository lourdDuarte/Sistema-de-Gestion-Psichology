<?php

require_once '../../../class/Paciente.php';

$id= $_GET['id'];

$paciente = Paciente::ObtenerPorId($id);

$paciente->eliminar();

header('location:../listado.php?mensaje=3');

?>

