<?php
/** @var FacturaController $this */
/** @var Factura $model */
$this->breadcrumbs=array(
	'Facturas'=>array('index'),
	$model->ID,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Factura::label(2), 'icon' => 'list', 'url' => array('index')),
  //  array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Factura::label(), 'icon' => 'plus', 'url' => array('create')),
//	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    //array('label' => Yii::t('AweCrud.app', 'Anular'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('anular', 'id' => $model->ID), 'confirm' => Yii::t('AweCrud.app', 'Seguro para anular?'))),
 //   array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend> <center> <?php echo $model->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO ?> </center>
        <?php echo ' <b> EMISIÓN Nº:</b> '.CHtml::encode($model).'<br> <b>MES/ANIO del cobro:<b> '.$model->MES_COBRO.'/'.$model->ANIO_COBRO ?>                
    </legend>

<?php
$suma_total_cobrado=0;
 ?>
</fieldset>
<br> <b>FACTURA FÍSICA N°:</b> <?= $model->NUMERO_FACTURA ?>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><center>COBRO EN FACTURA</center></h3>
        </div>
        <div class="panel-body">



            <?php
              $contador = 0;
			  $suma = 0;
                          $fecha_cobro = '';
                ?>   

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
							<th>Cant.</th>
                            <th>Desc</th>
                            <th>V.U.</th>
                            <th>V.T.</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
					 foreach ($modelo_detalles as $mod) {
                                             $fecha_cobro = $mod->FECHA_COBRO;
                      if ($mod->iDFACTURA->TIPO == 1) // FACTURA 
					  {
						?>
                        <tr>
                         										
                            <td> <?php echo $mod->CANTIDAD; ?>  </td>
                           <td> <?php echo $mod->iDRUBRO->DESCRIPCION; ?>  </td>
						   <td> <?php echo $mod->V_UNITARIO; ?>  </td>
						   <td> <?php echo $mod->V_TOTAL; ?>  </td>
                          
                        </tr>
                    <?php
						$suma = $suma + $mod->V_TOTAL;	
					  } // FIN DE FACTURA						
                    }
                    ?>
					<tr>
						<td colspan = '3'>
						TOTAL
						</td>
						<td>
						 <?php echo $suma;
						 $suma_total_cobrado = $suma_total_cobrado + $suma;
						 ?>
						</td>
					</tr>
                </tbody>
            </table>
        </div>
    </div>
 <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title"><center>COBRO EN RECIBO</center></h3>
        </div>
        <div class="panel-body">



            <?php
              $contador = 0;
			  $suma = 0;
                ?>   

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
							<th>Cant.</th>
                            <th>Desc</th>
                            <th>V.U.</th>
                            <th>V.T.</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
					 foreach ($modelo_detalles as $mod) {
                      if ($mod->iDFACTURA->TIPO == 2) // FACTURA 
					  {
						?>
                        <tr>
                         										
                            <td> <?php echo $mod->CANTIDAD; ?>  </td>
                           <td> <?php echo $mod->iDRUBRO->DESCRIPCION; ?>  </td>
						   <td> <?php echo $mod->V_UNITARIO; ?>  </td>
						   <td> <?php echo $mod->V_TOTAL; ?>  </td>
                          
                        </tr>
                    <?php
						$suma = $suma + $mod->V_TOTAL;	
					  } // FIN DE FACTURA						
                    }
                    ?>
					<tr>
						<td colspan = '3'>
						TOTAL
						</td>
						<td>
						 <?php echo $suma;
						 $suma_total_cobrado = $suma_total_cobrado + $suma;
						 ?>
						</td>
					</tr>
                </tbody>
            </table>
        </div>
    </div>	
</div>
<?php 
$fecha_y_hora = explode(' ', $fecha_cobro);
        $fec=$fecha_y_hora[0];
        $hor=$fecha_y_hora[1];
        $fe = explode('-',$fec);
        $ano = $fe[0]*1; //(date('Y')) * 1;
        $mes = $fe[1]*1; //(date('m')) * 1;
        $dia = $fe[2]*1; //(date('d')) * 1;
        $diasemana = date('w', strtotime($fecha_cobro));
        $diassemanaN = array(
            "Domingo", "Lunes", "Martes", "Miércoles",
            "Jueves", "Viernes", "Sábado"
        );
        $mesesN = array(
            1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
            "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        );
        
        $fecha_formateada = $diassemanaN[$diasemana] . ", $dia de " . $mesesN[$mes] . " de $ano       " . $hor;
    //   echo $fecha_formateada;
?>
<?php echo '<br>FECHA DEL COBRO: '; ?>
<?php 
    $fech = explode("-", $fecha_cobro);
    if (isset($fech[1]) && isset($model->MES_COBRO))
    {
    IF ($fech[1] == $model->MES_COBRO) 
                echo $fecha_formateada; 
            ELSE 
                ECHO 'No registrado'; 
    }

    ?>

<center>
<a href="<?php echo Yii:: app()->baseUrl . '/index.php/factura/anular/'.$model->ID ?>" class=" text-center btn-primary btn-mini btn" title="Anular el cobro por: <?php echo ''.$suma_total_cobrado.' USD, y posterior puede volver a facturar' ?>">  
                                <img src="<?php echo Yii:: app()->baseUrl . '/images/iconos/eliminar.png' ?>" width="40px"></img>                                
								<h4> ANULAR FACTURA </h4>	
								<?php echo '<h5> POR: '.$suma_total_cobrado.' USD </h5>' ?>								
                                </a>
								</center>
								
								<a href="<?php echo Yii:: app()->baseUrl . '/index.php/socioMedidor/factura' ?>" class=" text-center btn-warning btn-mini btn" title="Cancelar y volver a continuar facturando" >                                  
								<h5> CANCELAR</h5>								
                                </a>
					
