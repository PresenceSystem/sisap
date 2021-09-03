<?php
/** @var AsistenciaController $this */
/** @var Asistencia $data */
?>
<div class="view">
                    
        <?php if (!empty($data->cODIGOSOCIO->CI)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CODIGO_SOCIO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->cODIGOSOCIO->CI); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->cODIGOREUNION->HORA_INGRESO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CODIGO_REUNION')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->cODIGOREUNION->HORA_INGRESO); ?>
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
                
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('REGISTRA_INGRESO_PUNTUAL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->REGISTRA_INGRESO_PUNTUAL == 1 ? 'True' : 'False'); ?>
                            </div>
        </div>

                
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('REGISTRA_ATRASO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->REGISTRA_ATRASO == 1 ? 'True' : 'False'); ?>
                            </div>
        </div>

                
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('REGISTRA_FUGA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->REGISTRA_FUGA == 1 ? 'True' : 'False'); ?>
                            </div>
        </div>

                
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('REGISTRA_SALIDA_PUNTUAL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->REGISTRA_SALIDA_PUNTUAL == 1 ? 'True' : 'False'); ?>
                            </div>
        </div>

                
        <?php if (!empty($data->OBSERVACIONES)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('OBSERVACIONES')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->OBSERVACIONES); ?>
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