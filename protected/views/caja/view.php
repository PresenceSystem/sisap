<?php
/** @var CajaController $this */
/** @var Caja $model */
$this->breadcrumbs=array(
	'Cajas'=>array('index'),
	$model->ID,
);

$this->menu=array(
    /*array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Caja::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Caja::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')), */
);
?>

<fieldset>
   <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        CIERRE DE CAJA
                    </div>
                    <div class="panel-body">
                  
                    <div class="panel panel-warning">
                        <div class="panel-heading text-center">
                            MOVIMIENTOS REGISTRADOS POR EL USUARIO
                        </div>
						<div class="panel-body">
								<div class=" text-warning text-center">
									<h5>INGRESOS</h5>
								</div>
								<div class="panel-body">
									<table class="table table-hover table-condense ">
										<thead>
											<th>N°</th>
											<th>DESCRIPCIÓN</th>
											<th>V. TOTAL</th>                                    
										</thead>
										<tbody>
										<?php 
										$contador_ingreso = 0;
										$suma_ingreso=0;
										$model_ingreso = MovimientoCaja::model()->findAllBySql('select * from movimiento_caja where TIPO = 0 and ID_CAJA='.$model->ID); //Ingreso
										foreach($model_ingreso as $ingreso)
										{	$contador_ingreso++;
										echo "<tr>";
												echo "<td>".$contador_ingreso."</td>";
												//echo "<td>".$ingreso->DESCRIPCION."</td>";
												echo "<td> ".CHtml::link($ingreso->DESCRIPCION, array('movimientoCaja/update',
													'id' => $ingreso->ID))."</td>";
												echo "<td>".$ingreso->VALOR."</td>";
											echo "</tr>";
											$suma_ingreso = $suma_ingreso + $ingreso->VALOR;
										}
										?>
										<tr>
											<td colspan='2'>
												TOTAL DE INGRESOS
											</td>
											<td> <?php echo $suma_ingreso; ?>
											</td>
										</tr>
										</tbody>
									</table>
								</div>
								<div class="text-warning text-center">
									<h5>EGRESOS</h5>
								</div>
								<div class="panel-body">
									<table class="table table-hover table-condense ">
										<thead>
											<th>N°</th>
											<th>DESCRIPCIÓN</th>
											<th>V. TOTAL</th>                                    
										</thead>
										<tbody>
										<?php 
										$contador_egreso = 0;
										$suma_egreso=0;
										$model_egreso = MovimientoCaja::model()->findAllBySql('select * from movimiento_caja where TIPO = 1 and ID_CAJA='.$model->ID); //Egreso
										foreach($model_egreso as $egreso)
										{	$contador_egreso++;
										echo "<tr>";
												echo "<td>".$contador_egreso."</td>";
												//echo "<td>".$egreso->DESCRIPCION."</td>";
												echo "<td> ".CHtml::link($egreso->DESCRIPCION, array('movimientoCaja/update',
													'id' => $egreso->ID))."</td>";
												echo "<td>".$egreso->VALOR."</td>";
											echo "</tr>";
											$suma_egreso = $suma_egreso + $egreso->VALOR;
										}
										?>
										<tr>
											<td colspan='2'>
												TOTAL DE EGRESOS
											</td>
											<td> <?php echo $suma_egreso; ?>
											</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="text-info text-center">
							
							</div>
							 <span class="badge label label-celeste-claro"><h5>Diferencia de movimiento de caja registrados por el usuario:</h5></span>                
							<span id="lbtotal" class="badge label label-success"><h5><?php echo $model->TOTAL_CAJA ?></h5></span>   
							
                    </div>

			<div class="panel panel-primary">
			<div class="panel-heading text-center">
                            RECUENTO
                        </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <?php $model_recuento =Recuento::model()->findBySql('select * from recuento where ID_CAJA = '.$model->ID); ?>
            <table class="table table-hover table-condense table-bordered ">
			<tr><td>
				<span id="lbuncentavo" class="badge label label-success"><?php echo $model_recuento->UNO ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/1.png' ?>" width="10%" >
			</td></tr><tr><td>
            
				<span id="lbcincocentavos" class="badge label label-success"><?php echo $model_recuento->CINCO ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/5.png' ?>" width="15%" >
			</td></tr><tr><td>
            
				<span id="lbdiezcentavos" class="badge label label-success"><?php echo $model_recuento->DIEZ ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/10.png' ?>" width="10%" >
            </td></tr><tr><td>
            
				<span id="lbventicincocentavos" class="badge label label-success"><?php echo $model_recuento->VIENTICINCO ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/25.png' ?>" width="17%" >
            </td></tr><tr><td>
            
				<span id="lbcincuentacentavos" class="badge label label-success"><?php echo $model_recuento->CINCUENTA ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/50.png' ?>" width="20%" >
			</td></tr><tr><td>
            
				<span id="lbundolar" class="badge label label-success"><?php echo $model_recuento->UNO_D ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/1_d.png' ?>" width="25%" >
            </td></tr><tr><td>
            
				<span id="lbcincodolares" class="badge label label-success"><?php echo $model_recuento->CINCO_D ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/5_d.png' ?>" width="25%" >
			</td></tr><tr><td>
            
				<span id="lbdiezdolares" class="badge label label-success"><?php echo $model_recuento->DIEZ_D ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/10_d.png' ?>" width="25%" >
            </td></tr><tr><td>
            
				<span id="lbveintedolares" class="badge label label-success"><?php echo $model_recuento->VIENTE_D ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/20_d.png' ?>" width="25%" >
            </td></tr><tr><td>
            
				<span id="lbcincuentadolares" class="badge label label-success"><?php echo $model_recuento->CINCUENTA_D ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/50_d.png' ?>" width="25%" >
            </td></tr><tr><td>
				<span id="lbciendolares" class="badge label label-success"><?php echo $model_recuento->CIEN_D ?></span><br>
				</td><td>
				<img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/100_d.png' ?>" width="25%" >
            </td></tr>
			</table>
			
            <div>
                <span class="badge label label-celeste-claro"><h4>Total $.</h4></span>
                
            <span id="lbtotal" class="badge label label-success"><h4><?php echo $model->RECUENTO ?></h4></span>    
            </div>
            

                </div>
                    
            </div>
        
        </div>
					
					 <div class="panel panel-success">
                        <div class="panel-heading text-center">
                           ARQUEO DE CAJA EN RESUMEN
                        </div>
						<div class="panel-body">								
									<table>
								<tr class="text-success"><td><h4>(+) Apertura de caja </h4></td><td><h4><?php echo $model->SALDO_INICIAL ?></h4></td></tr>
									 <tr class="text-success"><td><h4>(+) Diferencia de movimiento de caja </h4></td><td><h4><?php echo $model->TOTAL_CAJA ?></h4></td></tr>
									 <tr class="text-success"><td><h4>(+) <?php echo $model->TOTAL_FACTURAS; ?> comprobantes emitidos (<?php echo $model->FACTURA_DESDE.' - '.$model->FACTURA_HASTA  ?>) </h4></td><td><h4><?php echo $model->TOTAL ?></h4></td></tr>									
									 <tr class="text-success"><td><h4>(+) Bancos </h4></td><td><h4><?php echo $model->BANCOS ?></h4></td></tr>									 
									 <?php $total_sistema = $model->SALDO_INICIAL +  $model->TOTAL_CAJA + $model->TOTAL + $model->BANCOS;  ?>
									 <tr class="btn-success"><td><h4>&emsp;&emsp;&emsp;&emsp; TOTAL ESTIMADO (Sistema) </h4></td><td><h4><?php echo $total_sistema; ?></h4></td></tr>
									  <tr class="btn-info"><td><h4>&emsp;&emsp;&emsp;&emsp;(-) EFECTIVO EN CAJA </h4></td><td><h4><?php echo $model->EFECTIVO ?></h4></td></tr>
									  <?php if($model->DESCUADRE < 0) { ?>
											<tr class="badge-warning"><td><h4>&emsp;&emsp;&emsp;&emsp; FALTANTE </h4></td><td><h4><?php echo $model->DESCUADRE.' (Registra pérdida)' ?></h4></td></tr>
									  <?php } ?>
									  <?php if($model->DESCUADRE > 0) { ?>
											<tr class="badge-warning"><td><h4>&emsp;&emsp;&emsp;&emsp; SOBRANTE </h4></td><td><h4><?php echo $model->DESCUADRE.' (Registra ganancia)' ?></h4></td></tr>
									  <?php } ?>
									  <?php if($model->DESCUADRE == 0) { ?>
											<tr class="badge-warning"><td><h4>&emsp;&emsp;&emsp;&emsp; DESCUADRE </h4></td><td><h4><?php echo ' ' ?></h4></td></tr>
									  <?php } ?>
							</table>
								
							</div>
                    </div>
						
                        <div class="text-success">
                           <b> RECAUDADO POR: </b> <?php echo $model->rECAUDADOR->nombres; ?>
                           <b> a partir de: </b> <?php echo $model->FECHA; ?>
                        </div>
                        </div>
                        </div>
</div>

</fieldset>
				
                        <?php 
						
						/****
						
						$this->widget('bootstrap.widgets.TbDetailView',array(
                        	'data' => $model,
                        	'attributes' => array(
                              //  'ID',
                                'FECHA',
                                array(
                        			'name'=>'RECAUDADOR',
                        			'value'=>($model->rECAUDADOR !== null) ? CHtml::encode($model->rECAUDADOR, array('/usuario/view', 'id' => $model->rECAUDADOR->id)).' ' : null,
                        			'type'=>'html',
                        		),
                                'FACTURA_DESDE',
                                'FACTURA_HASTA',
                                'SALDO_INICIAL',
                                'TOTAL_FACTURAS',
                                'RECIBO_DESDE',
                                'RECIBO_HASTA',
                                'TOTAL_RECIBOS',
                                'TOTAL',
                                'EFECTIVO',
                               // 'TARJETAS',
                                'BANCOS',
                                'PENDIENTES_PAGO',
                               // 'BASE_IMPONIBLE',
                               // 'IVA',
                               // 'IMPORTE_IVA',
                                'MOV_CAJA_DESDE',
                                'MOV_CAJA_HASTA',
                                'TOTAL_INGRESOS',
                                'TOTAL_SALIDAS',
                                'TOTAL_CAJA',
                                'RECUENTO',
                                'DESCUADRE',
                                'DESCRIPCION',
                                'COD_USUARIO',
                                'FECHA_ACTUALIZACION',
                        	),
                        ));

			****/
						?>