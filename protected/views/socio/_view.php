<?php
/** @var SocioController $this */
/** @var Socio $data */
?>
<div class="view">
                    
        <?php if (!empty($data->CI)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CI')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CI); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->APELLIDO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('APELLIDO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->APELLIDO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->GENERO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('GENERO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->GENERO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->COD_BARRA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('COD_BARRA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->COD_BARRA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->DIRECCION)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('DIRECCION')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->DIRECCION); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TELEFONO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TELEFONO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TELEFONO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->CELULAR)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('CELULAR')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->CELULAR); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->EMAIL)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('EMAIL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::mailto($data->EMAIL); ?>
                            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->ESTADO_CIVIL)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('ESTADO_CIVIL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->ESTADO_CIVIL); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->NOMBRE_CONYUGE)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_CONYUGE')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->NOMBRE_CONYUGE); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->FOTO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FOTO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->FOTO); ?>
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
                
        <?php if (!empty($data->FECHA_NACIMIENTO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_NACIMIENTO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo Yii::app()->getDateFormatter()->formatDateTime($data->FECHA_NACIMIENTO, 'medium', 'medium'); ?>
            <br/>
                 <?php echo date('D, d M y H:i:s', strtotime($data->FECHA_NACIMIENTO)); ?>
                            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->OBS)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('OBS')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->OBS); ?>
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
                
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('USU_AGUA_RIEGO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->USU_AGUA_RIEGO == 1 ? 'True' : 'False'); ?>
                            </div>
        </div>

                
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('USU_AGUA_POTABLE')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->USU_AGUA_POTABLE == 1 ? 'True' : 'False'); ?>
                            </div>
        </div>

                
        <?php if (!empty($data->COD_BARRA_RIEGO_OLD)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('COD_BARRA_RIEGO_OLD')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->COD_BARRA_RIEGO_OLD); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->COD_BARRA_POTABLE)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('COD_BARRA_POTABLE')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->COD_BARRA_POTABLE); ?>
            </div>
        </div>

        <?php endif; ?>
    </div>