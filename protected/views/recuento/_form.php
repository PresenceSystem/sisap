<div class="form">
    <?php
    /** @var RecuentoController $this */
    /** @var Recuento $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'recuento-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    

    <?php echo $form->errorSummary($model) ?>

                            <?php //echo $form->dropDownListRow($model, 'ID_CAJA', CHtml::listData(Caja::model()->findAll(), 'ID', Caja::representingColumn())) ?>
                        <?php echo $form->textFieldRow($model, 'UNO', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'CINCO', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'DIEZ', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'VIENTICINCO', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'CINCUENTA', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'UNO_D', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'CINCO_D', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'DIEZ_D', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'VIENTE_D', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'CINCUENTA_D', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'CIEN_D', array('class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'TOTAL', array('class' => 'span5', 'maxlength' => 7)) ?>
                       
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