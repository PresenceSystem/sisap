<div class="form">
    <?php
    /** @var AsistenciaController $this */
    /** @var Asistencia $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'asistencia-form',
    'enableAjaxValidation' => true,
       'focus'=>array($model,'CODIGO_SOCIO'),
        'focus'=>'input:text[value=""]:first',
    'enableClientValidation'=> true,
    )); ?>


    <?php echo $form->errorSummary($model) ?>

                       <?php  echo $form->textFieldRow($model, 'CODIGO_SOCIO', array('placeholder'=>"Solo con lector de código de barra",'class' => 'span10')) ?>     
                        <?php //echo $form->dropDownListRow($model, 'CODIGO_REUNION', CHtml::listData(Reunion::model()->findAll(), 'CODIGO_REUNION', Reunion::representingColumn())) ?>
                        <?php //echo $form->datepickerRow($model, 'FECHA', array('prepend'=>'<i class="icon-calendar"></i>')) ?>
                        <?php //echo $form->textFieldRow($model, 'HORA_INGRESO', array('class' => 'span5')) ?>
                        <?php //echo $form->checkBoxRow($model, 'REGISTRA_INGRESO_PUNTUAL', array('class' => 'row span')) ?>
                        <?php // echo $form->checkBoxRow($model, 'REGISTRA_ATRASO', array('class' => 'row span')) ?>
                        <?php // echo $form->checkBoxRow($model, 'REGISTRA_FUGA', array('class' => 'row span')) ?>
                        <?php // echo $form->checkBoxRow($model, 'REGISTRA_SALIDA_PUNTUAL', array('class' => 'row span')) ?>
                        <?php //echo $form->textAreaRow($model, 'OBSERVACIONES', array('class' => 'row', 'maxlength' => 500)) ?>
                        <?php // echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')) ?>
                        <?php // echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')) ?>
                <div class="form-actions column">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
                        'icon' => 'arrow-right',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Registrar salida y siguiente') : Yii::t('AweCrud.app', 'Save'),
		)); ?>
        <?php /* $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Cancel'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		));*/ ?>
    </div>

     
    <?php $this->endWidget(); ?>
</div>