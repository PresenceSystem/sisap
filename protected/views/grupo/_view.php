<?php
/** @var GrupoController $this */
/** @var Grupo $data */
?>
<div class="view">
                    
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
                
      

    </div>