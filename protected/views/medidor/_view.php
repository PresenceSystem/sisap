<?php
/** @var MedidorController $this */
/** @var Medidor $data */
?>
<div class="view">
                    
        <?php if (!empty($data->NUMERO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('NUMERO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->NUMERO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CONSUMO_INICIAL)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CONSUMO_INICIAL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CONSUMO_INICIAL); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->ORDEN_RECORIDO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ORDEN_RECORIDO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ORDEN_RECORIDO); ?>
            </div>
        </div>

        <?php endif; ?>
    </div>