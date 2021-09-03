<div class="form">
    <?php
    /** @var SocioMedidorController $this */
    /** @var SocioMedidor $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'socio-medidor-form-factura',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'focus' => array($model, 'CODIGO_SOCIO'),
        'focus' => 'input:text[value=""]:first',
    ));
    ?>

    <?php echo $form->errorSummary($model) ?>

    <?php //echo $form->dropDownListRow($model, 'CODIGO_SOCIO', CHtml::listData(Socio::model()->findAll(), 'CODIGO', Socio::representingColumn()))  ?>                    
    <div class="col-md-12 btn-primary fondoLogin text-center">
        <div class="col-xs-9">
            <div class="row span">        
                <h5>Buscar: por CI, apellidos o nombres.</h5>

                <!--<a href="../../vertice/create">Ingresar nuevo vertice</a>-->        
                <?php
                if ($model->CODIGO_SOCIO) {
                    $value = $model->cODIGOSOCIO->APELLIDO;
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
                    'sourceUrl' => $this->createUrl('socio/ListarSocios'),
                    'options' => array(
                        'minLength' => '1',
                        'showAnim' => 'fold',
                        'select' => 'js:function(event, ui)
                                    { jQuery("#SocioMedidor_CODIGO_SOCIO").val(ui.item.id);                                     
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
        <div class="col-xs-1">
            <br><br>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
               // 'buttonType' => 'submit',
                'type' => 'success',
                'icon' => 'search',
                'htmlOptions' => array(
                    'id' => 'botonBuscar',
                ),
                'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Buscar') : Yii::t('AweCrud.app', 'Save'),
            ));
            ?>
        </div>
        <div class="col-xs-2">
            <br><br>
             <?php
            $this->widget('bootstrap.widgets.TbButton', array(
               // 'buttonType' => 'submit',
                'type' => 'default',
               // 'icon' => 'flash',
                'htmlOptions' => array(
                    'id' => 'btnlimpiar',
                ),
                'label' =>  'Limpiar',
            ));
            ?>
        </div>

    </div>


<script>
        $(document).ready(function () {
            //$('#rbdetalletotal').prop('checked', true);
            $('#btnlimpiar').click(function () {
               // alert('NOOOO');
               $('#encabezado').hide('fast');
               $('#opciones').hide('fast');
               $('#listado').hide('fast');
               $('#totales').hide('fast');
               $('#btnpagar').hide('fast');
                 $('#CODIGO_SOCIO').val('');
                 $('#CODIGO_SOCIO').focus();
            });
        });</script>







    <!-- LLenar encabezado-->
    <script>
        $(document).ready(function () {
            $('#encabezado').hide("fast");
            $('#listado').hide("fast");
            $('#opciones').hide('fast');
            $('#totales').hide('fast');
            $('#btnpagar').hide('fast');
            $('#CODIGO_SOCIO').on('change', function () {
                if ($('#SocioMedidor_CODIGO_SOCIO').val() > 0) {
                    $.ajax({
                        type: "POST",
                        url: 'encabezadofactura',
                        data: {
                            socio: $('#SocioMedidor_CODIGO_SOCIO').val()
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            if (data[0] != null) {
                                $('#encabezado').show('fast');
                                $('#opciones').show('fast');
                                $('#detalles').show('fast');
                                $('#totales').show('fast');
                                $('#cedula').val(data[0].CI);
                                $('#apellido').val(data[0].APELLIDO);
                                $('#medidor').val(data[0].NUMERO);
                                $('#consumoanterior').val(data[0].CONSUMO_ANTERIOR);
                                $('#consumoactual').val(data[0].CONSUMO_ACTUAL);
                                $('#consumocalculado').val(data[0].CONSUMO_CALCULADO);
                                //$('#total').val(data[0].TOTAL);
                            } else
                            {
                                $('#encabezado').hide('fast');
                                $('#opciones').hide('fast');
                                $('#detalles').hide('fast');
                                $('#totales').hide('fast');
                                $('#btnpagar').hide('fast');
                                $('#listado').html('<div class="alert alert-warning flash-msg"><center><strong> ¡Atención!</strong> El socio no tiene un medidor asignado.</center></div>');

                            }
                        },
                        error: function () {
                            console.log('No se pudo realizar la consulta ajax');
                        }
                    });
                }
            });
        });
    </script>

    <div class="col-xs-12">
        <div id="encabezado" class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><center>FACTURACIÓN DE AGUA POTABLE</center></h3>
            </div>
            <div class="panel-body">
                <div class="col-xs-6">
                    <span id="lbcedula" class="badge label label-celeste-claro">CI/RUC:</span>
                    <input id="cedula" name="cedula" disabled="true" class="form-control"/>
                    <span id="lbapellido" class="badge label label-celeste-claro">NOMBRES: </span>
                    <input id="apellido" name="apellido" disabled="true" size="100%" class="form-control"/>
                    <span id="lbmedidor" class="badge label label-celeste-claro">MEDIDOR N°: </span>
                    <input id="medidor" name="medidor" disabled="true" size="50%" class="form-control"/>
                </div>
                <div class="col-xs-6">
                    <span id="lbconsumoanterior" class="badge label label-celeste-claro">CONSUMO MES ANTERIOR: </span>
                    <input id="consumoanterior" name="consumoanterior" disabled="true" size="100%" class="form-control"/>
                    <span id="lbconsumoactual" class="badge label label-celeste-claro">CONSUMO MES ACTUAL: </span>
                    <input id="consumoactual" name="consumoactual" disabled="true" size="50%" class="form-control"/>
                    <span id="lbconsumoresultado" class="badge label label-celeste-claro">CONSUMO  RESULTADO:</span>
                    <input id="consumocalculado" name="consumocalculado" disabled="true" class="form-control"/>
                </div>

            </div>
        </div>
    </div>
    <div class="text-center" id="opciones">
        <input type="radio" id="rbdetalletotal" name="tipos" value="todo" > Detalle Total &nbsp;&nbsp;&nbsp;&nbsp; 
        <input type="radio" id="rbfactura" name="tipos" value="factura"> Factura &nbsp;&nbsp;&nbsp;&nbsp;          
        <input type="radio" id="rbnotaventa" name="tipos" value="notaventa"> Nota de Venta
    </div>

    <!--****************************************************************************-->
    <!--****************************************************************************-->
    <!--DETALLES-->
    <!--****************************************************************************-->
    <!--****************************************************************************-->


    <!--Llenar detalle por defecto TODOS -->
    <script>
        $(document).ready(function () {
            $('#rbdetalletotal').prop('checked', true);
            $('#CODIGO_SOCIO').on('change', function () {
                $.ajax({
                    type: "POST",
                    url: 'detallefactura',
                    data: {
                        socio: $('#SocioMedidor_CODIGO_SOCIO').val()
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data[0] == null) {
                            $('#listado').show('fast');
                            $('#totales').hide('fast');
                            $('#opciones').hide('fast');
                            $('#listado').html('<div class="alert alert-info flash-msg"><center><strong> ¡Atención!</strong> El socio no tiene ninguna deuda pendiente.</center></div>');
                            $('#btnpagar').hide();
                            $('#totales').hide();
                            $('#totalinput').val("");
                            $('#efectivo').val("");
                            $('#cambio').val("");
                        } else {
                            $('#listado').show('fast');
                            $('#btnpagar').show();
                            if ($("#rbdetalletotal").is(":checked")) {
                                var suma = 0;
                                var tabla = '<table cellpadding="0" cellspacing="0" border="1" class="display" id="lista_paciente">';
                                tabla += '<caption><center><strong>DETALLES</strong></center></caption>';
                                tabla += '<thead>';
                                tabla += '<tr>';
                                tabla += '<th class="col-sm-1"></th><th>CANTIDAD</th><th class="col-sm-6">DESCRIPCIÓN</th><th class="col-sm-1">V. UNITARIO</th><th class="col-sm-1">V. TOTAL</th>';
                                tabla += '</tr>';
                                tabla += '</thead>';
                                tabla += '<tbody>';
                                tr = '';
                                $.each(data, function (i) {
                                    tr += '<tr>';
                                    tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL + "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
                                    tr += '</tr>';
                                    suma = parseFloat(suma) + parseFloat(data[i].V_TOTAL);
                                });
                                tabla += tr;
                                tabla += "</tbody></table>";

                                $('#listado').html(tabla);
                                $('#totalinput').val("");
                                $('#totalinput').val(parseFloat(suma));
                            }
                        }

                    },
                    error: function () {
                        console.log('No se pudo realizar la consulta ajax');
                    }
                });
            });
        });
    </script>
    <!--Actualizar detalle completo -->
    <script>
        $(document).ready(function () {
            //$('#rbdetalletotal').prop('checked', true);
            $('#rbdetalletotal').click(function () {
                $.ajax({
                    type: "POST",
                    url: 'detallefactura',
                    data: {
                        socio: $('#SocioMedidor_CODIGO_SOCIO').val()
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        $('#listado').show('fast');
                        if ($("#rbdetalletotal").is(":checked")) {
                            var suma = 0;
                            var tabla = '<table cellpadding="0" cellspacing="0" border="1" class="display" id="lista_paciente">';
                            tabla += '<caption><center><strong>DETALLES</strong></center></caption>';
                            tabla += '<thead>';
                            tabla += '<tr>';
                            tabla += '<th class="col-sm-1"></th><th>CANTIDAD</th><th class="col-sm-6">DESCRIPCIÓN</th><th class="col-sm-1">V. UNITARIO</th><th class="col-sm-1">V. TOTAL</th>';
                            tabla += '</tr>';
                            tabla += '</thead>';
                            tabla += '<tbody>';
                            tr = '';
                            $.each(data, function (i) {
                                tr += '<tr>';
                                tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL + "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
                                tr += '</tr>';
                                suma = parseFloat(suma) + parseFloat(data[i].V_TOTAL);
                            });
                            tabla += tr;
                            tabla += '</tbody></table>';
                            $('#listado').html(tabla);
                            $('#totalinput').val("");
                            $('#totalinput').val(parseFloat(suma));

                        }
                    },
                    error: function () {
                        console.log('No se pudo realizar la consulta ajax');
                    }

                });
            });
        });</script>
    <!--DETALLE FACTURA-->
    <script>
        $(document).ready(function () {
            $('#rbfactura').click(function () {
                $.ajax({
                    type: "POST",
                    url: 'detallefactura',
                    data: {
                        socio: $('#SocioMedidor_CODIGO_SOCIO').val()
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if ($("#rbfactura").is(":checked")) {
                            var suma = 0;
                            var tabla = '<table cellpadding="0" cellspacing="0" border="1" class="display" id="lista_paciente">';
                            tabla += '<caption><center><strong>DETALLES</strong></center></caption>';
                            tabla += '<thead>';
                            tabla += '<tr>';
                            tabla += '<th class="col-sm-1"></th><th>CANTIDAD</th><th class="col-sm-6">DESCRIPCIÓN</th><th class="col-sm-1">V. UNITARIO</th><th class="col-sm-1">V. TOTAL</th>';
                            tabla += '</tr>';
                            tabla += '</thead>';
                            tabla += '<tbody>';
                            tr = '';
                            $.each(data, function (i) {
                                if (data[i].TIPO == 1) //TIPO FACTURA
                                {
                                    tr += '<tr>';
                                    tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL + "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
                                    tr += '</tr>';
                                    suma = parseFloat(suma) + parseFloat(data[i].V_TOTAL);
                                }
                            });
                            tabla += tr;
                            tabla += '</tbody></table>';
                            $('#listado').html(tabla);
                            $('#totalinput').val("");
                            $('#totalinput').val(parseFloat(suma));
                        }
                        prevAjaxReturned = true;
                    },
                    error: function () {
                        console.log('No se pudo realizar la consulta ajax');
                    }

                });
            });
        });</script>
    <!--DETALLE NOTA DE VENTA-->
    <script>
        $(document).ready(function () {
            $('#rbnotaventa').click(function () {
                $.ajax({
                    type: "POST",
                    url: 'detallefactura',
                    data: {
                        socio: $('#SocioMedidor_CODIGO_SOCIO').val()
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if ($("#rbnotaventa").is(":checked")) {
                            var suma = 0;
                            var tabla = '<table cellpadding="0" cellspacing="0" border="1" class="display" id="lista_paciente">';
                            tabla += '<caption><center><strong>DETALLES</strong></center></caption>';
                            tabla += '<thead>';
                            tabla += '<tr>';
                            tabla += '<th class="col-sm-1"></th><th>CANTIDAD</th><th class="col-sm-6">DESCRIPCIÓN</th><th class="col-sm-1">V. UNITARIO</th><th class="col-sm-1">V. TOTAL</th>';
                            tabla += '</tr>';
                            tabla += '</thead>';
                            tabla += '<tbody>';
                            tr = '';
                            $.each(data, function (i) {
                                if (data[i].TIPO == 2) //TIPO FACTURA
                                {
                                    tr += '<tr>';
                                    tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL + "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
                                    tr += '</tr>';
                                    suma = parseFloat(suma) + parseFloat(data[i].V_TOTAL);
                                }
                            });
                            tabla += tr;
                            tabla += '</tbody></table>';
                            $('#listado').html(tabla);
                            $('#totalinput').val("");
                            $('#totalinput').val(parseFloat(suma));
                        }
                        prevAjaxReturned = true;
                    },
                    error: function () {
                        console.log('No se pudo realizar la consulta ajax');
                    }

                });
            });
        });
    </script>
    <!--****************************************************************************-->
    <!--****************************************************************************-->
    <!-- FIN DETALLES -->
    <!--****************************************************************************-->
    <!--****************************************************************************-->
    <script>
        $(document).ready(function () {
            $('#listado').on('click', '.item', function () {
                var item = $(this).val().split('-');
                item = parseFloat(item[1]);
                //alert(item);
                //alert(parseFloat($('#totalinput').val()));
                var value = parseFloat($('#totalinput').val());
                //alert(value);
                if ($(this).is(':checked')) {
                    value = value + item;
                } else {
                    value = value - item;
                }
                $('#totalinput').val("");
                $('#totalinput').val(value);

            });
        });
    </script>

    <div id="listado" class="table table-striped col-md-12">
    </div>

    <div class="col-xs-12">
        <div id="totales" class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-6">
                    <span id="lbtotal" class="badge label label-celeste-claro">TOTAL</span>
                    <input id="totalinput" name="totalinput" class="form-control" readonly/>
                </div>
                <div class="col-xs-6">
                    <span id="lbefectivo" class="badge label label-celeste-claro">EFECTIVO: </span>
                    <input id="efectivo" name="efectivo" size="100%" class="form-control"/>
                    <div id="message"></div>
                    <span id="lbcambio" class="badge label label-celeste-claro">CAMBIO: </span>
                    <input id="cambio" name="cambio" disabled="true" size="50%" class="form-control"/>
                </div>
            </div>
        </div>
    </div>  


    <div class="row submit">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'success',
            'icon' => 'glyphicon-usd',
            'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'COBRAR') : Yii::t('AweCrud.app', 'Save'),
            'size' => 'large',            
            'htmlOptions' => array(
                'id' => 'btnpagar',
             //   'confirm'=>'¿Esta seguro de realizar el cobro?',
             //   'class'=>'alert alert-warning',
            ),
        ));
        ?>
    </div>
    <?php $this->endWidget(); ?>
</div>