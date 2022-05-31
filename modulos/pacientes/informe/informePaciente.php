<?php

require_once '../../../menu.php';
require_once '../../../class/Paciente.php';
require_once '../../../class/Profesional.php';
require_once '../../../class/Ficha.php';

require_once '../../../class/MySQL.php';

$profesionales = Profesional::obtenerTodos();


$id = $_GET['id'];

$pacienteFicha = Ficha::obtenerPorIdPaciente($id);
$paciente = Paciente::obtenerPorId($id);


date_default_timezone_set('America/Argentina/Buenos_Aires'); setlocale(LC_TIME, 'es_ES', 'esp_esp');

?>


<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="../../../static/css/informePaciente.css">
 
</head>
<body>

<section id="main-content">
  <section class="wrapper">
    <br><br>
      <button type="button" class="btn btn-primary" onclick="javascript:printInforme('imp1')"><i class="fa fa-print">Imprimir</i></button>
        <div id="imp1" class="row mt">
            <div class="col-lg-12">
              <div class="form-panel">
                <div class=" form">
                <br>
                <!-- Encabezado con datos del profesional a cargo -->
                <div align="right">

                
                 <?php foreach ($profesionales  as $profesional):?>
                     <?php foreach ($pacienteFicha as $ficha):?>
                          <?php if ($profesional->getIdProfesional() == $ficha->getIdProfesional()):?>
                            <?php echo $profesional;?>
                            <br>
                            Lic. en Psicologia - MP <?php echo $profesional->getMatricula();?>
                          <?php endif?>
                        <?php endforeach ?>
                    <?php endforeach ?>
                    <br><br>
                  <?php echo "Formosa,". " ". strftime(" %d de %B de %Y").".";?>
                </div>
                <br>
                <!-- Fin Encabezado -->
                <!-- Datos Paciente -->
                <label>Nombre: <?php echo $paciente->getNombre()?></label>
                <br>
                <label>Apellido: <?php echo $paciente->getApellido()?></label>
                <br>
                <label>DNI: <?php echo $paciente->getNumeroDocumento()?></label>
                <br>
                <label>Fecha de Nacimiento: <?php echo $paciente->getFechaNacimiento()?></label>
                
                <!-- Fin Datos Paciente -->
                <br><br>
                <label>Solicitante:</label>
                <input type="text" style="border: none;">
                <h3 align="center">INFORME PSICOLOGICO</h3>
                <br>
                <div id ="imp2" align="center">
                <textarea name="texto" id="txtarea" cols="150" rows="50" style="border: none;" align="center" >Es todo cuanto se informa.
                </textarea>

                </div>

            <br><br>
            <!-- Footer -->
            <div align="left">
            	
            	Fecha emitida : <?php echo date("d/n/Y");?>
            </div>
            <br>
            <div>
            	Firma del Profesional : 
            </div>

            <br><br>
            <h5 align="center"> Formosa,Capital</h5>
        </div>
      </div>
          </div>
        </div>
  </section>
</section>
<script>
function printInforme(divName) {

  var printContents = document.getElementById(divName).cloneNode(true);
  w = window.open();
  w.document.body.appendChild(printContents);
  w.print();
  w.close();
  
}
</script>

</body>
</html>

