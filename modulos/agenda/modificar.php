<?php
require_once '../../menu.php';
require_once '../../class/Agenda.php';
require_once '../../class/AgendaDia.php';
require_once '../../class/Profesional.php';

$idAgenda=$_GET['idAgenda'];


$diasDisponibles=AgendaDia::obtenerDiasPorIdAgenda($idAgenda);
$agenda = Agenda::obtenerAgendaPorId($idAgenda);
//$profesional = Profesional::obtenerPorId($idProfesional);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Actualizar Agenda</title>
</head>
<body>
<section id="main-content">
    <section class="wrapper">
      <div align="center">

        <?php if (isset($_SESSION['mensaje_error'])) : ?>

          <font color="red">
            <h3><?php echo $_SESSION['mensaje_error'] ?></h3>
          </font>
         <?php
           unset($_SESSION['mensaje_error']);
            endif;
          ?>
         <div id="mensajeError"></div>
      </div>
      <div class="row mt">
        <div class="col-lg-12">
          <h4><i class="fa fa-angle-right"></i> Actualizar Agenda </h4>
          <div class="form-panel">
            <div class=" form">
       	      <br>
		          <form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/modificar.php">
            		<input type="hidden" name="txtId" value="<?php echo $agenda->getIdAgenda(); ?>">
                
            		<div class="row mt">
                    <label class="col-lg-2 control-label">Fecha Inicio de Atencion:</label>
                    <div class="col-lg-10">
            					<input type="date" name="dtFechaInicio" value="<?php echo $agenda->getFechaDesde();?>"class="form-control">
            				</div>
            			</div>
  		            <div class="row mt">
                    <label class="col-lg-2 control-label">Fecha final de Atencion:</label>
                    <div class="col-lg-10">
  					         <input type="date" name="dtFechaFinal" value="<?php echo $agenda->getFechaHasta();?>"class="form-control">
  					       </div>
  				        </div>
  			         <div class="row mt">
                    <label class="col-lg-2 control-label">Duracion por turno</label>
                    <div class="col-lg-10">
  				            <input type="text" name="txtDuracion" value="<?php echo $agenda->getDuracion()?>"class="form-control">
  			           </div>
  	 	           </div>

              		<div class="row mt">
              			<label class="col-lg-12 control-label">Hora Inicio de Atencion</label>
              				<div class="col-lg-10">
                				<input type="time" name="txtHoraInicio" value="<?php echo $agenda->getHoraDesde()?>"class="form-control" id="txtHoraInicio">
                			</div>
                	</div>
                		<div class="row mt">
                			<label class="col-lg-12 control-label">Hora Final de Atencion</label>
                				<div class="col-lg-10">
                				  <input type="time" name="txtHoraFinal" value="<?php echo $agenda->getHoraHasta()?>"class="form-control" id="txtHoraFinal">
                			 </div>
                		</div>
  		              <div class="row mt">
                       <label class="col-lg-12 control-label">Dias Disponibles</label>
                       <div class="col-lg-10">
                   	      <br>
                   	      <?php foreach ($diasDisponibles as $dias): ?>	
                       			 <input type="checkbox" name="txtLunes" value="<?php echo $dias->getLunes()?>"
                       			 <?php 

                       			if ($dias->getLunes() == 1 ){
                       			echo 'checked';
                       			}
                       			?>        
                         			 >Lunes
                         			<input type="checkbox" name="txtMartes" value="<?php echo $dias->getMartes()?>"
                         			 <?php 

                       			if ($dias->getMartes() == 1 ){
                       			echo 'checked';
                       			}
                       			?>        
                         			 >Martes
                         			<input type="checkbox" name="txtMiercoles" value="<?php echo $dias->getMiercoles()?>"
                         			 <?php 

                       			if ($dias->getMiercoles() == 1 ){
                       			echo 'checked';
                       			}
                       			?>        
                         			 >Miercoles
                         			<input type="checkbox" name="txtJueves" value="<?php echo $dias->getJueves()?>"
                         			 <?php 

                       			if ($dias->getJueves() == 1 ){
                       			echo 'checked';
                       			}
                       			?>        
                         			 >Jueves
                         			<input type="checkbox" name="txtViernes" value="<?php echo $dias->getViernes()?>"
                         			 <?php 

                       			if ($dias->getViernes() == 1 ){
                       			echo 'checked';
                       			}
                       			?>        
                         			 >Viernes
               		       <?php endforeach ?>
                       </div>
                      </div>
                  		 <div align="left"> 
                         <div class="row mt" align="left">
                            <div class="col-lg-offset-2 col-lg-10">
                                <input type="submit" name="btnGuardar"value="Actualizar" >
                            </div>
                          </div>
                        </div>
	                 </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</body>
</html>

