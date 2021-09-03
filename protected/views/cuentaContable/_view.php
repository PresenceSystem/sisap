<?php
/** @var CuentaContableController $this */
/** @var CuentaContable $data */
?>
<div class="view">
                    
        <?php if (!empty($data->iDGRUPO->CODIGO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ID_GRUPO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->iDGRUPO->CODIGO); ?>
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
                
        <?php if (!empty($data->CUENTA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CUENTA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CUENTA); ?>
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