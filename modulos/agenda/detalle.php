<?php

require_once '../../class/Agenda.php';
require_once '../../class/Profesional.php';
require_once '../../menu.php';
require_once '../../class/AgendaDia.php';

$idAgenda= $_GET['idAgenda'];
$idProfesional = $_GET['idProfesional'];

$agenda= Agenda::obtenerAgendaPorId($idAgenda);

$profesional=Profesional::obtenerPorId($idProfesional);

$diasDisponibles = AgendaDia::obtenerDiasPorIdAgenda($idAgenda)


?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

 <section id="main-content">
      <section class="wrapper">
          <div class="row">
            <div class="col-md-12">
              <div class="content-panel">
                 <h4><i class="fa fa-angle-right"></i> <?php echo "Dias de Atencion de:" ." ". "Lic."." ".$profesional;?></h4>
                  <hr>
                  <table class="table">
                    
			             <thead>
                	   <tr>
                    		<th>Lunes</th>
                    		<th>Martes</th>
                    		<th> Miercoles</th>
                    		<th> Jueves</th>
                    		<th>Viernes</th>
                	   </tr>
                    </thead>
                     <br>
                    <tbody>
               	      <tr>
                       		<?php foreach($diasDisponibles as $dias): ?>
                       			<td><?php 
                       			if ($dias->getLunes() == 1 ){
                       				echo "SI";
                       			}elseif ($dias->getLunes() == 0) {
                       				echo "NO";
                       			}

                       			?></td>
                       			<td><?php 
                       			if ($dias->getMartes() == 1 ){
                       				echo "SI";
                       			}elseif ($dias->getMartes() == 0) {
                       				echo "NO";
                       			}

                       			?></td>
                       			<td><?php 
                       			if ($dias->getMiercoles() == 1 ){
                       				echo "SI";
                       			}elseif ($dias->getMiercoles() == 0) {
                       				echo "NO";
                       			}

                       			?></td>
                       			<td><?php 
                       			if ($dias->getJueves() == 1 ){
                       				echo "SI";
                       			}elseif ($dias->getJueves() == 0) {
                       				echo "NO";
                       			}

                       			?></td>
                       			<td><?php 
                       			if ($dias->getViernes() == 1 ){
                       				echo "SI";
                       			}elseif ($dias->getViernes() == 0) {
                       				echo "NO";
                       			}

                       			?></td>


                       		<?php endforeach?>

               	      </tr>
                    </tbody>
                </table>
            </div>
         </div>
       </div>
    </section>
  </section>
</body>
</html>