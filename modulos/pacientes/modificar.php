<?php

require_once '../../class/Paciente.php';
require_once "../../class/TipoDocumento.php";
require_once '../../class/ObraSocial.php';
require_once '../../class/Ficha.php';
require_once '../../class/Profesional.php';
require_once '../../class/TipoAtencion.php';
require_once '../../class/ObraSocialPaciente.php';
require_once "../../menu.php";


error_reporting(0);
$listadoDocumento = TipoDocumento::obtenerTodos();
$listaObraSocial = ObraSocial::obtenerTodos();


$id= $_GET['id'];
$idFicha = $_GET['idFicha'];

$paciente = Paciente::ObtenerPorId($id);
$ficha = Ficha::obtenerPorId($idFicha);
$profesionales = Profesional::obtenerTodos();
$atenciones = TipoAtencion::obtenerTodos();

$numeroAsociado = ObraSocialPaciente::obtenerPorIdPaciente($id);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Actualizar Paciente</title>

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
          <h4><i class="fa fa-angle-right"></i> Actualizar Paciente</h4>
            <div class="form-panel">
              <div class=" form">
       	
			         <form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action="procesar/modificar.php">
			            <input type="hidden" name="txtId" value="<?php echo $paciente->getIdPaciente(); ?>">
                  <input type="hidden" name="txtIdFicha" value="<?php echo $ficha->getIdFicha(); ?>">
			             <div class="row mt">
                      <label class="col-lg-2 control-label">Nombre</label>
                      <div class="col-lg-10">
                        <input type="text" name="txtNombre" value="<?php echo $paciente->getNombre() ?>" class="form-control">                    
                      </div>
                    </div>
                    <div class="row mt">
                      <label class="col-lg-2 control-label">Apellido</label>
                      <div class="col-lg-10">
                        <input type="text" name="txtApellido" value="<?php echo $paciente->getApellido() ?>" class="form-control">                   
                      </div>
                    </div>
                  <div class="row mt">
                        <label class="col-lg-2 control-label">Obra Social: </label>                  
                        <select name="cboObraSocial[]" multiple style="width: 150px; height: 150px;">

                          <?php foreach ($listaObraSocial as $obraSocial) :?>

                          <?php

                          $selected = '';
                          $idObraSocial = $obraSocial->getIdObraSocial();

                          if ($paciente->tieneObraSocial($idObraSocial)) {
                            $selected = "SELECTED";
                          }

                          ?>

                          <option value="<?php echo $obraSocial->getIdObraSocial(); ?>" <?php echo $selected ?> >
                            <?php echo $obraSocial ?>
                          </option>

                         <?php endforeach ?>
                        </select>
                      </div>  
                      <div class="row mt">
                        <label class="col-lg-2 control-label">Numero Asociado:</label>
                        <?php foreach($numeroAsociado as $numero):?>
                          <div class="col-lg-10">
                            <input type="text" name="txtNumeroAsociado" value="<?php echo $numero->getNumeroAsociado();?>" class="form-control">
                        <?php endforeach?>
                        </div>
                      </div>            
                      <div class="row mt">
                        <label class="col-lg-2 control-label">Profesional Asignado: </label>
                        <div class="col-lg-10">
                          <select name="cboProfesional" >
              
                            <option value="0">Seleccionar</option>
                            <?php
                              foreach ($profesionales as $profesional):
                                   $selected = '';
                                    if ($profesional->getIdProfesional() == $ficha->getIdProfesional()){
                                      $selected = "SELECTED";
                                    }
                                  
                            ?>

                            <option value="<?php echo $profesional->getIdProfesional(); ?>" <?php echo $selected; ?>>
                            <?php echo $profesional; ?>
                            </option>
                            <?php endforeach ?>
              
                          </select>
                        </div>
                      </div>
                      <div class="row mt">
                        <label class="col-lg-2 control-label">Tipo de Atencion: </label>
                        <div class="col-lg-10">
                          <select name="cboTipoAtencion" >
              
                          <option value="0">Seleccionar</option>
                          <?php
                            foreach ($atenciones as $atencion):
                                 $selected = '';
                               
                                  if ($atencion->getIdTipoAtencion() == $ficha->getIdTipoAtencion()){
                                    $selected = "SELECTED";
                                  }
                                
                          ?>

                          <option value="<?php echo $atencion->getIdTipoAtencion(); ?>" <?php echo $selected; ?>>
                          <?php echo $atencion; ?>
                          </option>
                       
                          <?php endforeach ?>             
                        </select>
                      </div>
                    </div>
			             <div class="row mt">
                      <label class="col-lg-2 control-label">Fecha Nacimiento</label>
                      <div class="col-lg-10">
                        <input type="date" name="txtFechaNacimiento" value="<?php echo $paciente->getFechaNacimiento(); ?>">
                      </div>
                    </div>
                    <div class="row mt">
                      <label class="col-lg-2 control-label">Tipo Documento: </label>
                      <div class="col-lg-10">
        		            <select name="cboTipoDocumento" id="cboTipoDocumento">
              
        			           <option value="0">Seleccionar</option>
                    		  <?php
                            foreach ($listadoDocumento as $tipoDocumento):
                                 $selected = '';
                                  if ($paciente->getIdTipoDocumento() == $tipoDocumento->getIdTipoDocumento()){
                                    $selected = "SELECTED";
                                  }
                                
                          ?>

                          <option value="<?php echo $tipoDocumento->getIdTipoDocumento(); ?>" <?php echo $selected; ?>>
                            <?php echo $tipoDocumento; ?>
                          </option>
                          <?php endforeach ?>       			
        		            </select>
        		          </div>
        		        </div>
		                <div class="row mt">
                      <label class="col-lg-2 control-label">Numero Documento</label>
                        <div class="col-lg-10">
                          <input type="text" name="txtNumeroDocumento" value="<?php echo $paciente->getNumeroDocumento(); ?>"class="form-control">                   
                        </div>
                      </div>
        		          <div class="row mt">
                        <label class="col-lg-2 control-label">Descripcion</label>
                        <div class="col-lg-10">
                          <input type="text" name="txtDescripcion" value="<?php echo $paciente->getDescripcion();?>" class="form-control">
                        </div>
                      </div>
                    <div align="left">  
                      <div class="row mt">
                        <div class="col-lg-offset-2 col-lg-10">
                          <input type="submit" name="btnGuardar" value="Actualizar">
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

