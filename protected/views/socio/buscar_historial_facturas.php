<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
?>

<fieldset>
    <legend> 
        <h2 class="btn-primary text-center">HISTORIAL DE FACTURAS DEL SOCIO</h2>        
    </legend>
    <?php echo $this->renderPartial('_form_buscar_facturas', array('model' => $model)); ?>    
</fieldset>

