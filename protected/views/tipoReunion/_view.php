<?php
/** @var TipoReunionController $this */
/** @var TipoReunion $data */
?>
<div class="view">
                    
        <?php if (!empty($data->TIPO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TIPO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TIPO); ?>
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