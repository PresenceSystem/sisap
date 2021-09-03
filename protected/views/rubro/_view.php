<?php
/** @var RubroController $this */
/** @var Rubro $data */
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
                
        <?php if (!empty($data->V_UNITARIO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('V_UNITARIO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->V_UNITARIO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->PORCEN)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('PORCEN')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->PORCEN); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->FEC_CREACION)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FEC_CREACION')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->FEC_CREACION, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->FEC_CREACION)); ?>
                            </div>
        </div>

        <?php endif; ?>
    </div>