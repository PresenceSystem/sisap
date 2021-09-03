<?php /*
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ ?>
<h3 class="btn-info text-center">ACTUALIZAR MEDIDOR</h3>
 <fieldset>
<div class="class col-md-12">
<div class="panel panel-primary">
<div class="panel panel-heading">
    <h3 class="panel-title"><center>INFORMACIÓN SOCIO</center></h3>
</div>
  <div class="panel-body">
    <div class="col-md-3"><?php echo '<b>CI/RUC:</b> ' . $model_socioMedidor->cODIGOSOCIO->CI; ?></div>
    <div class="col-md-9"><?php echo '<b>Nombre Socio:</b> ' . $model_socioMedidor->cODIGOSOCIO->APELLIDO; ?></div>
  </div>
  <div class="panel-footer">
    <?php echo '<b>Medidor Actual:</b> ' . $model_socioMedidor->iDMEDIDOR->NUMERO; ?>
  </div>
</div>
</div>
</fieldset>

<div class="col-md-12">
  <div class="col-md-12">
    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>  
  </div>    
</div>

    


