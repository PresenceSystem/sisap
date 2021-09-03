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

    <?php echo $form->errorSummary($model) ?>

    <div class="col-md-12">
        
            <label class="row">DESCRIPCIÓN: </label>
            <?php echo $form->textField($model, 'NUMERO', array('class' => 'span7 numeric', 'maxlength' => 150)) ?>
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
                                    $('#botonid').attr("disabled", false);
                                }else{
                                    $('.relato').html('<span class="label label-warning flash-msg"><h2>Cambie su descripción</h2>Esta pertenece a: <strong>'+data[0].APELLIDO+'</strong></span>');
                                    $('.flash-msg').delay(15000).fadeOut('slow');                                   
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

            <?php // echo $form->textFieldRow($model, 'CONSUMO_INICIAL', array('class' => 'span3','default'=>0)) ?>
            <?php echo $form->dropDownListRow($model, 'ID_GRUPO', CHtml::listData(Grupo::model()->findAll(), 'COD_GRUPO', Grupo::representingColumn() ) ) ?>
            <?php // echo $form->textFieldRow($model, 'ORDEN_RECORIDO', array('class' => 'span3','default'=>0)) ?>
        
    </div>
    <div class="form-actions text-center">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'htmlOptions' => array(
                    'id' => 'botonid',
                ),
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