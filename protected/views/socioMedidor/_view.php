<?php
/** @var SocioMedidorController $this */
/** @var SocioMedidor $data */
?>
<div class="view">
                    
        <?php if (!empty($data->cODIGOSOCIO->CI)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CODIGO_SOCIO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->cODIGOSOCIO->CI); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->iDMEDIDOR->NUMERO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ID_MEDIDOR')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->iDMEDIDOR->NUMERO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->COD_USUARIO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('COD_USUARIO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->COD_USUARIO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->FECHA_ACTUALIZACION)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_ACTUALIZACION')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->FECHA_ACTUALIZACION, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->FECHA_ACTUALIZACION)); ?>
                            </div>
        </div>

        <?php endif; ?>
    </div>