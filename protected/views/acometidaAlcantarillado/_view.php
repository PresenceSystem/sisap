<?php
/** @var AcometidaAlcantarilladoController $this */
/** @var AcometidaAlcantarillado $data */
?>
<div class="view">
                    
        <?php if (!empty($data->iDSOCIOMEDIDOR->COD_USUARIO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ID_SOCIO_MEDIDOR')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->iDSOCIOMEDIDOR->COD_USUARIO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->ID_GRUPO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ID_GRUPO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ID_GRUPO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TIPO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TIPO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TIPO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('INACTIVO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->INACTIVO == 1 ? 'True' : 'False'); ?>
                            </div>
        </div>

                
        <?php if (!empty($data->INACTIVO_DESCRIPCION)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('INACTIVO_DESCRIPCION')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->INACTIVO_DESCRIPCION); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->FECHA_INGRESO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_INGRESO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->FECHA_INGRESO, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->FECHA_INGRESO)); ?>
                            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->FECHA_SALIDA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_SALIDA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->FECHA_SALIDA, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->FECHA_SALIDA)); ?>
                            </div>
        </div>

        <?php endif; ?>
    </div>