<?php /*
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ ?>
<fieldset>
    <div class=" span badge badge-success">DATOS ACTUALES</div>
    <DIV class=""><?php echo '<b>Usuario del agua potable:</b> ' . $model_socioMedidor->cODIGOSOCIO->APELLIDO; ?></div>
    <DIV class="">    <?php echo '<b>CI/RUC:</b> ' . $model_socioMedidor->cODIGOSOCIO->CI; ?>
    </DIV>
    <DIV class=""><?php echo '<b>MEDIDOR ANTERIOR:</b> ' . $model_socioMedidor->iDMEDIDOR->NUMERO; ?></DIV>
    
    <div class="">
        <div class="badge badge-warning">
        <h4>   Ingresar los datos del nuevo medidor</h4>
    </div>
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
    
</fieldset>
