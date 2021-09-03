<?php
/** @var DetalleController $this */
/** @var Detalle $model */
$this->breadcrumbs=array(
	'Detalles'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Detalle::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Detalle::label(), 'icon' => 'plus', 'url' => array('create')),
);

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
        <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo Detalle::label(2) ?>    </legend>

<?php echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
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
        'ID',
        array(
                    'name' => 'ID_FACTURA',
                    'value' => 'isset($data->iDFACTURA) ? $data->iDFACTURA : null',
                    'filter' => CHtml::listData(Factura::model()->findAll(), 'ID', Factura::representingColumn()),
                ),
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
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>