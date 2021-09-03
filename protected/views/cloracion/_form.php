<div class="form">
    <?php
    /** @var CloracionController $this */
    /** @var Cloracion $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'cloracion-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

                            <?php echo $form->textFieldRow($model, 'LLAVET1', array('class' => 'span5','placeholder' => 'Ej. 100', 'maxlength' => 200)) ?>
                        <?php echo $form->textFieldRow($model, 'LLAVET2', array('class' => 'span5','placeholder' => 'Ej. 20', 'maxlength' => 200)) ?>
                        <?php echo $form->textFieldRow($model, 'TANQUE1', array('class' => 'span5','placeholder' => 'Ej. 80')) ?>
                        <?php echo $form->textFieldRow($model, 'TANQUE2', array('class' => 'span5','placeholder' => 'Ej. 80')) ?>
    <?php echo $form->textFieldRow($model, 'LLAVET3', array('class' => 'span5','placeholder' => 'Ej. 25', 'maxlength' => 200)) ?>
                        <?php echo $form->textFieldRow($model, 'TANQUE3', array('class' => 'span5', 'placeholder' => 'Ej. 100')) ?>
                        <?php echo $form->textFieldRow($model, 'VALVULA_CL', array('class' => 'span5', 'placeholder' => 'Ej. 2.75')) ?>
                        <?php echo $form->textFieldRow($model, 'F_CL', array('class' => 'span5', 'placeholder' => 'Ej. 1.5',)) ?>
                        <?php echo $form->textFieldRow($model, 'PH', array('class' => 'span5', 'placeholder' => 'Ej. 6.5',)) ?>
                        <?php echo $form->textFieldRow($model, 'LLAVE_DISTRIBUCION', array('class' => 'span5', 'placeholder' => 'Ej. 8',)) ?>
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