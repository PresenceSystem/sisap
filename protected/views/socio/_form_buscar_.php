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


    <?php echo $form->errorSummary($model) ?>

    <div class="col-md-12 btn-info fondoLogin text-center">
        <div class="col-md-10">

            <div class="row span">        
                <h5>Buscar: por CI, apellidos o nombres.</h5>

                <!--<a href="../../vertice/create">Ingresar nuevo vertice</a>-->        
                <?php
                if ($model->CODIGO) {
                    $value = $model->APELLIDO;
                } else {
                    // $value = '';
                    $value = '';
                }
                echo $form->hiddenField($model, 'CODIGO', array());
                // echo '<input type="hidden" id="autocomplete" name="autocomplete" value="0" />';
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name' => 'CODIGO',
                    'model' => $model,
                    'value' => $value,
                    'sourceUrl' => $this->createUrl('ListarSociosTodos'),
                    'options' => array(
                        'minLength' => '1',
                        'showAnim' => 'fold',
                        'select' => 'js:function(event, ui)
                                                            { jQuery("#Socio_CODIGO").val(ui.item.id);                                     
                                                            }',
                    ),
                    'htmlOptions' => array(
                        'style' => "font-size: 15px; font-family: Arial,Helvetica,sans-serif; line-height: 30px; height: 25px; width: 100%;"
                    ),
                ));
                ?>
                <br>

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