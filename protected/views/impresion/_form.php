<div class="form">
    <?php
    /** @var ImpresionController $this */
    /** @var Impresion $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'impresion-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

                            <?php echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5', 'maxlength' => 11)) ?>
                        <?php echo $form->textFieldRow($model, 'COD_RECIBO', array('class' => 'span5', 'maxlength' => 11)) ?>
                        <?php echo $form->textFieldRow($model, 'COD_IMPRESORA', array('class' => 'span5', 'maxlength' => 11)) ?>
                        <?php echo $form->textFieldRow($model, 'OBS', array('class' => 'span5', 'maxlength' => 800)) ?>
                        <?php echo $form->checkBoxRow($model, 'TIPO') ?>
                        <?php echo $form->textFieldRow($model, 'COD_JUNTA', array('class' => 'span5', 'maxlength' => 11)) ?>
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