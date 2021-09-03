<?php
/** @var ImpresoraController $this */
/** @var Impresora $data */
?>
<div class="view">
                    
        <?php if (!empty($data->PC)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('PC')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->PC); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->IMPRESORA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('IMPRESORA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->IMPRESORA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->ANCHO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ANCHO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ANCHO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->ALTO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ALTO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ALTO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->FORMATO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FORMATO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->FORMATO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->MARG_X)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('MARG_X')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->MARG_X); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->MARG_y)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('MARG_y')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->MARG_y); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->DOC)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('DOC')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->DOC); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->JUNTA_LOCAL)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('JUNTA_LOCAL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->JUNTA_LOCAL); ?>
            </div>
        </div>

        <?php endif; ?>
    </div>