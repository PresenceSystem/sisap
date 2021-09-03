<div class="form">
    <?php
    /** @var TconvocatoriaController $this */
    /** @var Tconvocatoria $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'tconvocatoria-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

        <?php //echo $form->textFieldRow($model, 'FECHA', array('prepend'=>'<i class="icon-calendar"></i>')) ?>
                        <?php echo $form->dropDownListRow($model, 'COD_JUNTA', CHtml::listData(Valvula::model()->findAll(), 'COD_VALVULA', Valvula::representingColumn()), array('prompt' => Yii::t('AweApp', 'None'))) ?>
                        <div class="container">
  
  
</div>
                          <?php echo $form->textAreaRow($model, 'ENCABEZADO', array('class' => 'span5', 'maxlength' => 1000)) ?>
                        <?php echo $form->textAreaRow($model, 'TITULO', array('class' => 'span5', 'maxlength' => 200)) ?>                       
                                    
                             <?php echo $form->dropDownListRow($model, 'TIPO', array( 'a la REUNIÓN por los pagos'=>'REUNION POR PAGOS','a la SESIÓN EXTRAORDINARIA' => 'SESIÓN EXTRAORDINARIA', 'a la SESIÓN' => 'SESIÓN', 'al TRABAJO' => 'TRABAJO', 'a los PAGOS' => 'PAGOS', 'a los COBROS' => 'COBROS', 'a la CONCENTRACIÓN'=>'CONCENTRACIÓN'), array('class' => 'span5', 'maxlength' => 1)) ?>
                            <?php 
                         echo  $form->labelEx($model,'FECHA');
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name' => 'FECHA',
                                     'model' => $model,
                                   'attribute' => 'FECHA',
                                    'language' => 'es',
                                    'htmlOptions' => array( 'class' => 'span3'),   //'htmlOptions' => array('readonly' => "readonly", 'class' => 'span3'),
                                    'options' => array(
                                        'autoSize' => true,
                                        'dateFormat' => 'yy-mm-dd',
                                        'buttonImage' => Yii::app()->baseUrl . '/images/pagina/calendar1.png',
                                        'buttonImageOnly' => true,
                                        'buttonText' => 'FECHA A REALIZARÁR',
                                        'selectOtherMonths' => true,
                                        'showAnim' => 'slide',
                                        'showButtonPanel' => true,
                                        'showOn' => 'button',
                                        'showOtherMonths' => true,
                                        'changeMonth' => 'true',
                                        'changeYear' => 'true',
                                    ),
                                        )
                                );
                        ?>
                        <?php //echo $form->textFieldRow($model, 'HORA', array('class' => 'span5')) ?>
                            <div class="row">
                                <?php echo $form->labelEx($model, 'HORA'); ?>
                                <?php        
                                $horaMin=05;
                                $horaMax=20;        
                                 $this->widget('application.extensions.timepicker.timepicker', array(
                                    'id'=>'HORA',
                                    'model'=>$model,
                                    'name'=>'HORA',
                                    'select'=> 'time',
                                    'language'=>'ru',
                                    'options' => array(
                                    'showOn'=>'focus',
                                        'timeFormat'=>'hh:mm',
                                        'hourMin'=> (int) $horaMin,
                                        'hourMax'=> (int) $horaMax,
                                        'hourGrid'=>2,
                                        'minuteGrid'=>10,
                                    ),
                                ));
                                ?>
                              </div>
                        <?php // echo ' <br>  <b> HORA. </b>  <br> ';
//                        $this->widget('CMaskedTextField', array(
//                            'model' => $model,
//                            'attribute' => 'HORA',
//                            'name' => 'HORA',
//                            'mask' => '99h99',
//                            'htmlOptions' => array('style' => 'width:80px;'),));
                       ?>
                        <?php echo $form->textAreaRow($model, 'CUERPO', array('class' => 'span5', 'maxlength' => 500)) ?>
                        <?php echo $form->textAreaRow($model, 'NOTA', array('class' => 'span5', 'maxlength' => 1000)) ?>
                        <?php echo $form->textFieldRow($model, 'FIRMA', array('class' => 'span5', 'maxlength' => 100)) ?>
                        <?php //echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5', 'maxlength' => 100)) ?>
    
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
<div class="row text-center"> 
    <h2 class="alert-info">A continuación se detalla la estructura de una convocatoria</h2>
    <img src="<?php echo Yii::app()->baseUrl; ?>/images/pagina/Convocatoria.png" width="100%"></div>
