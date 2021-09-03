<div class="form">
    <?php
    /** @var ParametroController $this */
    /** @var Parametro $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'parametro-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ));
    ?>
    <script>
        $(document).ready(function () {
            $('#btnguardar').hide('fast');
            $('#Parametro_VALOR_MIN').keyup(function () {
                var desde = $('#Parametro_VALOR_MIN').val();
                var hasta = $('#Parametro_VALOR_MAX').val();
                var consumo = $('#Parametro_VALOR_MAX').val() - $('#Parametro_VALOR_MIN').val();
                $('#Parametro_VALOR').val(consumo);
                if (consumo >= 0) {
                     $('#btnguardar').show('fast');
                    $('#mensaje').html("<div class='text-info h3'>Tiene un consumo de: " + consumo + " m³</div>");
                } else {
                    $('#mensaje').html("<div class='text-warning h3'>El valor de consumo es negativo</div>");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#Parametro_VALOR_MAX').keyup(function () {
                var desde = $('#Parametro_VALOR_MIN').val();
                var hasta = $('#Parametro_VALOR_MAX').val();
                var consumo = $('#Parametro_VALOR_MAX').val() - $('#Parametro_VALOR_MIN').val();
                $('#Parametro_VALOR').val(consumo);
                if (consumo >= 0) {
                    $('#btnguardar').show('fast');
                    $('#mensaje').html("<div class='text-info h3'>Tiene un consumo de: " + consumo + " m³</div>");
                } else {
                    $('#mensaje').html("<div class='text-warning h3'>El valor de consumo es negativo</div>");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#Parametro_VALOR').keyup(function () {
                if ($('#Parametro_VALOR').val() > 0)
                {                    
                     $('#btnguardar').show('fast');
                    $('#mensaje').html("");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#Parametro_VALOR').change(function () {
                if ($('#Parametro_VALOR').val() > 0)
                {                    
                    $('#Parametro_VALOR_MIN').val('0');
                    $('#Parametro_VALOR_MAX').val('0');                    
                }
            });
        });
    </script>

    <?php echo $form->errorSummary($model) ?>    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <center> INGRESO DE PARÁMETROS DE CÁLCULO </center>
        </div>
        <div class="panel-body">
            <div class="col-md-3">
                <?php echo $form->textFieldRow($model, 'VALOR_MIN', array('class' => 'span3', 'maxlength' => 6, 'placeholder' => 'Desde ___ m³')) ?>
            </div>
            <div class="col-md-3">
                <?php echo $form->textFieldRow($model, 'VALOR_MAX', array('class' => 'span3', 'maxlength' => 6, 'placeholder' => 'Hasta ___ m³')) ?>
            </div>
            <div class="col-md-3">
                <?php echo $form->textFieldRow($model, 'VALOR', array('class' => 'span3', 'maxlength' => 6, 'placeholder' => 'Total ___ m³', 'label' => 'Consumo (m³)')) ?>
            </div>
            <div class="col-md-3">                            
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'htmlOptions'=>array('id'=>'btnguardar'),                    
                    'type' => 'primary',
                    'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Calcular') : Yii::t('AweCrud.app', 'Save'),
                ));
                ?>                      
            </div>
            <div id="mensaje" class="col-md-12">                 
            </div>
        </div>
    </div>

    <?php $this->endWidget(); ?>
</div>