<div class="form">
    <?php
    /** @var SocioMedidorController $this */
    /** @var SocioMedidor $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'socio-medidor-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>
<?php /*
    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>
        */ ?>

    <?php echo $form->errorSummary($model) ?>

                            <?php /*echo $form->dropDownListRow($model, 'CODIGO_SOCIO', CHtml::listData(Socio::model()->findAll(), 'CODIGO', Socio::representingColumn())) ?>
                        <?php echo $form->dropDownListRow($model, 'ID_MEDIDOR', CHtml::listData(Medidor::model()->findAll(), 'ID', Medidor::representingColumn())) ?>
                        <?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')) */ ?>

<?php echo $form->dropDownListRow($model, 'SOLO_ALCANTARILLADO', array(
                             '0'=>'(No) ACOMETIDA CON AGUA POTABLE',
                             '1'=>'(Si) ACOMETIDA SIN AGUA POTABLE',
                             
                            ), array('class' => 'span6')); ?>

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