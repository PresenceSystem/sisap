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
                        <?php echo $form->dropDownListRow($model, 'COD_JUNTA', CHtml::listData(Junta::model()->findAll(" t.COD_JUNTA>=0 order by t.SECTOR_NOMBRE"), 'COD_JUNTA', Junta::representingColumn()), array('prompt' => Yii::t('AweApp', 'None'))) ?>
<!--                        <div class="container">
  
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">CONVOCATORIA CONVINADA CON OTRA JUNTA LOCAL</button>
  <div id="demo" class="collapse success">
      <h3 class="alert-info">EL SISTEMA LE PERMITE COMBINAR CON UNA O DOS JUNTAS MAS Y SACAR UNA SOLA CONVOCATORIA</h3>
      <?php // echo $form->dropDownListRow($model, 'COD_JUNTA_1', CHtml::listData(Junta::model()->findAll(), 'COD_JUNTA', Junta::representingColumn()), array('prompt' => Yii::t('AweApp', 'None'))) ?>
      <?php // echo $form->dropDownListRow($model, 'COD_JUNTA_2', CHtml::listData(Junta::model()->findAll(), 'COD_JUNTA', Junta::representingColumn()), array('prompt' => Yii::t('AweApp', 'None'))) ?>
                      
  </div>
</div>-->
                          <?php echo $form->textAreaRow($model, 'ENCABEZADO', array('class' => 'span5', 'maxlength' => 1000)) ?>
                        <?php echo $form->textAreaRow($model, 'TITULO', array('class' => 'span5', 'maxlength' => 200)) ?>                       
                                    
                      

                        <?php echo $form->textAreaRow($model, 'CUERPO', array('class' => 'span9', 'maxlength' => 500)) ?>
                        <?php echo $form->textAreaRow($model, 'NOTA', array('class' => 'span5', 'maxlength' => 1000)) ?>
                        <?php echo $form->textFieldRow($model, 'FIRMA', array('class' => 'span5', 'maxlength' => 100)) ?>
                        <?php //echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5', 'maxlength' => 100)) ?>



<div class="row form">
<div class='badge badge-info text-center'>
	<center><h4>CONFIGURAR GENERADOR</h4></center>
</div>
        <?php
    echo $form->labelEx($model, 'FECHA_INICIA');
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'name' => 'FECHA_INICIA',
        'model' => $model,
        'attribute' => 'FECHA_INICIA',
        'language' => 'es',
        'htmlOptions' => array('class' => 'span3'), //'htmlOptions' => array('readonly' => "readonly", 'class' => 'span3'),
        'options' => array(
            'autoSize' => true,
            'dateFormat' => 'yy-mm-dd',
            'buttonImage' => Yii::app()->baseUrl . '/images/pagina/calendar1.png',
            'buttonImageOnly' => true,
            'buttonText' => 'FECHA QUE INICIA LA VALIDACIÓN DE DATOS',
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
    </diV>
    
    <h4 class="badge-success text-center">  DÍAS PROGRAMADOS PARA LA VALIDACIÓN DE DATOS </h4>
    <?php echo $form->checkBoxRow($model, 'LUNES') ?>
    <?php echo $form->checkBoxRow($model, 'MARTES') ?>
    <?php echo $form->checkBoxRow($model, 'MIERCOLES') ?>
    <?php echo $form->checkBoxRow($model, 'JUEVES') ?>
    <?php echo $form->checkBoxRow($model, 'VIERNES') ?>
    <?php echo $form->checkBoxRow($model, 'SABADO') ?>
    <?php echo $form->checkBoxRow($model, 'DOMINGO') ?>           
    <table>
        <tr>
            <td>
                <div class="row">
                                <?php echo $form->labelEx($model, 'HORA_INICIA'); ?>
                                <?php        
                                $horaMin=7;
                                $horaMax=17;        
                                 $this->widget('application.extensions.timepicker.timepicker', array(
                                    'id'=>'HORA_INICIA',
                                    'model'=>$model,
                                    'name'=>'HORA_INICIA',
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
            </td>
            <td>
                <div class="row">
                                <?php echo $form->labelEx($model, 'HORA_INICIA_RECESO'); ?>
                                <?php        
                                $horaMin=10;
                                $horaMax=15;        
                                 $this->widget('application.extensions.timepicker.timepicker', array(
                                    'id'=>'HORA_INICIA_RECESO',
                                    'model'=>$model,
                                    'name'=>'HORA_INICIA_RECESO',
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
            </td>
            <td>
                <div class="row">
                                <?php echo $form->labelEx($model, 'HORA_TERMINA_RECESO'); ?>
                                <?php        
                                $horaMin=11;
                                $horaMax=17;        
                                 $this->widget('application.extensions.timepicker.timepicker', array(
                                    'id'=>'HORA_TERMINA_RECESO',
                                    'model'=>$model,
                                    'name'=>'HORA_TERMINA_RECESO',
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
            </td>
            <td>
                <div class="row">
                                <?php echo $form->labelEx($model, 'HORA_SALE'); ?>
                                <?php        
                                $horaMin=9;
                                $horaMax=18;        
                                 $this->widget('application.extensions.timepicker.timepicker', array(
                                    'id'=>'HORA_SALE',
                                    'model'=>$model,
                                    'name'=>'HORA_SALE',
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
            </td>
        </tr>
    </table>
                <div class="row">
                                <?php echo $form->labelEx($model, 'TIEMPO_ATENCION'); ?>
                                <?php        
                                $horaMin=0;
                                $horaMax=1;        
                                 $this->widget('application.extensions.timepicker.timepicker', array(
                                    'id'=>'TIEMPO_ATENCION',
                                    'model'=>$model,
                                    'name'=>'TIEMPO_ATENCION',
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
    <?php echo $form->dropDownListRow($model, 'NUMERO_CAJAS', array(
                        '1' => '1', '2' => '2', '3' => '3' )
                            , array('class' => 'span row')); ?>    


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
<?php /*
<div class="row text-center"> 
    <h2 class="alert-info">A continuación se detalla la estructura de una convocatoria</h2>
    <img src="<?php echo Yii::app()->baseUrl; ?>/images/pagina/Convocatoria.png" width="100%"></div>
*/ ?>