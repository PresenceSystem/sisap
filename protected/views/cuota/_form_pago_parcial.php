<div class="form">
    <?php
    /** @var CuotaController $this */
    /** @var Cuota $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'cuota-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>
    
    <script>
        $(document).ready(function () {
             $('#botonid').attr("disabled", true);   
            $('.abono').on('keyup', function () {
                var abono = parseFloat($('.abono').val());
                var saldo = parseFloat(<?php echo $model_detalle->V_TOTAL ?>);
                var nuevo_saldo = parseFloat(saldo - abono);
                 
               if (nuevo_saldo >0)
               { //  alert(abono); 
                   $('#botonid').attr("disabled", false);                                
                 $('#message1').html('<div class="alert alert-info flash-msg"> SALDO = '+nuevo_saldo+' USD. (Posterior al pago)</div>');
                  $('.flash-msg').delay(5000).fadeOut('slow');
               }
               else
               {
                    $('#botonid').attr("disabled", true);                                
                 $('#message1').html('<div class="alert alert-warning flash-msg"> USTED NO PUEDE CANCELAR MAS DE '+saldo+' USD. </div>');
                  $('.flash-msg').delay(5000).fadeOut('slow');
               }
   
            });
        });
    </script>
                            <?php // echo $form->dropDownListRow($model, 'ID_DETALLE', CHtml::listData(Detalle::model()->findAll(), 'ID', Detalle::representingColumn())) ?>
                        <?php // echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5')) ?>
    <div class="row">
        <div>
            <?php echo $form->textFieldRow($model, 'ABONO', array('class' => 'row span3 abono', 'maxlength' => 6)); ?>
        </div>
        <div class="">
            <div id="message1" class="col-md-7"></div>       
        </div>
    </div>
    
                         <?php echo $form->textAreaRow($model, 'OBSERVACION', array('class' => 'span5 row', 'maxlength' => 1000)) ?>
                       
                <div class="form-actions" id="acciones">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',                        
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
                        'htmlOptions' => array('id' => 'botonid')
		)); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Cancel'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		)); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>