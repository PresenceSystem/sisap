<div class="form">
    <?php
    /** @var AcometidaAlcantarilladoController $this */
    /** @var AcometidaAlcantarillado $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'acometida-alcantarillado-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ));
  //  echo 'AQUI EL NUMERO: '.$id;
    ?>

  

    <?php echo $form->errorSummary($model) ?>

    <?php echo $form->dropDownListRow($model, 'ID_SOCIO_MEDIDOR', CHtml::listData(SocioMedidor::model()->findAllBySql($sql), 'ID', SocioMedidor::representingColumn())) ?>
    <?php
    // echo CHtml::link('NO ASOCIAR A UN MEDIDOR DE AGUA', ['/medidor/solo_alcantarillado', id => $id], ['class'=>'btn btn-info pull-center', 'style' => 'padding-right:10px;']);
    //echo CHtml::link('NUEVO MEDIDOR', '', array('onclick' => '', 'class' => 'badge')); ?>
    <span class="relato row"></span>
    <script>
                $(document).ready(function () {
//                    Buscar datos del valor inicialmente
                    $.ajax({
                            type: "POST",
                            url: '../search',
                            data: {
                                socio_medidor: $('#AcometidaAlcantarillado_ID_SOCIO_MEDIDOR').val()
                            },
                            dataType: 'JSON',
                            success: function (data) {
//                                                        $('.relato').html('<span class="label label-success flash-msg">Medidor Pertenece a: <strong>NOCCC</strong></span>');
//                                    $('.flash-msg').delay(7000).fadeOut('slow');
                               // if(data=== {}){
                                if(data[0] == null){
                                     $('.relato').html('<span class="label label-info flash-msg"><h3>El medidor ya tiene otro propietario activo</h3></span>');
//                                    $('#Medidor_CONSUMO_INICIAL').val("");
//                                    $('#Medidor_CONSUMO_INICIAL').prop('disabled', false);                                 
                                 //   $('.yt0').attr("disabled", false);
                                }else{
                                    $('.relato').html('<span class="label label-success flash-msg"><strong><h4>'+data[0].DESCRIPCION+'</h4><h4>'+data[0].APELLIDO+'</h4></strong></span>');
                                 //   $('.flash-msg').delay(15000).fadeOut('slow');
//                                    $('#Medidor_CONSUMO_INICIAL').val(data[0].CONSUMO_INICIAL);
//                                    $('#Medidor_CONSUMO_INICIAL').prop('disabled', true);
//                                    $('#Medidor_ORDEN_RECORIDO').val(data[0].ORDEN_RECORIDO);
//                                    $('#Medidor_ORDEN_RECORIDO').prop('disabled', true);
                                 //   $('.yt0').attr("disabled", true);
                                }
                            },
                            error: function () {
                                console.log('No se pudo realizar la consulta ajax');
                            }
                        });
//                    Fin de buscar datos del valor inicial
                    
                    $('#AcometidaAlcantarillado_ID_SOCIO_MEDIDOR').on('change', function () {

                        $.ajax({
                            type: "POST",
                            url: '../search',
                            data: {
                                socio_medidor: $('#AcometidaAlcantarillado_ID_SOCIO_MEDIDOR').val()
                            },
                            dataType: 'JSON',
                            success: function (data) {
//                                                        $('.relato').html('<span class="label label-success flash-msg">Medidor Pertenece a: <strong>NOCCC</strong></span>');
//                                    $('.flash-msg').delay(7000).fadeOut('slow');
                               // if(data=== {}){
                                if(data[0] == null){
                                     $('.relato').html('<span class="label label-info flash-msg"><h3>El medidor ya tiene otro propietario activo</h3></span>');
//                                    $('#Medidor_CONSUMO_INICIAL').val("");
//                                    $('#Medidor_CONSUMO_INICIAL').prop('disabled', false);                                 
//                                    $('#botonid').attr("disabled", false);
                                }else{
                                    $('.relato').html('<span class="label label-success flash-msg"><strong><h4>'+data[0].DESCRIPCION+'</h4><h4>'+data[0].APELLIDO+'</h4></strong></span>');
                                 //   $('.flash-msg').delay(15000).fadeOut('slow');
//                                    $('#Medidor_CONSUMO_INICIAL').val(data[0].CONSUMO_INICIAL);
//                                    $('#Medidor_CONSUMO_INICIAL').prop('disabled', true);
//                                    $('#Medidor_ORDEN_RECORIDO').val(data[0].ORDEN_RECORIDO);
//                                    $('#Medidor_ORDEN_RECORIDO').prop('disabled', true);
//                                    $('#botonid').attr("disabled", true);
                                }
                            },
                            error: function () {
                                console.log('No se pudo realizar la consulta ajax');
                            }
                        });
                    });
                });
            </script>
    <?php //echo $form->dropDownListRow($model, 'ID_GRUPO', CHtml::listData(Grupo::model()->findAll(), 'COD_GRUPO', Grupo::representingColumn())) ?>
    <?php echo $form->dropDownListRow($model, 'ESTADO', array('Activo' => 'Activo', 'Pasivo' => 'Pasivo'), array('class' => 'span10 span')) ?>
            <?php echo $form->textFieldRow($model, 'DESCRIPCION', array('class' => 'span10', 'placeholder' => "Ingrese el estado de la acometida del alcantarillado u otro detalle que necesita almacenar", 'maxlength' => 800)) ?>
  
<script>
        $(document).ready(function () {
            //alert('desactivar');           
            if ($('#AcometidaAlcantarillado_INACTIVO').prop('checked')) {                  
                    document.getElementById('motivo_inactivo').style.display = 'block';   }
                else
                {    document.getElementById('motivo_inactivo').style.display = 'none';   }
            $('#AcometidaAlcantarillado_INACTIVO').on('change', function () {
                if ($('#AcometidaAlcantarillado_INACTIVO').prop('checked')) {                  
                    document.getElementById('motivo_inactivo').style.display = 'block';   }
                else
                {    document.getElementById('motivo_inactivo').style.display = 'none';   }
                
            });
        });
    </script>
   <?php echo $form->checkBoxRow($model, 'INACTIVO', array('class' => '', 'maxlength' => 10)) ?>
    <div id="motivo_inactivo">
        <?php echo $form->textAreaRow($model, 'INACTIVO_DESCRIPCION', array('class' => 'span10', 'maxlength' => 50)) ?>
    </div>

    

        <?php
        echo $form->labelEx($model, 'FECHA_INGRESO');
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'FECHA_INGRESO',
            'model' => $model,
            'attribute' => 'FECHA_INGRESO',
            'language' => 'es',
            'htmlOptions' => array('class' => 'span3'), //'htmlOptions' => array('readonly' => "readonly", 'class' => 'span10'),
            'options' => array(
                'autoSize' => true,
                'dateFormat' => 'yy-mm-dd',
                'buttonImage' => Yii::app()->baseUrl . '/images/pagina/calendar1.png',
                'buttonImageOnly' => true,
                'buttonText' => 'CAMBIAR FECHA DE INGRESO',
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
        <?php
//        echo $form->labelEx($model, 'FECHA_SALIDA');
//        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//            'name' => 'FECHA_SALIDA',
//            'model' => $model,
//            'attribute' => 'FECHA_SALIDA',
//            'language' => 'es',
//            'htmlOptions' => array('class' => 'span8'), //'htmlOptions' => array('readonly' => "readonly", 'class' => 'span10'),
//            'options' => array(
//                'autoSize' => true,
//                'dateFormat' => 'yy-mm-dd',
//                'buttonImage' => Yii::app()->baseUrl . '/images/pagina/calendar1.png',
//                'buttonImageOnly' => true,
//                'buttonText' => 'CAMBIAR FECHA DE POSIBLE SALIDA',
//                'selectOtherMonths' => true,
//                'showAnim' => 'slide',
//                'showButtonPanel' => true,
//                'showOn' => 'button',
//                'showOtherMonths' => true,
//                'changeMonth' => 'true',
//                'changeYear' => 'true',
//            ),
//                )
//        );
        ?>  

  

    <div class="form-actions text-center">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Guardar') : Yii::t('AweCrud.app', 'Save'),
        ));
        ?>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            //'buttonType'=>'submit',
            'label' => Yii::t('AweCrud.app', 'Cancel'),
            'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
        ));
        ?>
    </div>

<?php $this->endWidget(); ?>
</div>