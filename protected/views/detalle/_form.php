<div class="form">
    <?php
    /** @var DetalleController $this */
    /** @var Detalle $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'detalle-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

							<script>
								$(document).ready(function () {								
									$('#Detalle_CANTIDAD').on('keyup', function () {										
											$('#Detalle_V_TOTAL').val(($('#Detalle_CANTIDAD').val())*($('#Detalle_V_UNITARIO').val()));
										});
								});
							</script> 
							<script>
								$(document).ready(function () {								
									$('#Detalle_V_UNITARIO').on('keyup', function () {										
											$('#Detalle_V_TOTAL').val(($('#Detalle_CANTIDAD').val())*($('#Detalle_V_UNITARIO').val()));
										});
								});
							</script> 

    <?php echo $form->errorSummary($model) ?>

                            <?php //echo $form->dropDownListRow($model, 'ID_FACTURA', CHtml::listData(Factura::model()->findAll(), 'ID', Factura::representingColumn())) ?>
                        <?php //echo $form->dropDownListRow($model, 'ID_RUBRO', CHtml::listData(Rubro::model()->findAll(), 'ID', Rubro::representingColumn())) ?>
                        <?php echo $form->textFieldRow($model, 'CANTIDAD', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'V_UNITARIO', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php echo $form->textFieldRow($model, 'V_TOTAL', array('class' => 'span5', 'maxlength' => 6)) ?>						
                        <?php //echo $form->textFieldRow($model, 'IVA', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php //echo $form->textFieldRow($model, 'PORC_MORA', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'VALOR_MORA', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php //echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'FECHA_COBRO', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5')) ?>
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