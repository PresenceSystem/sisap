<?php
/** @var DetalleController $this */
/** @var Detalle $model */
$this->breadcrumbs=array(
	'Detalles'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

//$this->menu=array(
//	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Detalle::label(2), 'icon' => 'list', 'url' => array('index')),
//	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Detalle::label(), 'icon' => 'plus', 'url' => array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('detalle-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <h4 class="btn-primary text-center">SELECCIONAR PARA REALIZAR PAGO PARCIAL</h4>
    </legend>
    <table class="table table-hover table-condensed">
        <thead>
            <th>
                N°
            </th>
            <th>
                RUBRO
            </th>
            <th>
                SALDO
            </th>
             <th>                
            </th>
         </thead>
        <?php 
        $contador = 1;
        foreach ($datos as $de)
        {
            echo "<tr>";
                echo "<td>";
                echo $contador++;
                 echo "</td>";
                  echo "<td>";
                echo $de['DESCRIPCION'];
                echo "</td>";
                echo "<td>";
                echo $de['V_TOTAL'];
                echo "</td>";
                echo "<td>";
                   echo CHtml::button('PAGO PARCIAL', 
                           array('submit'=>'./../../cuota/pago_parcial/'.$de['DETALLE_ID'],
                               'class' => 'btn-success'
                            )
                           );
                echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
<?php 

/*
//echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'detalle-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//        'ID',
//        array(
//                    'name' => 'ID_FACTURA',
//                    'value' => 'isset($data->iDFACTURA) ? $data->iDFACTURA : null',
//                    'filter' => CHtml::listData(Factura::model()->findAll(), 'ID', Factura::representingColumn()),
//                ),
        array(
                    'name' => 'ID_RUBRO',
                    'value' => 'isset($data->iDRUBRO) ? $data->iDRUBRO : null',
                    'filter' => CHtml::listData(Rubro::model()->findAll(), 'ID', Rubro::representingColumn()),
                ),
        'CANTIDAD', 
        'V_UNITARIO',
        'V_TOTAL',
        /*
        'IVA',
        'PORC_MORA',
        'VALOR_MORA',
        'FECHA',
        'FECHA_COBRO',
        'ESTADO',
        'COD_USUARIO',
        'FECHA_ACTUALIZACION',
        
         array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{ingresar} ',
                'buttons' => array
                    (
                    'ingresar' => array
                        (
                        'label' => 'PAGO PARCIAL',
                        'icon' => 'edit white',
                        'url' => 'Yii::app()->createUrl("cuota/pago_parcial", array("id"=>$data->ID))',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-info',
                        ),
                    ),
                   
                   
                   
//                    'pdf' => array(
//                        'label' => 'Generar PDF',
//                        'url' => "CHtml::normalizeUrl(array('pdf_socio', 'id'=>\$data->CODIGO
//                         ))",                        
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/imp_pdf.png',
//                        'options' => array('class' => 'pdf', 'target'=>'_BLANK'),
//                    ),
                ),
	),
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
	),
));  */ ?>
</fieldset>