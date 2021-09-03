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
    'enableClientValidation'=> false,
    )); ?>
	<div class='span0'>
            
  <script>
            $(document).ready(function () {				
                $('.cedula').on('keyup', function () {					
                    if (($('.cedula').val().length >= 10)) {
                        $.ajax({
                            type: "POST",
                            url: '../search',
                            data: {
                                cedula: $('.cedula').val()
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                if (data.CODIGO > 0) {
                                    $('#CODIGO_SOCIO').val(data.CODIGO);
                                    
                                    //$('#Socio_APELLIDO').prop('disabled', true);                                 
									//alert('Encontro');
                                   var registrado = data.MENSAJE;   
                                    $('#message1').html('<div class="alert alert-success flash-msg span10">'+registrado+'</div>');	
                                     $('.cedula').val('');
                                } else {
										$('#message1').html('<div class="alert alert-danger flash-msg span10"> No se encuentra el código de barra'+$('#CODIGO_SOCIO').val()+'</div>');
                                                                                $('.cedula').val('');
										//$('.flash-msg').delay(1000).fadeOut('slow');
                                   //alert('No encontro');
                                    //$('#botonid').attr("disabled", false);
                                }
                                $('.flash-msg').delay(90000).slideUp('slow');
                                
				//window.location.reload(); 
                            },
                            error: function () {
                               // console.log('No se pudo realizar la consulta ajax');
				//				alert();
                                                                $('#message1').html('<div class="alert alert-danger flash-msg span10"> No se puede realizar la consulta ajax con '+$('.cedula').val()+'</div>');
                                                                $('.cedula').val('');
										$('.flash-msg').delay(9000000).fadeOut('slow');
                            }
                        });
                    } else {

                        $('.flash-msg').delay(90000).fadeOut('slow');
                        //$('#Socio_APELLIDO').val("");
                    
                        //$('#botonid').attr("disabled", false);
                    }
                });
            });
        </script>

             		</div>
             

    <?php echo $form->errorSummary($model) ?>
<?php  echo $form->labelEx($model, 'CODIGO_SOCIO'); ?>
<?php  echo $form->textField($model, 'CODIGO_SOCIO', array('placeholder'=>"Solo con lector de código de barra",'class' => 'cedula span10')) ?>                    
<div id="message1" class="col-md-6 flash-msg h2"></div>
    <?php  //          echo $form->dropDownListRow($model, 'CODIGO_SOCIO', CHtml::listData(Socio::model()->findAll(), 'CODIGO', Socio::representingColumn())) ?>
                        <div class="row span">        
                            <?php /* echo $form->labelEx($model, 'CODIGO_SOCIO'); ?>
                            Buscar: por CI, apellidos o nombres.
                            <br> 
                            <!--<a href="../../vertice/create">Ingresar nuevo vertice</a>-->        
                            <?php
                            if ($model->CODIGO_SOCIO) {
                                $value = $model->cODIGOsOCIO->APELLIDO;
                            } else {
                                // $value = '';
                                $value = '';
                            }
                            echo $form->hiddenField($model, 'CODIGO_SOCIO', array());
                            // echo '<input type="hidden" id="autocomplete" name="autocomplete" value="0" />';
                            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                'name' => 'CODIGO_SOCIO',
                                'model' => $model,
                                'value' => $value,
                                // 'attribute' => 'CODIGO',
                                'sourceUrl' => $this->createUrl('socio/ListarSocios'),
                                'options' => array(
                                    'minLength' => '1',
                                    'showAnim' => 'fold',
                                    'select' => 'js:function(event, ui)
                                                                                           { jQuery("#Asistencia_CODIGO_SOCIO").val(ui.item.id); }',
                                //                'search' => 'js:function(event, ui)
                                // { jQuery("#COD_VERTICE").val(1); }'
                                ),
                                'htmlOptions' => array(
                                    'style' => "font-size: 15px; font-family: Arial,Helvetica,sans-serif; line-height: 28px; height: 20px; width: 85%;"
                                ),
                            ));
                            ?>
                            <br>
                            <?php
                            //Nuevo
                    //                                                             $this->widget(
                    //                                                                           'bootstrap.widgets.TbButton',
                    //                                                                           array(
                    //                                                                           'label' => 'Ingresar nuevo socio',                                    
                    //                                                                                'url'=> '/sisbiblio/index.php/socio/create',
                    //                                                                               'icon'=>'user',
                    //                                                                           )
                    //                                                                           );
                        */    ?>
                        </div>
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
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Registrar y siguiente') : Yii::t('AweCrud.app', 'Save'),
		)); ?>
        <?php /* $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Cancel'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		));*/ ?>
    </div>

     
    <?php $this->endWidget(); ?>
</div>