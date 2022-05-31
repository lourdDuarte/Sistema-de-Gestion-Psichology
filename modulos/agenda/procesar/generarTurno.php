<?php

require_once '../../../class/Agenda.php';

$id=$_GET['idAgenda'];

$generar = Agenda::aplicar($id);


header('location:../listado.php?mensaje=3');

?>