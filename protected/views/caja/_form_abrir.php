<div class="form">
    <?php
    /** @var CajaController $this */
    /** @var Caja $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'caja-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    

    <?php echo $form->errorSummary($model) ?>

                            <?php echo $form->textFieldRow($model, 'SALDO_INICIAL', array('class' => 'span5')) ?>
                        <?php //echo $form->dropDownListRow($model, 'RECAUDADOR', CHtml::listData(Usuario::model()->findAll(), 'id', Usuario::representingColumn())) ?>
                        <?php //echo $form->textFieldRow($model, 'FACTURA_DESDE', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'FACTURA_HASTA', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'TOTAL_FACTURAS', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'RECIBO_DESDE', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'RECIBO_HASTA', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'TOTAL_RECIBOS', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'TOTAL', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'EFECTIVO', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'TARJETAS', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'BANCOS', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'PENDIENTES_PAGO', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'BASE_IMPONIBLE', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'IVA', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'IMPORTE_IVA', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'MOV_CAJA_DESDE', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'MOV_CAJA_HASTA', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'TOTAL_INGRESOS', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'TOTAL_SALIDAS', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'TOTAL_CAJA', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'RECUENTO', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'DESCUADRE', array('class' => 'span5', 'maxlength' => 8)) ?>
                        <?php //echo $form->textFieldRow($model, 'DESCRIPCION', array('class' => 'span5', 'maxlength' => 3000)) ?>
                        <?php //echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')) ?>
                <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
		)); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Cancel'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		)); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>