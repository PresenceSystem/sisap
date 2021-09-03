<div class="container-fluid">

    <?php
    /** @var SocioController $this */
    /** @var Socio $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'socio-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ));
    ?>


    <?php echo $form->errorSummary($model) ?>

    <div class="col-md-12 btn-info fondoLogin text-center">
        <div class="col-md-2">
        </div>
        <div class="col-md-6">
            <div class="row span">                   
               <?php echo $form->textFieldRow($model, 'CI', array(
                    'class' => 'span12', 'placeholder' => "CI:0603744123 o RUC:0603744123001, SIN GUIÓN", 'maxlength' => 13,
                    'style' => 'width: 160%;
                                padding: 12px 40px;
                                margin: 18px 0;
                                display: inline-block;
                                border: 1px solid #ccc;
                                border-radius: 4px;
                                box-sizing: border-box;'))
                ?>
            </div>
        </div>

        <div class="col-md-2">
            <br><br>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'success',
                'icon' => 'search',
                'htmlOptions' => array(
                    'id' => 'botonid',
                ),
                'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Buscar') : Yii::t('AweCrud.app', 'Save'),
            ));
            ?>
        </div>

    </div>

<?php $this->endWidget(); ?>

</div>