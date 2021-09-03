<?php
/** @var CajaController $this */
/** @var Caja $model */
$this->breadcrumbs=array(
	'Cajas'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Caja::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Caja::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('caja-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo Caja::label(2) ?>    </legend>

<?php echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'caja-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'ID',
        'FECHA',
        array(
                    'name' => 'RECAUDADOR',
                    'value' => 'isset($data->rECAUDADOR) ? $data->rECAUDADOR : null',
                    'filter' => CHtml::listData(Usuario::model()->findAll(), 'id', Usuario::representingColumn()),
                ),
        'FACTURA_DESDE',
        'FACTURA_HASTA',
        'TOTAL_FACTURAS',
        /*
        'RECIBO_DESDE',
        'RECIBO_HASTA',
        'TOTAL_RECIBOS',
        'TOTAL',
        'EFECTIVO',
        'TARJETAS',
        'BANCOS',
        'PENDIENTES_PAGO',
        'BASE_IMPONIBLE',
        'IVA',
        'IMPORTE_IVA',
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
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>