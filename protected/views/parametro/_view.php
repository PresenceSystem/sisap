<?php
/** @var ParametroController $this */
/** @var Parametro $data */
?>
<div class="view">
                    
        <?php if (!empty($data->DESCRIPCION)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->DESCRIPCION); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->VALOR)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('VALOR')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->VALOR); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->VALOR_MIN)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('VALOR_MIN')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->VALOR_MIN); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->VALOR_MAX)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('VALOR_MAX')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->VALOR_MAX); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ESTADO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ESTADO == 1 ? 'True' : 'False'); ?>
                            </div>
        </div>

    </div>