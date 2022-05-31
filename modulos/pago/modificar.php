<?php

require_once '../../menu.php';
require_once '../../class/PagoOs.php';
require_once '../../class/ObraSocial.php';
require_once '../../class/EstadoPago.php';

$id=$_GET['idPago'];

$pago = PagoOs::obtenerPorId($id);
$listaObraSocial = ObraSocial::obtenerTodos();
$listaEstado = EstadoPago::obtenerTodos();

?>

<html>
<head>
	<title></title>
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
        endif;?>
           <div id="mensajeError"></div>
      </div>        
    	<div class="row mt">
      		<div class="col-lg-12">
       		<h4><i class="fa fa-angle-right"></i> Actualizar Pago</h4>
       			<div class="form-panel">
       				<div class=" form">
       				 <br>
					       <form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/modificar.php">
					         <input type="hidden" name="txtId" value="<?php echo $pago->getIdPago(); ?>">
					
					         <div class="row mt">
         			        <label class="col-lg-2 control-label">Obra Social: </label>
          			      <div class="col-lg-10">
					             <select name="cboObraSocial">
      
					               <option value="0">Seleccionar</option>
              		 			 <?php foreach ($listaObraSocial as $obraSocial):
                          			$selected = '';
                            			if ($pago->getIdObraSocial() == $obraSocial->getIdObraSocial()){
                             			 $selected = "SELECTED";
                           			 }?>
                    				<option value="<?php echo $obraSocial->getIdObraSocial(); ?>" <?php echo $selected; ?>>
                    				<?php echo $obraSocial." "."-"." "."$". $obraSocial->getCoSeguro(); ?>
                    				</option>
                   			  <?php endforeach ?>			
					             </select>
					           </div>
					         </div>
                    <div class="row mt">
                      <label class="col-lg-2 control-label">Fecha:</label>
                      <div class="col-lg-10">
                          <input type="date" name="txtFecha" value= "<?php echo $pago->getFecha(); ?>"class="form-control">
                        </div>
                    </div>
					         <div class="row mt">
                  	 <label class="col-lg-2 control-label">Cantidad Sesiones Autorizadas:</label>
                 	    <div class="col-lg-10">
						            <input type="text" name="txtSesionesAutorizadas" value= "<?php echo $pago->getSesionesAutorizadas(); ?>"class="form-control">
					           </div>
					         </div>
                    <div class="row mt">
                      <label class="col-lg-2 control-label">Sesiones abonadas:</label>
                      <div class="col-lg-10">
                        <input type="text" name="txtSesionesAbonadas" value= "<?php echo $pago->getSesionesAbonada(); ?>"class="form-control">
                      </div>
                    </div>
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