<div class="form">
    <?php
    /** @var GrupoContableController $this */
    /** @var GrupoContable $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'grupo-contable-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

                            <?php echo $form->dropDownListRow($model, 'ID_CLASE', CHtml::listData(ClaseContable::model()->findAll(), 'ID', 'CLASE','CODIGO')) ?>
                        <?php echo $form->textFieldRow($model, 'CODIGO', array('class' => 'span5', 'maxlength' => 50)) ?>
                        <?php echo $form->textFieldRow($model, 'GRUPO', array('class' => 'span5', 'maxlength' => 200)) ?>
                        <?php // echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')) ?>
                        <?php // echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5')) ?>
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