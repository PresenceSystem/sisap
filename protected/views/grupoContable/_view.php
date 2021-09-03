<?php
/** @var GrupoContableController $this */
/** @var GrupoContable $data */
?>
<div class="view">
                    
        <?php if (!empty($data->iDCLASE->CODIGO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ID_CLASE')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->iDCLASE->CODIGO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CODIGO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CODIGO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CODIGO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->GRUPO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('GRUPO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->GRUPO); ?>
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
    </div>