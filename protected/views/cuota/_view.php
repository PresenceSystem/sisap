<?php
/** @var CuotaController $this */
/** @var Cuota $data */
?>
<div class="view">
                    
        <?php if (!empty($data->iDDETALLE->CANTIDAD)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ID_DETALLE')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->iDDETALLE->CANTIDAD); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->FECHA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FECHA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->FECHA, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->FECHA)); ?>
                            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->ABONO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ABONO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ABONO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->SALDO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('SALDO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->SALDO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->OBSERVACION)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('OBSERVACION')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->OBSERVACION); ?>
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