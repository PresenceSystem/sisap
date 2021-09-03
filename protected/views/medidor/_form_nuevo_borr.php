<div class="form">
    <?php
    /** @var MedidorController $this */
    /** @var Medidor $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'medidor-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

    <div class="col-md-12">
        <div class="col-md-6">
            <?php echo $form->textFieldRow($model, 'NUMERO', array('class' => 'span3 numeric', 'maxlength' => 20)) ?>
            <span class="relato"></span>
            <script>
                $(document).ready(function () {
                    $('.numeric').on('keyup', function () {
                        $.ajax({
                            type: "POST",
                            url: '../search',
                            data: {
                                numero: $('.numeric').val()
                            },
                            dataType: 'JSON',
                            success: function (data) {
                               // if(data=== {}){
                                if(data[0] == null){
                                     $('.relato').html('<span class="label label-success flash-msg"></strong></span>');
                                    $('#Medidor_CONSUMO_INICIAL').val("");
                                    $('#Medidor_CONSUMO_INICIAL').prop('disabled', false);
                                    $('#Medidor_ORDEN_RECORIDO').val("");
                                    $('#Medidor_ORDEN_RECORIDO').prop('disabled', false);
                                    $('#botonid').attr("disabled", false);
                                }else{
                                    $('.relato').html('<span class="label label-success flash-msg">Medidor Pertenece a: <strong>'+data[0].APELLIDO+'</strong></span>');
                                    $('.flash-msg').delay(7000).fadeOut('slow');
                                    $('#Medidor_CONSUMO_INICIAL').val(data[0].CONSUMO_INICIAL);
                                    $('#Medidor_CONSUMO_INICIAL').prop('disabled', true);
                                    $('#Medidor_ORDEN_RECORIDO').val(data[0].ORDEN_RECORIDO);
                                    $('#Medidor_ORDEN_RECORIDO').prop('disabled', true);
                                    $('#botonid').attr("disabled", true);
                                }
                            },
                            error: function () {
                                console.log('No se pudo realizar la consulta ajax');
                            }
                        });
                    });
                });
            </script>

            <?php echo $form->textFieldRow($model, 'CONSUMO_INICIAL', array('class' => 'span3')) ?>
            <?php echo $form->textFieldRow($model, 'ORDEN_RECORIDO', array('class' => 'span3')) ?>
        </div>    
        <div class="col-md-6">

        </div>
    </div>
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'htmlOptions' => array(
                    'id' => 'botonid',
                ),
            'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
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