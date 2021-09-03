<?php
/*
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
?>

<fieldset>
    <legend> <h5 class="btn-primary text-center">
            Junta Administradora de Agua Potable y Saneamiento
            <br>San Vicente de Lacas
            <br>Consulta tu valor a pagar</h5>
    </legend>
    <?php echo $this->renderPartial('_form_buscar_deuda', array('model' => $model)); ?>   
    <a href="<?= Yii::app()->homeUrl; ?>">
        <button type="button" class="btn btn-warning"> 
               <center><b> ← Volver</b> </center>
        </button>
    </a>
</fieldset>

