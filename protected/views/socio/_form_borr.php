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
            <?php echo $form->textFieldRow($model, 'CI', array('labelOptions' => array('label' => 'Cédula de Identidad'), 'class' => 'cedula span-5', 'maxlength' => 13)); ?>
        </div> 
        <br>    
        <div id="message" class="col-md-6"></div>
        <div id="message1" class="col-md-6"></div>
        <script>
            $(document).ready(function () {
                $('.cedula').on('keyup', function () {
                    if (($('.cedula').val().length == 10) || ($('.cedula').val().length == 13)) {
                        $.ajax({
                            type: "POST",
                            url: 'search',
                            data: {
                                cedula: $('.cedula').val()
                            },
                            dataType: 'JSON',
                            success: function (data) {
                                if (data.CODIGO > 0) {
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
                                    $('#botonid').attr("disabled", true);
                                    //$('#message').html("");
                                } else {

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
                                    //$('#botonid').attr("disabled", false);
                                }
                            },
                            error: function () {
                                console.log('No se pudo realizar la consulta ajax');
                            }
                        });
                    } else {

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
                        //$('#botonid').attr("disabled", false);
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('.cedula').on('keyup', function () {
                    if ($('.cedula').val().length > 10) {
                        var ruc = $('.cedula').val();
                        var digito3 = ruc.substring(2, 3);
                        if (digito3 < 6) {
                            var ruc = $('.cedula').val();
                            var cedula = ruc.substring(0, 10);
                            var array = cedula.split("");
                            var num = array.length;
                            var total = 0;
                            var digito = (array[9] * 1);
                            for (i = 0; i < (num - 1); i++)
                            {
                                var mult = 0;
                                if ((i % 2) != 0) {
                                    total = total + (array[i] * 1);
                                }
                                else
                                {
                                    mult = array[i] * 2;
                                    if (mult > 9)
                                        total = total + (mult - 9);
                                    else
                                        total = total + mult;
                                }
                            }
                            var decena = total / 10;
                            decena = Math.floor(decena);
                            decena = (decena + 1) * 10;
                            var final = (decena - total);
                            //document.write('Valor de final es: '+final);
                            //document.write('Valor de digito es: '+digito);
                            var tresfinales = ruc.substring(10, 13);
                            if (tresfinales.toString() != '001') {
                                $('#message1').html('<div class="alert alert-danger flash-msg"> RUC no Valido Persona Natural Ultimos Caracteres.</div>');
                                $('.flash-msg').delay(5000).fadeOut('slow');
                                $('#botonid').attr("disabled", true);
                            } else {
                                if (final == digito) {
                                    $('#message1').html('<div class="alert alert-success flash-msg"> RUC Valido Persona Natural.</div>');
                                    $('#botonid').attr("disabled", false);
                                    $('.flash-msg').delay(5000).fadeOut('slow');
                                }
                                else {
                                    $('#message1').html('<div class="alert alert-danger flash-msg"> RUC no Valido Persona Natural.</div>');
                                    $('.flash-msg').delay(5000).fadeOut('slow');
                                    $('#botonid').attr("disabled", true);
                                }
                            }

                        } else {
                            if (digito3 == 6) {
                                var psuma = 0;
                                var pcadena, p, presiduo, pveri, k;
                                for (k = 0; k < 9; k++) {
                                    if (k == 1) {
                                        pcadena = ruc.substring(k - 1, k);
                                        pcadena = parseInt(pcadena) * 3;
                                        psuma += parseInt(pcadena);
                                    } else {
                                        if (k == 2) {
                                            pcadena = ruc.substring(k - 1, k);
                                            pcadena = parseInt(pcadena) * 2;
                                            psuma += parseInt(pcadena);
                                        } else {
                                            if (k == 3) {
                                                pcadena = ruc.substring(k - 1, k);
                                                pcadena = parseInt(pcadena) * 7;
                                                psuma += parseInt(pcadena);
                                            } else {
                                                if (k == 4) {
                                                    pcadena = ruc.substring(k - 1, k);
                                                    pcadena = parseInt(pcadena) * 6;
                                                    psuma += parseInt(pcadena);
                                                } else {
                                                    if (k == 5) {
                                                        pcadena = ruc.substring(k - 1, k);
                                                        pcadena = parseInt(pcadena) * 5;
                                                        psuma += parseInt(pcadena);
                                                    } else {
                                                        if (k == 6) {
                                                            pcadena = ruc.substring(k - 1, k);
                                                            pcadena = parseInt(pcadena) * 4;
                                                            psuma += parseInt(pcadena);
                                                        } else {
                                                            if (k == 7) {
                                                                pcadena = ruc.substring(k - 1, k);
                                                                pcadena = parseInt(pcadena) * 3;
                                                                psuma += parseInt(pcadena);
                                                            } else {
                                                                if (k == 8) {
                                                                    pcadena = ruc.substring(k - 1, k);
                                                                    pcadena = parseInt(pcadena) * 2;
                                                                    psuma += parseInt(pcadena);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                var tresfinales = ruc.substring(10, 13);
                                if (tresfinales.toString() != '001') {
                                    $('#message1').html('<div class="alert alert-danger flash-msg"> RUC Publica no Valida.</div>');
                                    $('.flash-msg').delay(5000).fadeOut('slow');
                                    $('#botonid').attr("disabled", true);
                                } else {
                                    presiduo = (psuma % 11);
                                    presiduo = 11 - presiduo;
                                    pveri = ruc.substring(8, 9);
                                    if (presiduo != pveri) {
                                        $('#message1').html('<div class="alert alert-danger flash-msg"> Ingreso de RUC público incorrecto </div>');
                                        $('.flash-msg').delay(5000).fadeOut('slow');
                                        $('#botonid').attr("disabled", true);
                                    } else {
                                        $('#message1').html('<div class="alert alert-success flash-msg"> RUC Publico Valido </div>');
                                        $('.flash-msg').delay(5000).fadeOut('slow');
                                        $('#botonid').attr("disabled", false);
                                    }
                                }
                            } else {
                                if (digito3 == 9) {
                                    var jsuma = 0;
                                    var jcadena = 0;
                                    var l, jresiduo, jveri;
                                    for (l = 0; l < 10; l++) {
                                        if (l == 1) {
                                            jcadena = ruc.substring(l - 1, l);
                                            jcadena = parseInt(jcadena) * 4;
                                            jsuma += parseInt(jcadena);
                                        } else {
                                            if (l == 2) {
                                                jcadena = ruc.substring(l - 1, l);
                                                jcadena = parseInt(jcadena) * 3;
                                                jsuma += parseInt(jcadena);
                                            } else {
                                                if (l == 3) {
                                                    jcadena = ruc.substring(l - 1, l);
                                                    jcadena = parseInt(jcadena) * 2;
                                                    jsuma += parseInt(jcadena);
                                                } else {
                                                    if (l == 4) {
                                                        jcadena = ruc.substring(l - 1, l);
                                                        jcadena = parseInt(jcadena) * 7;
                                                        jsuma += parseInt(jcadena);
                                                    } else {
                                                        if (l == 5) {
                                                            jcadena = ruc.substring(l - 1, l);
                                                            jcadena = parseInt(jcadena) * 6;
                                                            jsuma += parseInt(jcadena);
                                                        } else {
                                                            if (l == 6) {
                                                                jcadena = ruc.substring(l - 1, l);
                                                                jcadena = parseInt(jcadena) * 5;
                                                                jsuma += parseInt(jcadena);
                                                            } else {
                                                                if (l == 7) {
                                                                    jcadena = ruc.substring(l - 1, l);
                                                                    jcadena = parseInt(jcadena) * 4;
                                                                    jsuma += parseInt(jcadena);
                                                                } else {
                                                                    if (l == 8) {
                                                                        jcadena = ruc.substring(l - 1, l);
                                                                        jcadena = parseInt(jcadena) * 3;
                                                                        jsuma += parseInt(jcadena);
                                                                    } else {
                                                                        if (l == 9) {
                                                                            jcadena = ruc.substring(l - 1, l);
                                                                            jcadena = parseInt(jcadena) * 2;
                                                                            jsuma += parseInt(jcadena);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    var tresfinales = ruc.substring(10, 13);
                                    if (tresfinales.toString() != '001') {
                                        $('#message1').html('<div class="alert alert-danger flash-msg"> RUC de Persona Juridica no Valida.</div>');
                                        $('.flash-msg').delay(5000).fadeOut('slow');
                                        $('#botonid').attr("disabled", true);
                                    }
                                    else {
                                        jresiduo = (jsuma % 11);
                                        jresiduo = 11 - jresiduo;
                                        jveri = ruc.substring(9, 10);
                                        if (jresiduo != jveri) {
                                            $('#message1').html('<div class="alert alert-danger flash-msg"> Ingreso de RUC incorrecto para persona juridica</div>');
                                            $('.flash-msg').delay(5000).fadeOut('slow');
                                            $('#botonid').attr("disabled", true);
                                        } else {
                                            $('#message1').html('<div class="alert alert-success flash-msg"> RUC valido persona Juridica</div>');
                                            $('.flash-msg').delay(5000).fadeOut('slow');
                                            $('#botonid').attr("disabled", false);
                                        }
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $('.cedula').on('keyup', function () {
                    if ($('.cedula').val() == "") {
                        $('#message').html('<div class="alert alert-danger flash-msg"> Ingrese Cédula o RUC del Socio.</div>');
                        $('.flash-msg').delay(5000).fadeOut('slow');
                        $('#botonid').attr("disabled", true);
                    } else {
                        if ($('.cedula').val().length == 10) {
                            var cedula = $('.cedula').val();
                            var array = cedula.split("");
                            var num = array.length;
                            var total = 0;
                            var digito = (array[9] * 1);
                            for (i = 0; i < (num - 1); i++)
                            {
                                var mult = 0;
                                if ((i % 2) != 0) {
                                    total = total + (array[i] * 1);
                                }
                                else
                                {
                                    mult = array[i] * 2;
                                    if (mult > 9)
                                        total = total + (mult - 9);
                                    else
                                        total = total + mult;
                                }
                            }
                            var decena = total / 10;
                            decena = Math.floor(decena);
                            decena = (decena + 1) * 10;
                            var final = (decena - total);
                            if(final==10)
                                final=final.toString().substr(1, 1);
                            //document.write('Valor de final es: '+final);
                            //document.write('Valor de digito es: '+digito);
                            if (final == digito) {
                                $('#message').html('<div class="alert alert-success flash-msg"> Cédula Correcta.</div>');
                                $('#botonid').attr("disabled", false);
                                $('.flash-msg').delay(5000).fadeOut('slow');
                            }
                            else {
                                $('#message').html('<div class="alert alert-danger flash-msg"> Cédula no valida.</div>');
                                $('.flash-msg').delay(5000).fadeOut('slow');
                                $('#botonid').attr("disabled", true);
                            }
                        }
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