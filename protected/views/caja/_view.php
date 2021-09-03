<?php
/** @var CajaController $this */
/** @var Caja $data */
?>
<div class="view">
                    
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
                
        <?php if (!empty($data->rECAUDADOR->username)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('RECAUDADOR')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->rECAUDADOR->username); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->FACTURA_DESDE)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FACTURA_DESDE')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->FACTURA_DESDE); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->FACTURA_HASTA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('FACTURA_HASTA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->FACTURA_HASTA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TOTAL_FACTURAS)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL_FACTURAS')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TOTAL_FACTURAS); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->RECIBO_DESDE)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('RECIBO_DESDE')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->RECIBO_DESDE); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->RECIBO_HASTA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('RECIBO_HASTA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->RECIBO_HASTA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TOTAL_RECIBOS)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL_RECIBOS')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TOTAL_RECIBOS); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TOTAL)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TOTAL); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->EFECTIVO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('EFECTIVO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->EFECTIVO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TARJETAS)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TARJETAS')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TARJETAS); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->BANCOS)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('BANCOS')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->BANCOS); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->PENDIENTES_PAGO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('PENDIENTES_PAGO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->PENDIENTES_PAGO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->BASE_IMPONIBLE)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('BASE_IMPONIBLE')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->BASE_IMPONIBLE); ?>
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
                
        <?php if (!empty($data->IMPORTE_IVA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('IMPORTE_IVA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->IMPORTE_IVA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->MOV_CAJA_DESDE)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('MOV_CAJA_DESDE')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->MOV_CAJA_DESDE); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->MOV_CAJA_HASTA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('MOV_CAJA_HASTA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->MOV_CAJA_HASTA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TOTAL_INGRESOS)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL_INGRESOS')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TOTAL_INGRESOS); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TOTAL_SALIDAS)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL_SALIDAS')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TOTAL_SALIDAS); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->TOTAL_CAJA)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL_CAJA')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->TOTAL_CAJA); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->RECUENTO)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('RECUENTO')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->RECUENTO); ?>
            </div>
        </div>

        <?php endif; ?>
                
        <?php if (!empty($data->DESCUADRE)): ?>
        <div class="field">
            <div class="field_name">
                <b><?php echo CHtml::encode($data->getAttributeLabel('DESCUADRE')); ?>:</b>
            </div>
            <div class="field_value">
                <?php echo CHtml::encode($data->DESCUADRE); ?>
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