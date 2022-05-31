<?php

require_once '../../../class/Agenda.php';


$id= $_GET['id'];

$agenda = Agenda::obtenerAgendaPorId($id);

$agenda->eliminar();

header('location:../listado.php');


?>