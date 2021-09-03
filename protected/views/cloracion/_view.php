<?php
/** @var CloracionController $this */
/** @var Cloracion $data */
?>
<div class="view">
                    
        <?php if (!empty($data->LLAVET1)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('LLAVET1')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->LLAVET1); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->LLAVET2)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('LLAVET2')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->LLAVET2); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TANQUE1)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TANQUE1')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TANQUE1); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TANQUE2)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TANQUE2')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TANQUE2); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TANQUE3)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TANQUE3')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TANQUE3); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->VALVULA_CL)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('VALVULA_CL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->VALVULA_CL); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->F_CL)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('F_CL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->F_CL); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->PH)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('PH')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->PH); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->LLAVE_DISTRIBUCION)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('LLAVE_DISTRIBUCION')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->LLAVE_DISTRIBUCION); ?>
            </div>
        </div>

        <?php endif; ?>
    </div>