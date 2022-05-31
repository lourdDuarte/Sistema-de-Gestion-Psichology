
<?php

require_once "../../class/TipoDocumento.php";
require_once '../../class/ObraSocial.php';
require_once '../../class/Profesional.php';
require_once '../../class/TipoAtencion.php';
require_once "../../menu.php";


$listaProfesional = Profesional:: obtenerTodos();
$listadoDocumento = TipoDocumento::obtenerTodos();
$listaAtencion = TipoAtencion::obtenerTodos();

$listaObraSocial =  ObraSocial::obtenerTodos();



?>


<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Paciente</title>

	<script type="text/javascript" src="/programacion3/Gestion/static/js/paciente/validacionPaciente.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="/programacion3/Gestion/static/lib/select/select2.min.js"></script>

  

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
            <h4><i class="fa fa-angle-right"></i> Nuevo Paciente</h4>
            <br>
            <div class="form-panel">
              <div class=" form">
       	        <br>
		            <form class="cmxform form-horizontal style-form" id="frmDatos" name="frmDatos" method="POST" action = "procesar/guardar.php">
                        <div class="row mt">
                            <label class="col-lg-2 control-label">Nombre</label>
                            <div class="col-lg-10">
                              <input type="text" name="txtNombre" class="form-control" id="txtNombre">
                           </div>
                          </div>
                          <div class="row mt">
                            <label class="col-lg-2 control-label">Apellido</label>
                            <div class="col-lg-10">
                              <input type="text" name="txtApellido" class="form-control" id="txtApellido">
                           </div>
                          </div>
                          <div class="row mt">
                          <label class="col-lg-2 control-label">Obra Sociales Aceptadas: </label>
                          <div class="col-lg-10">
                            <select id="cboObraSocial" name= "cboObraSocial[]" multiple style="width: 150px; height: 150px;">
                              <?php foreach($listaObraSocial as $obraSocial): ?>
                                <option value="<?php echo $obraSocial->getIdObraSocial();?>"><?php echo $obraSocial?></option>
                              <?php endforeach?>
                            </select>
                          </div>
                        </div>
                        <div class="row mt">
                          <label class="col-lg-2 control-label">Numero Asociado:</label>
                          <div class="col-lg-10">
                            <input type="text" name="txtNumeroAsociado" class="form-control" id="txtNumeroAsociado">
                          </div>
                        </div>
                        <div class="row mt">
                          <label class="col-lg-2 control-label">Profesional Asignado: </label>
                          <div class="col-lg-10">
                            <select class="buscar_profesional" name= "cboProfesional" id="cboProfesional">
                              <option value = "0">Seleccionar</option>
                              <?php foreach($listaProfesional as $profesional): ?>
                                <option value="<?php echo $profesional->getIdProfesional();?>"><?php echo $profesional?></option>
                              <?php endforeach?>
                            </select>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            Tipo de Atencion:
                            <select name="cboTipoAtencion" id="tipoAtencion"> 
                              <option value = "0">Seleccionar</option>
                              <?php foreach($listaAtencion as $tipo): ?>
                                <option value="<?php echo $tipo->getIdTipoAtencion();?>"><?php echo $tipo?></option>
                              <?php endforeach?>                        
                            </select>
                          </div>
                        </div>
                        <div class="row mt">
                          <label class="col-lg-2 control-label">Fecha de Admision</label>
                          <div class="col-lg-10">
                            <input type="date" name="txFechaAdmision" class="form-control" id="txtFechaAdmision">
                          </div>
                        </div>

      		            
      			         <div class="row mt">
                        <label class="col-lg-2 control-label">Fecha Nacimiento</label>
                        <div class="col-lg-10">
      				            <input type="date" name="txtFechaNacimiento" class="form-control" id="txtFechaNacimiento">
      			           </div>
      			         </div> 

      			         <div class="row mt">
      			           <label class="col-lg-2 control-label">Tipo Documento: </label>
      			           <div class="col-lg-10">
        			           <select name="cboTipoDocumento" id="cboTipoDocumento">
        			             <option value="0">Seleccionar</option>

                    				<?php foreach ($listadoDocumento as $tipoDocumento): ?>

                    					<option value="<?php echo $tipoDocumento->getIdTipoDocumento(); ?>">
                    					    <?php echo $tipoDocumento; ?>
                    			     </option>

                    				<?php endforeach ?>

        			           </select>
      		              </div>
      			         </div> 
      		            <div class="row mt">
                        <label class="col-lg-2 control-label">Numero Documento</label>
                          <div class="col-lg-10">
      				              <input type="text" name="txtNumeroDocumento" class="form-control" id="txtNumeroDocumento">
      			             </div>
      		              </div>
      		              <div class="row mt">
                          <label class="col-lg-2 control-label">Descripcion</label>
                          <div class="col-lg-10">
      				              <input type="text" name="txtDescripcion" class="form-control" id="txtDescripcion">
                    			</div>
                    		</div>
      			            <div align="left">    
                          <div class="row mt">
                            <div class="col-lg-offset-2 col-lg-10">
                              <input type="submit" id="guardar" name="btnGuardar" value="Guardar" onclick=" validarPaciente();">
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

 <script>



$(document).ready(function() {
    $('.buscar_profesional').select2();
});


</script>

<script>

  $(function(){
    $('#guardar').on('click', function(e){
      $.ajax({
        type: "POST",
        url:"/programacion3/Gestion/modulos/pacientes/procesar/validar.php",
        data:{
          'numeroAsociado': $('#txtNumeroAsociado').val(),
          'numeroDocumento':$('#txtNumeroDocumento').val()
        },
        success: function(respuesta){
          if (respuesta == 1) {
            alert("Ingreso un numero de asociado ya existente");
            //return;
          }else if (respuesta == 2) {
            alert("Ingreso un numero de documento ya existente");
          }
        }   
      })
    })
  })
  
</script>
</body>
</html>

 
