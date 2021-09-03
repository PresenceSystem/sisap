<div class="form">

    <?php
    /** @var SocioController $this */
    /** @var Socio $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'socio-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ));
    ?>
    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    
    </p>

    <?php echo $form->errorSummary($model) ?>

    <div class="col-md-12">

        <div class="col-md-6">
            <?php echo $form->textFieldRow($model, 'CI', array('labelOptions' => array('label' => 'Cédula de Identidad'),
                                                        'disabled'=>true,'class' => 'cedula span-5', 'maxlength' => 13)); ?>
        </div> 
        <br>    
        <div id="message" class="col-md-6"></div>
        <div id="message1" class="col-md-6"></div>
        <script>
            $(document).ready(function () {
                $('.cedula').on('keyup', function () {
                    if ($('.cedula').val().length >= 10) {
                        $.ajax({
                            type: "POST",
                            url: 'search',
                            data: {
                                cedula: $('.cedula').val()
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                if (data == 0) {
                                    //$('#message').html('<div class="alert alert-info flash-msg"> Ingrese Nombre y Apellido del Solicitante.</div>');
                                    $('.flash-msg').delay(5000).fadeOut('slow');
                                    $('#Socio_APELLIDO').val("");
                                    $('#Socio_APELLIDO').prop('disabled', false);
                                    $('#Socio_GENERO').val("");
                                    $('#Socio_GENERO').prop('disabled', false);
                                    $('#Socio_DIRECCION').val("");
                                    $('#Socio_DIRECCION').prop('disabled', false);
                                    $('#Socio_TELEFONO').val("");
                                    $('#Socio_TELEFONO').prop('disabled', false);
                                    $('#Socio_CELULAR').val("");
                                    $('#Socio_CELULAR').prop('disabled', false);
                                    $('#Socio_EMAIL').val("");
                                    $('#Socio_EMAIL').prop('disabled', false);
                                    $('#Socio_CODIGO').val(0);
                                } else { 
                                    $('#Socio_APELLIDO').val(data.APELLIDO);
                                    $('#Socio_APELLIDO').prop('disabled', true);
                                    $('#Socio_GENERO').val(data.GENERO);
                                    $('#Socio_GENERO').prop('disabled', true);
                                    $('#Socio_DIRECCION').val(data.DIRECCION);
                                    $('#Socio_DIRECCION').prop('disabled', true);
                                    $('#Socio_TELEFONO').val(data.TELEFONO);
                                    $('#Socio_TELEFONO').prop('disabled', true);
                                    $('#Socio_CELULAR').val(data.CELULAR);
                                    $('#Socio_CELULAR').prop('disabled', true);
                                    $('#Socio_EMAIL').val(data.EMAIL);
                                    $('#Socio_EMAIL').prop('disabled', true);
                                    $('#message').html("");
                                }
                            },
                            error: function () {
                                console.log('No se pudo realizar la consulta ajax');
                            }
                        });
                    } else {
                        $('#message').html('<div class="alert alert-warning flash-msg"> La Cédula debe tener 10 digitos.</div>');
                        $('.flash-msg').delay(5000).fadeOut('slow');
                        //$('#CertificadoNombre').val("");
                        //$('#CertificadoNombre').prop('disabled', false);
                        //$('#CertificadoApellido').val("");
                        //$('#CertificadoApellido').prop('disabled', false);
                    }
                });
            });
        </script>

    </div>
    <?php /* echo '    Cédula de Identidad.    <br>';
      $this->widget('CMaskedTextField', array(
      'model' => $model,
      'attribute' => 'CI',
      'name' => 'CI',
      'mask' => '9999999999',
      'htmlOptions' => array('style' => 'width:100px;'),)); */
    ?>
    <div class="col-md-12">
        <div class="col-md-6">
            <?php echo $form->textFieldRow($model, 'APELLIDO', array('labelOptions' => array('label' => 'Nombre Completo'), 'class' => 'span-5', 'placeholder' => 'Cardenaz Ordoñez Juan Manuel')); ?>

            <?php //echo $form->textFieldRow($model, 'COD_BARRA', array('class' => 'span-5', 'maxlength' => 10))  ?>
            <?php //echo $form->dropDownListRow($model, 'TIPO', array('Natural' => 'Natural', 'Jurídica' => 'Jurídica')) ?>
            <?php //echo $form->dropDownListRow($model, 'ESTADO_CIVIL', array('Casado/a' => 'Casado/a', 'Soltero/a' => 'Soltero/a', 'Viudo/a' => 'Viudo/a', 'Divorciado/a' => 'Divorciado/a', 'Union Libre' => 'Union Libre'), array('class' => 'span-5', 'maxlength' => 10)) ?>
            <?php //echo $form->textFieldRow($model, 'NOMBRE_CONYUGE', array('class' => 'span-5', 'maxlength' => 50)) ?>
            <?php //MAYUSCULAS echo $form->textFieldRow($model, 'NOMBRE_CONYUGE', array('class' => 'span-5', 'maxlength' => 50,'style'=>'text-transform:uppercase;'))   ?>
            <br>
            <?php // echo $form->textFieldRow($model, 'FOTO', array('class' => 'span-5', 'maxlength' => 100))    ?>
            <!-- Código para subir foto -->
            <?php /* if ($model->isNewRecord != '1') { ?>

              <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/fotosSocios/' . $model->FOTO, "...", array("width" => 100)); ?>

              <?php } ?>
              <div class="column">
              <?php echo $form->labelEx($model, 'FOTO'); ?>
              <?php echo CHtml::activeFileField($model, 'FOTO'); //con esto levantamos la imagen  ?>
              <?php echo $form->error($model, 'FOTO'); ?>
              </div>
             */ ?>
            <!-- Termina código para subir foto -->
            <?php
            /*
              $form->labelEx($model, 'FECHA_NACIMIENTO');
              $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'name' => 'FECHA_NACIMIENTO',
              'model' => $model,
              'attribute' => 'FECHA_NACIMIENTO',
              'language' => 'es',
              'htmlOptions' => array('class' => 'span6'), //'htmlOptions' => array('readonly' => "readonly", 'class' => 'span-5'),
              'options' => array(
              'autoSize' => true,
              'dateFormat' => 'yy-mm-dd',
              'buttonImage' => Yii::app()->baseUrl . '/images/pagina/calendar1.png',
              'buttonImageOnly' => true,
              'buttonText' => 'SELECCIONAR FECHA DE NACIMIENTO',
              'selectOtherMonths' => true,
              'showAnim' => 'slide',
              'showButtonPanel' => true,
              'showOn' => 'button',
              'showOtherMonths' => true,
              'changeMonth' => 'true',
              'changeYear' => 'true',
              ),
              )
              ); */
            ?>    
            <?php echo $form->dropDownListRow($model, 'GENERO', array('M' => 'Masculino', 'F' => 'Femenino'), array('class' => 'span-5', 'maxlength' => 1)) ?>
            <?php echo $form->textFieldRow($model, 'DIRECCION', array('labelOptions' => array('label' => 'Dirección'), 'class' => 'span-5')); ?>
            <?php echo $form->textFieldRow($model, 'TELEFONO', array('labelOptions' => array('label' => 'Teléfono'), 'class' => 'span-5', 'placeholder' => '072222443', 'maxlength' => 9)); ?>
            <?php echo $form->textFieldRow($model, 'CELULAR', array('class' => 'span-5', 'maxlength' => 10)) ?>    
            <?php echo $form->textFieldRow($model, 'EMAIL', array('class' => 'span-5', 'maxlength' => 50)) ?>
              <?php echo $form->dropDownListRow($model, 'COD_GRUPO', CHtml::listData(Grupo::model()->findAll(), 'COD_GRUPO', Grupo::representingColumnGrupo() ) ) ?>

             <?php echo $form->checkBoxRow($model,'USU_PARTICIPA_COMUNIDAD',  array('checked'=>'checked')); ?>
             <?php echo $form->checkBoxRow($model,'USU_ALCANTARILLADO'); ?>
            <?php $form->textFieldRow($model, 'COD_USUARIO', array('labelOptions' => array('label' => 'Código Usuario'), 'class' => 'span-5', 'value' => Yii::app()->getSession()->get('id_usu'))); ?>
            <?php //echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span-5'))  ?>
        </div>
    </div>
    <div class="col-md-12"> 
        <div class="col-md-3">  
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'ok',
                'htmlOptions' => array(
                    'id' => 'botonid',
                ),
                'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
            ));
            ?>
        </div>
        <div class="col-md-6">	
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                //'buttonType'=>'submit',
                'label' => Yii::t('AweCrud.app', 'Cancel'),
                'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
            ));
            ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>