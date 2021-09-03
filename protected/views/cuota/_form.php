<div class="form">
    <?php
    /** @var CuotaController $this */
    /** @var Cuota $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'cuota-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

                            <?php echo $form->dropDownListRow($model, 'ID_DETALLE', CHtml::listData(Detalle::model()->findAll(), 'ID', Detalle::representingColumn())) ?>
                        <?php echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'ABONO', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php echo $form->textFieldRow($model, 'SALDO', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php echo $form->textFieldRow($model, 'OBSERVACION', array('class' => 'span5', 'maxlength' => 1000)) ?>
                        <?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')) ?>
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