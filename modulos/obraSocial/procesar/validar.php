<?php

require_once '../../../class/MySQL.php';



$mysql = new MySQL();

$obrasocial = $_POST['obrasocial'];


$validarObraSocial= " SELECT * FROM obrasocial WHERE nombre = '$obrasocial'"; 

$result = $mysql->consultar($validarObraSocial);
if(mysqli_num_rows($result) > 0 ){
 	echo 1;
 }


?>