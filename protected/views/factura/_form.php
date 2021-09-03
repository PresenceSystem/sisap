<div class="form">
    <?php
    /** @var FacturaController $this */
    /** @var Factura $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'factura-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

                            <?php //echo $form->dropDownListRow($model, 'ID_MEDIDOR_SOCIO', CHtml::listData(SocioMedidor::model()->findAll(), 'ID', SocioMedidor::representingColumn())) ?>
                        <?php echo $form->textFieldRow($model, 'CONSUMO_ANTERIOR', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'CONSUMO_ACTUAL', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'CONSUMO_CALCULADO', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'MES_COBRO', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'ANIO_COBRO', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5')) ?>
                        <?php echo $form->checkBoxRow($model, 'TIPO') ?>
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