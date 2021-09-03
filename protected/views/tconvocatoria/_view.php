<?php
/** @var TconvocatoriaController $this */
/** @var Tconvocatoria $data */
?>
<div class="view">
                    
        <?php if (!empty($data->COD_JUNTA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('COD_JUNTA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->COD_JUNTA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->ENCABEZADO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ENCABEZADO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ENCABEZADO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TITULO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TITULO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TITULO); ?>
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
                
        <?php if (!empty($data->HORA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('HORA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->HORA, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->HORA)); ?>
                            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CUERPO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CUERPO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CUERPO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->NOTA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('NOTA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->NOTA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->FIRMA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FIRMA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->FIRMA); ?>
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
    </div>