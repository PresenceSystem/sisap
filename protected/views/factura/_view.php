<?php
/** @var FacturaController $this */
/** @var Factura $data */
?>
<div class="view">
                    
        <?php if (!empty($data->iDMEDIDORSOCIO->COD_USUARIO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ID_MEDIDOR_SOCIO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->iDMEDIDORSOCIO->COD_USUARIO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CONSUMO_ANTERIOR)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CONSUMO_ANTERIOR')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CONSUMO_ANTERIOR); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CONSUMO_ACTUAL)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CONSUMO_ACTUAL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CONSUMO_ACTUAL); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CONSUMO_CALCULADO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CONSUMO_CALCULADO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CONSUMO_CALCULADO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->MES_COBRO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('MES_COBRO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->MES_COBRO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->ANIO_COBRO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ANIO_COBRO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ANIO_COBRO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->ESTADO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ESTADO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ESTADO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TIPO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TIPO == 1 ? 'True' : 'False'); ?>
                            </div>
        </div>

    </div>