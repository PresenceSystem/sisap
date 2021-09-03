<?php
/** @var RecuentoController $this */
/** @var Recuento $data */
?>
<div class="view">
                    
        <?php if (!empty($data->iDCAJA->FECHA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ID_CAJA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->iDCAJA->FECHA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->UNO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('UNO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->UNO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CINCO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CINCO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CINCO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->DIEZ)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('DIEZ')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->DIEZ); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->VIENTICINCO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('VIENTICINCO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->VIENTICINCO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CINCUENTA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CINCUENTA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CINCUENTA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->UNO_D)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('UNO_D')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->UNO_D); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CINCO_D)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CINCO_D')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CINCO_D); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->DIEZ_D)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('DIEZ_D')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->DIEZ_D); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->VIENTE_D)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('VIENTE_D')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->VIENTE_D); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CINCUENTA_D)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CINCUENTA_D')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CINCUENTA_D); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CIEN_D)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CIEN_D')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CIEN_D); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TOTAL)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TOTAL); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->cODUSUARIO->username)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('COD_USUARIO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->cODUSUARIO->username); ?>
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