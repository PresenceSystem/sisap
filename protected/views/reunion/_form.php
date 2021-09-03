<div class="form">
    <?php
    /** @var ReunionController $this */
    /** @var Reunion $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'reunion-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

                            <?php echo $form->dropDownListRow($model, 'CODIGO_TIPO', CHtml::listData(TipoReunion::model()->findAll(), 'CODIGO_TIPO', TipoReunion::representingColumn()), array('class' => 'span10 span')) ?>
                        <div class=""> 
                            <?php 
                             echo  $form->labelEx($model,'FECHA');
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'name' => 'FECHA',
                                         'model' => $model,
                                        'attribute' => 'FECHA',
                                        'language' => 'es',
                                        'htmlOptions' => array( 'class' => 'span5'),   //'htmlOptions' => array('readonly' => "readonly", 'class' => 'span3'),
                                        'options' => array(
                                            'autoSize' => true,
                                            'dateFormat' => 'yy-mm-dd',
                                            'buttonImage' => Yii::app()->baseUrl . '/images/pagina/calendar1.png',
                                            'buttonImageOnly' => true,
                                            'buttonText' => 'SELECCIONAR FECHA',
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
                        </div>
                        <?php //echo $form->textFieldRow($model, 'HORA_INGRESO', array('class' => 'span5')) ?>
                        <div class="row ">
                                <?php echo $form->labelEx($model, 'HORA_INGRESO'); ?>
                                <?php        
                                $horaMin=5;
                                $horaMax=22;        
                                 $this->widget('application.extensions.timepicker.timepicker', array(
                                    'id'=>'HORA_INGRESO',
                                    'model'=>$model,
                                    'name'=>'HORA_INGRESO',
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
                        <?php //echo $form->textFieldRow($model, 'HORA_SALIDA', array('class' => 'span5')) ?>
                     
    <?php //echo $form->textFieldRow($model, 'TIEMPO_ESPERA', array('class' => 'span5')) ?>
                        <div class="row">
                                <?php echo $form->labelEx($model, 'TIEMPO_ESPERA'); ?>
                                <?php        
                                $horaMin=0;
                                $horaMax=1;        
                                 $this->widget('application.extensions.timepicker.timepicker', array(
                                    'id'=>'TIEMPO_ESPERA',
                                    'model'=>$model,
                                    'name'=>'TIEMPO_ESPERA',
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
                        <?php echo $form->textFieldRow($model, 'VALOR_ATRASO', array( 'placeholder' => 'Ejm. 2.00','class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'VALOR_FUGA', array('placeholder' => 'Ejm. 5.00','class' => 'span5', 'maxlength' => 5)) ?>
                        <?php echo $form->textFieldRow($model, 'VALOR_FALTA', array('placeholder' => 'Ejm. 10.50','class' => 'span5', 'maxlength' => 5)) ?>
                        <?php //echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5', 'maxlength' => 1)) ?>
                       
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