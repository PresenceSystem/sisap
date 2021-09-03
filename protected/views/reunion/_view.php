<?php
/** @var ReunionController $this */
/** @var Reunion $data */
?>
<div class="view">
                    
        <?php if (!empty($data->cODIGOTIPO->TIPO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CODIGO_TIPO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->cODIGOTIPO->TIPO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->HORA_INGRESO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('HORA_INGRESO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->HORA_INGRESO, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->HORA_INGRESO)); ?>
                            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TIEMPO_ESPERA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TIEMPO_ESPERA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->TIEMPO_ESPERA, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->TIEMPO_ESPERA)); ?>
                            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->HORA_SALIDA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('HORA_SALIDA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->HORA_SALIDA, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->HORA_SALIDA)); ?>
                            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->VALOR_ATRASO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('VALOR_ATRASO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->VALOR_ATRASO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->VALOR_FUGA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('VALOR_FUGA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->VALOR_FUGA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->VALOR_FALTA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('VALOR_FALTA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->VALOR_FALTA); ?>
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