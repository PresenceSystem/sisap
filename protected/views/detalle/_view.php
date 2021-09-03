<?php
/** @var DetalleController $this */
/** @var Detalle $data */
?>
<div class="view">
                    
        <?php if (!empty($data->iDFACTURA->CONSUMO_ANTERIOR)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ID_FACTURA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->iDFACTURA->CONSUMO_ANTERIOR); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->iDRUBRO->DESCRIPCION)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ID_RUBRO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->iDRUBRO->DESCRIPCION); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CANTIDAD)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CANTIDAD')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CANTIDAD); ?>
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
                
        <?php if (!empty($data->V_TOTAL)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('V_TOTAL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->V_TOTAL); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->IVA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('IVA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->IVA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->PORC_MORA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('PORC_MORA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->PORC_MORA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->VALOR_MORA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('VALOR_MORA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->VALOR_MORA); ?>
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
                
        <?php if (!empty($data->FECHA_COBRO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_COBRO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->FECHA_COBRO, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->FECHA_COBRO)); ?>
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