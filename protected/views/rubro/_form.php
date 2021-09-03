<div class="form">
    <?php
    /** @var RubroController $this */
    /** @var Rubro $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'rubro-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
    <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

<?php echo $form->errorSummary($model) ?>

    <div class="row">        
        <b>Subcuenta:</b> buscar por código o subcuenta contable.
        <br>             
        <?php
        if ($model->ID_SUBCUENTA) {
            $value = $model->iDSUBCUENTA->SUBCUENTA;
        } else {
            // $value = '';
            $value = '';
        }
        echo $form->hiddenField($model, 'ID_SUBCUENTA', array());
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'ID_SUBCUENTA',
            'model' => $model,
            'value' => $value,
            'sourceUrl' => $this->createUrl('subcuentaContable/ListarSubcuentas'),
            'options' => array(
                'minLength' => '1',
                'showAnim' => '',
                'select' => 'js:function(event, ui)
                 { jQuery("#Rubro_ID_SUBCUENTA").val(ui.item.id); }',
            ),
            'htmlOptions' => array(
                'style' => "font-size: 15px; font-family: Arial,Helvetica,sans-serif; height: 35px; width: 90%; text-align: left;"
            ),
        ));
        ?>
        <br>
        <?php
        //Nuevo
//                                                             $this->widget(
//                                                                           'bootstrap.widgets.TbButton',
//                                                                           array(
//                                                                           'label' => 'Ingresar nueva cuenta',                                    
//                                                                                'url'=> '/index.php/subcuenta/ingresarCuenta',
//                                                                               'icon'=>'user',
//                                                                           )
//                                                                           );
        ?>
    </div>

    <?php echo $form->textFieldRow($model, 'DESCRIPCION', array('class' => 'span5', 'maxlength' => 100)) ?>
    <?php echo $form->textFieldRow($model, 'V_UNITARIO', array('class' => 'span5', 'placeholder' => 'Ejm: 20.50', 'maxlength' => 6)) ?>
    <?php //echo $form->textFieldRow($model, 'PORCEN', array('class' => 'span5')) ?>
    <?php
//                         echo $form->dropDownListRow($model, 'PORCEN', array('Seleccione: __ %', 
//                                                 '1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
//                                                '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
//                                                '21', '22', '23', '24', '25', '26', '27', '28', '29', '30',
//                                                '31', '32', '33', '34', '35', '36', '37', '38', '39', '40',
//                                                '41', '42', '43', '44', '45', '46', '47', '48', '49', '50',
//                                                '51', '52', '53', '54', '55', '56', '57', '58', '59', '60',
//                                                '61', '62', '63', '64', '65', '66', '67', '68', '69', '70',
//                                                '71', '72', '73', '74', '75', '76', '77', '78', '79', '80',
//                                                '81', '82', '83', '84', '85', '86', '87', '88', '89', '90',
//                                                '91', '92', '93', '94', '95', '96', '97', '98', '99', '100'
//                            ));
    ?>
    <?php
    //echo $form->textFieldRow($model, 'FEC_CREACION', array('prepend'=>'<i class="icon-calendar"></i>')) 
//                         echo  $form->labelEx($model,'FEC_CREACION');
//                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                                    'name' => 'FEC_CREACION',
//                                     'model' => $model,
//                                    'attribute' => 'FEC_CREACION',
//                                    'language' => 'es',
//                                    'htmlOptions' => array( 'class' => 'span2'),   //'htmlOptions' => array('readonly' => "readonly", 'class' => 'span3'),
//                                    'options' => array(
//                                        'autoSize' => true,
//                                        'dateFormat' => 'yy-mm-dd',
//                                        'buttonImage' => Yii::app()->baseUrl . '/images/pagina/calendar1.png',
//                                        'buttonImageOnly' => true,
//                                        'buttonText' => 'SELECCIONAR FECHA DEL EVENTO O DE CREACIÓN.<br><b> NOTA:</b> El interes aplica desde esta fecha',
//                                        'selectOtherMonths' => true,
//                                        'showAnim' => 'slide',
//                                        'showButtonPanel' => true,
//                                        'showOn' => 'button',
//                                        'showOtherMonths' => true,
//                                        'changeMonth' => 'true',
//                                        'changeYear' => 'true',
//                                    ),
//                                        )
//                                );
//                        
    ?>
    <?php
    echo $form->dropDownListRow($model, 'TIPO', array(
        '1' => 'Factura',
        '2' => 'Recibo',
    ));
    ?>
    <script>
        $(document).ready(function () {
            $('#seleccionar_quien_aplica').hide("fast");
            $('#seleccionar_mora').show("fast");
            $('#mensaje').html('<div class="alert alert-info flash-msg"><center><strong> Nota: </strong> Al no aplicar mora el sistema le permite pagar en cuotas siempre y cuando se respalde con un documento escrito</center></div>');
            $('#Rubro_TIPO').on('change', function () {
                // seleccion
                var posicion = document.getElementById('Rubro_TIPO').options.selectedIndex; //posicion
                var cadena = document.getElementById('Rubro_TIPO').options[posicion].text;

                if (cadena == 'Factura')
                {
                    $('#seleccionar_mora').show("fast");
                    $('#seleccionar_quien_aplica').hide("fast");
                } else
                {
                    $('#seleccionar_mora').hide("fast");
                    $('#seleccionar_quien_aplica').show("fast");
                }
            });
        });
    </script> 
    <div id='seleccionar_mora'>
        <?php
//        echo $form->dropDownListRow($model, 'MORA', array(
//            '1' => 'Si',
//            '0' => 'No',
//        ));
        ?>
    </div>
    <div id='seleccionar_quien_aplica'>
<?php
echo $form->dropDownListRow($model, 'APLICA', array(
    '0' => 'JAAPA San Vicente de Lacas',
    '2' => 'Comunidad "San Vicente de Lacas"',
));
?>
    </div>
    <script>
        $(document).ready(function () {
            $('#cuotas_plazo').hide("fast");
            $('#mensaje').html('<div class="alert alert-info flash-msg"><center><strong> Nota: </strong> Al no aplicar mora el sistema le permite pagar en cuotas siempre y cuando se respalde con un documento escrito</center></div>');
            $('#Rubro_MORA').on('change', function () {
                // seleccion
                var posicion = document.getElementById('Rubro_MORA').options.selectedIndex; //posicion
                var cadena = document.getElementById('Rubro_MORA').options[posicion].text;

                if (cadena == 'No')
                {
                    $('#cuotas_plazo').show("fast");
                } else
                {
                    $('#cuotas_plazo').hide("fast");
                }
            });
        });
    </script> 
    <script>
        $(document).ready(function () {
            $('#Rubro_PLAZOS').on('change', function () {
                //Mes seleccionado
                var posicion = document.getElementById('Rubro_PLAZOS').options.selectedIndex; //posicion del medidor
                var cadena = document.getElementById('Rubro_PLAZOS').options[posicion].text;
                var resultado = cadena.split(" ", 1);
                var letras = resultado[0];
                var total = $('#Rubro_V_UNITARIO').val();
                if (total > 0 && letras > 0)
                {
                    $('#Rubro_VALOR_LETRA').val(total / letras);
                    $('#Rubro_SALDO').val(total);
                } else
                {
                    $('#Rubro_VALOR_LETRA').val('0');
                    $('#Rubro_SALDO').val('0');
                }
            });
        });
    </script>   
    <div id='cuotas_plazo'>
        <div id='mensaje'></div>
        <?php
        echo $form->dropDownListRow($model, 'PLAZOS', array(
            '0' => 'NO APLICA',
            '1' => '1 MES',
            '2' => '2 MESES',
            '3' => '3 MESES',
            '4' => '4 MESES',
            '5' => '5 MESES',
            '6' => '6 MESES',
            '7' => '7 MESES',
            '8' => '8 MESES',
            '9' => '9 MESES',
            '10' => '10 MESES',
            '11' => '11 MESES',
            '12' => '12 MESES',
            '18' => '18 MESES',
            '24' => '24 MESES',
        ));
        ?>
        <?php echo $form->textFieldRow($model, 'VALOR_LETRA', array('class' => 'span2', 'disabled' => true)); ?>
<?php echo $form->textFieldRow($model, 'SALDO', array('class' => 'span2', 'disabled' => true)); ?>
    </div>
    <div class="form-actions">
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'submit',
    'type' => 'primary',
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