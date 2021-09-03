<div class="form">
    <?php
    /** @var SocioMedidorController $this */
    /** @var SocioMedidor $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'socio-medidor-form-factura',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'focus' => array($model, 'CODIGO_SOCIO'),
        'focus' => 'input:text[value=""]:first',
    ));
    ?>

    <?php echo $form->errorSummary($model) ?>

    <?php //echo $form->dropDownListRow($model, 'CODIGO_SOCIO', CHtml::listData(Socio::model()->findAll(), 'CODIGO', Socio::representingColumn()))  ?>                    
    <div class="col-md-12 btn-primary text-center">
        <div class="col-md-2 col-xs-6">
            <h5>Factura física N°: </h5>
            <?php echo $form->textField($model, 'COD_USUARIO', array('class' => 'span12', 'placeholder' => "Ej. 20921",)) ?>
        </div>
        <div class="col-md-8 col-xs-6">
            <div class="">        
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
                   // 'id' => 'autocompleta',
                    'name' => 'CODIGO_SOCIO',
                    'model' => $model,
                    'value' => $value,
                    'sourceUrl' => $this->createUrl('socio/ListarSocios'),
                    'options' => array(
                        'minLength' => '2',
                        'showAnim' => 'fold',
                        'select' => 'js:function(event, ui)
                                    { jQuery("#SocioMedidor_CODIGO_SOCIO").val(ui.item.id);
                                      jQuery("#CODIGO_SOCIO").click();
                                  //    jQuery("#efectivo").val(ui.item.id);
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
        
<!--        <div class="col-xs-1">
            <br><br>
            <?php
//            $this->widget('bootstrap.widgets.TbButton', array(
//                // 'buttonType' => 'submit',
//                'type' => 'success',
//                'icon' => 'search',
//                'htmlOptions' => array(
//                    'id' => 'botonBuscar',
//                ),
//                'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Buscar') : Yii::t('AweCrud.app', 'Save'),
//            ));
            ?>
        </div>-->
        <div class="col-xs-2">
            <br><br>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                // 'buttonType' => 'submit',
                'type' => 'success',
                // 'icon' => 'flash',
                'htmlOptions' => array(
                    'id' => 'btnlimpiar',
                ),
                'label' => 'Limpiar',
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
				$('#efectivo').val('');
				$('#cambio').val('');
                $('#CODIGO_SOCIO').focus();				
				$('#escojer_factura').hide('fast');
				// limpia los medidores del select
				document.getElementById("medidor_factura").options.length = 0;
            });
        });</script>

<!-- BUSCAR SOCIO POR CODIGO DE BARRA-->
<script>
$(document).ready(function()
{
    $('#CODIGO_SOCIO').on('keyup', function(){
        if (($('#CODIGO_SOCIO').val().length == 10) || ($('#CODIGO_SOCIO').val().length == 13) ) {
            
                        $.ajax({
                            type: "POST",
                            url: 'buscar_socio',
                            data: {
                                cedula: $('#CODIGO_SOCIO').val()
                            },
                            dataType: 'JSON',
                            success: function (data) {
                             //   if (data == 0) {    
                              if (data.CODIGO>0)
                              {                               
                                    $('#SocioMedidor_CODIGO_SOCIO').val(data.CODIGO);
                                     $('#CODIGO_SOCIO').click();
                                }
                                else
                                {
                                    //alert('El valor ingresado no corresponde a ningun socio'); 
									$('#listado').show();
									$('#listado').html('<div class="alert alert-info flash-msg"><center><strong> ¡Atención!</strong> Digite correctamente los apellidos o la CI.</center></div>');
                                }
                                  //  alert('Si Ingresa');
                                   //  alert('CODIGO: '+val(data.CODIGO));
                             //   }
                            }
                        })
                    }

    })
})
</script>
<!-- FIN DE BUSCAR SOCIO POR CODIGO DE BARRA-->





    <!-- LLenar encabezado-->
    <script>
        //   $(document).ready(function () {
        //$(function () {
        $(document).ready(function () {
            $('#encabezado').hide("fast");
            $('#listado').hide("fast");
            $('#opciones').hide('fast');
            $('#totales').hide('fast');
            $('#btnpagar').hide('fast');
			$('#escojer_factura').hide('fast');
            //     $('#CODIGO_SOCIO').on('change', function () {
         $('#CODIGO_SOCIO').on('click change', function () {
        //   $('#CODIGO_SOCIO').on('keydown click', function(){
              //  alert('Ingreso');
                if ($('#CODIGO_SOCIO').val() != '')
                {
                    if ($('#SocioMedidor_CODIGO_SOCIO').val() > 0) {
                        $.ajax({
                            type: "POST",
                            url: 'encabezadofactura',
                            data: {
                                socio: $('#SocioMedidor_CODIGO_SOCIO').val()
                            },
                            dataType: 'JSON',
                            success: function (data) {
								//************ Llenar Medidores 2 *****************
									var medidor_factura = document.getElementById("medidor_factura"); /* Para no tener que llamar a cada rato a getElementById */
									$('#escojer_factura').show('fast');
									var medidores = '';
									var cons_anterior = '';
									var cons_actual = '';
									var consumo = '';
									 $.each(data, function (i) {
                                        if (data[i].NUMERO != null) //SI EXISTE MEDIDOR
                                         {  
											if (i==0)										 
											{	medidor_factura.options[0] = new Option('Todo');
											//************ Llenar Medidores 3 *****************
											medidor_factura.options[i+1] = new Option(data[i].NUMERO+'<=['+data[i].GRUPO+']');
											}
											else
											{ medidor_factura.options[i+1] = new Option(data[i].NUMERO+'<=['+data[i].GRUPO+']'); }
										 if (medidores != '')
											{ medidores = medidores + ', ';
												cons_anterior = cons_anterior + ', ';
												cons_actual = cons_actual + ', ';
												consumo = consumo + ', ';
											}
										medidores = medidores + data[i].NUMERO;
										cons_anterior = cons_anterior + data[i].CONSUMO_ANTERIOR;
										cons_actual = cons_actual + data[i].CONSUMO_ACTUAL;
										consumo = consumo + data[i].CONSUMO_CALCULADO;
												
                                        }
                                    });
							
								//Mestra los  divs con la informacion de la factura
                                if (data[0] != null) {
                                    $('#encabezado').show('fast');
                                    $('#opciones').show('fast');
                                    $('#detalles').show('fast');
                                    $('#totales').show('fast');
                                    $('#cedula').val(data[0].CI);
                                    $('#apellido').val(data[0].APELLIDO);
                                    $('#medidor').val(medidores);
                                    $('#consumoanterior').val(cons_anterior);
                                    $('#consumoactual').val(cons_actual);
                                    $('#consumocalculado').val(consumo);
                                    //$('#total').val(data[0].TOTAL);

                                } else
                                {
                                    $('#encabezado').hide('fast');
                                    $('#opciones').hide('fast');
                                    $('#detalles').hide('fast');
                                    $('#totales').hide('fast');
                                    $('#btnpagar').hide('fast');
                                    $('#listado').html('<div class="alert alert-warning flash-msg"><center><strong> ¡Atención!</strong> El socio no tiene un medidor activo.</center></div>');
                                }
                            },
                            error: function () {
                                console.log('No se pudo realizar la consulta ajax');
                            }
                        });
                    }
                }
            });
        });
    </script>

	<!-- SELECCIONAR MEDIDOR PARA FACTURA INDIVIDUAL  -->
	  <script>
        $(document).ready(function () {
            //$('#rbdetalletotal').prop('checked', true);
            $('#medidor_factura').change(function () {
                //Medidor seleccionado
					var posicion=document.getElementById('medidor_factura').options.selectedIndex; //posicion del medidor
					var cadena = document.getElementById('medidor_factura').options[posicion].text;
					var resultado_medidor = cadena.split("<", 1);
					var med = resultado_medidor[0];
					//$('#medidor').val(med);
					
				
						//alert(med);
					// $('#listado').hide('fast');
					//$('#totales').hide('fast');
					//$('#btnpagar').hide('fast');	
					// alert(resultado_medidor);
                    $.ajax({
                        type: "POST",
                        url: 'detallefactura',
                        data: {
                            socio: $('#SocioMedidor_CODIGO_SOCIO').val(),
							medidor: med,
				//alert(document.getElementById('medidor_factura').options[posicion].text); //valor     
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            if (data[0] == null) {
                                $('#listado').show('fast');
                                $('#totales').hide('fast');
                                $('#opciones').hide('fast');
                                $('#listado').html('<div class="alert alert-info flash-msg"><center><strong> ¡Atención!</strong> El socio no puede realizar el pago.</center></div>');
                                $('#btnpagar').hide();
                                $('#totalinput').val("");
                                $('#efectivo').val("");
                                $('#cambio').val("");
                            } else {
                                $('#listado').show('fast');
                              //  $('#btnpagar').show(); Desactivado por Juan Tierra
                                $('#opciones').show('fast');
								$('#totales').show('fast');
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
									var medidor_anterior='x';
                                    $.each(data, function (i) {
										//alert(data[i].DETALLE_ID + '-' + data[i].V_TOTAL + '-' + data[i].FACTURA_ID );
                                        if (data[i].TIPO == 1) //TIPO FACTURA
                                         {
                                            tr += '<tr class="success">';
                                            tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL + '-' + data[i].FACTURA_ID + "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
                                            tr += '</tr>';
                                            suma = parseFloat(suma) + parseFloat(data[i].V_TOTAL);	
											//Cargando los medidores 
											if (i>0 && medidor_anterior != data[i].NUMERO)												
											{   $('#medidor').val($('#medidor').val()+', '+data[i].NUMERO);
												$('#consumoanterior').val($('#consumoanterior').val()+', '+data[i].CONSUMO_ANTERIOR);
												$('#consumoactual').val($('#consumoactual').val()+', '+data[i].CONSUMO_ACTUAL);
												$('#consumocalculado').val($('#consumocalculado').val()+', '+data[i].CONSUMO_CALCULADO);
											}
											else
											{   $('#medidor').val(data[i].NUMERO);	
												$('#consumoanterior').val(data[i].CONSUMO_ANTERIOR);
												$('#consumoactual').val(data[i].CONSUMO_ACTUAL);
												$('#consumocalculado').val(data[i].CONSUMO_CALCULADO);
											}
											medidor_anterior = data[i].NUMERO;
                                        }
                                        else
                                        { //RECIBO
                                             tr += '<tr class="warning">';
                                            tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL + '-' + data[i].FACTURA_ID +"' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
                                            tr += '</tr>';
                                            suma = parseFloat(suma) + parseFloat(data[i].V_TOTAL);
                                        }
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
        });</script>
		
		
    <div class="col-xs-12">
        <div id="encabezado" class="panel panel-default">
            
            <div class="panel-body">
                <div class="col-xs-5">
                    <span id="lbcedula" class="badge label label-celeste-claro">CI/RUC:</span>
                    <input id="cedula" name="cedula" disabled="true" class="form-control"/>
                    <span id="lbapellido" class="badge label label-celeste-claro">NOMBRES: </span>
                    <input id="apellido" name="apellido" disabled="true" size="100%" class="form-control"/>
                    <span id="lbmedidor" class="badge label label-celeste-claro">MEDIDOR N°: </span>
                    <input id="medidor" name="medidor" disabled="true" size="50%" class="form-control"/>
                </div>
                <div class="col-xs-3">
                    <span id="lbconsumoanterior" class="badge label label-celeste-claro">MED. ANTERIOR: </span>
                    <input id="consumoanterior" name="consumoanterior" disabled="true" size="100%" class="form-control"/>
                    <span id="lbconsumoactual" class="badge label label-celeste-claro">MED. ACTUAL: </span>
                    <input id="consumoactual" name="consumoactual" disabled="true" size="50%" class="form-control"/>
                    <span id="lbconsumoresultado" class="badge label label-celeste-claro">CONSUMO:</span>
                    <input id="consumocalculado" name="consumocalculado" disabled="true" class="form-control"/>
                </div>

            </div>
        </div>
    </div>
	<div>
		 <div class="text-center row span4 column" id="escojer_factura">
		 <!-- ************ Llenar Medidores 1 ***************** -->
			<select id="medidor_factura">
				<option>Todo</option>
			</select><br /> 
		</div>
		<div class="text-center row span8" id="opciones">
			<input type="radio" id="rbdetalletotal" name="tipos" value="todo" > Detalle Total &nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="radio" id="rbfactura" name="tipos" value="factura"> Factura &nbsp;&nbsp;&nbsp;&nbsp;          
			<input type="radio" id="rbnotaventa" name="tipos" value="notaventa"> Nota de Venta
		</div>
	</div>
	

    <!--****************************************************************************-->
    <!--****************************************************************************-->
    <!--DETALLES-->
    <!--****************************************************************************-->
    <!--****************************************************************************-->


    <!--Llenar detalle por defecto TODOS -->
    <script>
        $(function () {
            $('#rbdetalletotal').prop('checked', true);
            // $('#CODIGO_SOCIO').on('change', function () {
            $('#CODIGO_SOCIO').on('click change', function () {
                if ($('#CODIGO_SOCIO').val() != '')
                {
					 var posicion=document.getElementById('medidor_factura').options.selectedIndex; //posicion del medidor
					 var cadena = document.getElementById('medidor_factura').options[posicion].text;
					 var resultado_medidor = cadena.split("<", 1);
					 var med = resultado_medidor[0];
					// alert(resultado_medidor);
                    $.ajax({
                        type: "POST",
                        url: 'detallefactura',
                        data: {
                            socio: $('#SocioMedidor_CODIGO_SOCIO').val(),
							medidor: med,
				//alert(document.getElementById('medidor_factura').options[posicion].text); //valor     
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            if (data[0] == null) {
                                $('#listado').show('fast');
                                $('#totales').hide('fast');
                                $('#opciones').hide('fast');
                                $('#listado').html('<div class="alert alert-info flash-msg"><center><strong> ¡Atención!</strong> El socio no puede realizar el pago.</center></div>');
                                $('#btnpagar').hide();
                                $('#totalinput').val("");
                                $('#efectivo').val("");
                                $('#cambio').val("");
                            } else {
                                $('#listado').show('fast');
                               // $('#btnpagar').show(); Desactivado por Juan Tierra
                                $('#opciones').show('fast');
								$('#totales').show('fast');
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
                                        if (data[i].TIPO == 1) //TIPO FACTURA
                                         {
                                            tr += '<tr class="success">';
                                            tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL +'-' + data[i].FACTURA_ID +  "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
                                            tr += '</tr>';
                                            suma = parseFloat(suma) + parseFloat(data[i].V_TOTAL);											
                                        }
                                        else
                                        { //RECIBO
                                             tr += '<tr class="warning">';
                                            tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL + '-' + data[i].FACTURA_ID + "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
                                            tr += '</tr>';
                                            suma = parseFloat(suma) + parseFloat(data[i].V_TOTAL);
                                        }
                                    });
                                    tabla += tr;
                                    tabla += "</tbody></table>";
                                    $('#listado').html(tabla);
                                    $('#totalinput').val("");
									var total_final = (parseFloat(suma));
									var conDecimal = total_final.toFixed(2);
                                    $('#totalinput').val(conDecimal);
                                }
                            }

                        },
                        error: function () {
                            console.log('No se pudo realizar la consulta ajax');
                        }
                    });
                }
            });
        });</script> 
    <!--Actualizar detalle completo -->
    <script>
        $(document).ready(function () {
            //$('#rbdetalletotal').prop('checked', true);
            $('#rbdetalletotal').click(function () {
					//Medidor seleccionado
					var posicion=document.getElementById('medidor_factura').options.selectedIndex; //posicion del medidor
					var cadena = document.getElementById('medidor_factura').options[posicion].text;
					var resultado_medidor = cadena.split("<", 1);
					var med = resultado_medidor[0];
                $.ajax({
                    type: "POST",
                    url: 'detallefactura',
                    data: {
                        socio: $('#SocioMedidor_CODIGO_SOCIO').val(),
						medidor: med
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        $('#listado').show('fast');
						$('#totales').show('fast');
						$('#btnpagar').show('fast');
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
                                if (data[i].TIPO == 1) //TIPO FACTURA
                                         {
                                            tr += '<tr class="success">';
                                            tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL + '-' + data[i].FACTURA_ID + "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
                                            tr += '</tr>';
                                            suma = parseFloat(suma) + parseFloat(data[i].V_TOTAL);
                                        }
                                        else
                                        { //RECIBO
                                             tr += '<tr class="warning">';
                                            tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL +'-' + data[i].FACTURA_ID +  "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
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
				 var posicion=document.getElementById('medidor_factura').options.selectedIndex; //posicion del medidor
					 var cadena = document.getElementById('medidor_factura').options[posicion].text;
					 var resultado_medidor = cadena.split("<", 1);
					 var med = resultado_medidor[0];
                $.ajax({
                    type: "POST",
                    url: 'detallefactura',
                    data: {
                        socio: $('#SocioMedidor_CODIGO_SOCIO').val(),
						medidor: med
                    },
                    dataType: 'JSON',
                    success: function (data) {
						$('#listado').show('fast');
						$('#totales').show('fast');
						$('#btnpagar').show('fast');
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
                                    tr += '<tr class="success">';
                                    tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL +'-' + data[i].FACTURA_ID +  "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
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
				 var posicion=document.getElementById('medidor_factura').options.selectedIndex; //posicion del medidor
					 var cadena = document.getElementById('medidor_factura').options[posicion].text;
					 var resultado_medidor = cadena.split("<", 1);
					 var med = resultado_medidor[0];
                $.ajax({
                    type: "POST",
                    url: 'detallefactura',
                    data: {
                        socio: $('#SocioMedidor_CODIGO_SOCIO').val(),
						medidor: med
                    },
                    dataType: 'JSON',
                    success: function (data) {
						$('#listado').show('fast');
						$('#totales').show('fast');
						$('#btnpagar').show('fast');
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
                                if (data[i].TIPO == 2) //TIPO RECIBO
                                {
                                    tr += '<tr class="warning">';
                                    tr += "<td><input type='checkbox' name='item[]' class='item' checked value='" + data[i].DETALLE_ID + '-' + data[i].V_TOTAL +'-' + data[i].FACTURA_ID +  "' >    </td><td>" + data[i].CANTIDAD + "</td><td>" + data[i].DESCRIPCION + "</td><td>" + data[i].V_UNITARIO + "</td><td>" + data[i].V_TOTAL + "</td>";
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
    <div id="listado" class="table table-hover col-md-12">
    </div>

    <div class="col-xs-9">
        <div id="totales" class="panel panel-default">
            <div class="panel-body">
                <div class="col-xs-3">
                    <span id="lbtotal" class="badge label label-celeste-claro">TOTAL</span>
                    <input id="totalinput" name="totalinput" class="form-control" style=" font-size: 20px; background-color: #FFFF66; color: #FF0000; " readonly/>
                </div>
                <div class="col-xs-3">
                    <span id="lbefectivo" class="badge label label-celeste-claro">EFECTIVO: </span>
                    <input id="efectivo" name="efectivo" size="100%" style=" font-size: 20px;" class="form-control"/>
                    <div id="message"></div>
				</div>
                <div class="col-xs-3">
                    <span id="lbcambio" class="badge label label-celeste-claro">CAMBIO: </span>
                    <input id="cambio" name="cambio" disabled="true" size="50%" style=" font-size: 20px;" class="form-control"/>
                </div>
            </div>
        </div>
    </div>  


    <div class="row submit span3">
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


<!--BUSCAR DEUDA EN LA COMUNIDAD-->
<script>
        //   $(document).ready(function () {
        //$(function () {
        $(document).ready(function () {
          
            //     $('#CODIGO_SOCIO').on('change', function () {
         $('#CODIGO_SOCIO').on('click change', function () {
        //   $('#CODIGO_SOCIO').on('keydown click', function(){
              //  alert('Ingreso');
                if ($('#CODIGO_SOCIO').val() != '')
                {                    
                    if ($('#SocioMedidor_CODIGO_SOCIO').val() > 0) {                        
                        $.ajax({
                            type: "POST",
                            url: 'consultarcomunidadsvl',
                            data: {
                                codigo: $('#SocioMedidor_CODIGO_SOCIO').val()
                            },
                            dataType: 'JSON',
                            success: function (data) {                              
                                //Mestra los  divs con la informacion de la factura
                                if (data[0] != null) {
                                   $('#btnpagar').hide('fast');
                                     $('#mensajecomunidad').html('<div class="alert alert-error flash-msg"><center><strong> ¡Atención!</strong> '+ data[1] +' tiene una deuda pendiente de '+ data[2] +' $ con la comunidad.</center></div>');

                                } else
                                {
                                  $('#btnpagar').show();
                                    $('#mensajecomunidad').html('<div class="alert alert-success flash-msg"><center><strong> ¡Atención!</strong> No tiene deuda con la comunidad</center></div>');
                                }
                            },
                            error: function () {
                                //alert('No se puede realizar la consulta');
                                $('#btnpagar').show();
							//	  $('#mensajecomunidad').html('<div class="alert alert-warning flash-msg"><center><strong> ¡Atención!</strong> No tiene conexión con el sistema de la comunidad</center></div>');
                                console.log('No se pudo realizar la consulta ajax');
                            }
                        });
                    }
                }
            });
        });
    </script>






    </div>
    <?php $this->endWidget(); ?>
</div>


  


    <div id="mensajecomunidad" class="row span12 badge_info h3"></div>