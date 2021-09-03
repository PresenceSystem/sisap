<div class="form">
    <?php
    /** @var ImpresoraController $this */
    /** @var Impresora $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'impresora-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

                    <?php echo $form->textFieldRow($model, 'COD_IMPRESORA', array('class' => 'span5', 'maxlength' => 11)) ?>
                        <?php echo $form->textFieldRow($model, 'PC', array('class' => 'span5', 'maxlength' => 100)) ?>
                        <?php echo $form->textFieldRow($model, 'IMPRESORA', array('class' => 'span5', 'maxlength' => 100)) ?>
                        <?php echo $form->textFieldRow($model, 'ANCHO', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'ALTO', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'FORMATO', array('class' => 'span5', 'maxlength' => 50)) ?>
                        <?php echo $form->textFieldRow($model, 'MARG_X', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'MARG_y', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'DOC', array('class' => 'span5', 'maxlength' => 1)) ?>
                        <?php echo $form->textFieldRow($model, 'JUNTA_LOCAL', array('class' => 'span5', 'maxlength' => 11)) ?>
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