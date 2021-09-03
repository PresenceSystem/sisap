<?php
/** @var RecuentoController $this */
/** @var Recuento $model */
$this->breadcrumbs=array(
	'Recuentos'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Recuento::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Recuento::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('recuento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo Recuento::label(2) ?>    </legend>

<?php echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'recuento-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'ID',
        array(
                    'name' => 'ID_CAJA',
                    'value' => 'isset($data->iDCAJA) ? $data->iDCAJA : null',
                    'filter' => CHtml::listData(Caja::model()->findAll(), 'ID', Caja::representingColumn()),
                ),
        'UNO',
        'CINCO',
        'DIEZ',
        'VIENTICINCO',
        /*
        'CINCUENTA',
        'UNO_D',
        'CINCO_D',
        'DIEZ_D',
        'VIENTE_D',
        'CINCUENTA_D',
        'CIEN_D',
        'TOTAL',
        array(
                    'name' => 'COD_USUARIO',
                    'value' => 'isset($data->cODUSUARIO) ? $data->cODUSUARIO : null',
                    'filter' => CHtml::listData(Usuario::model()->findAll(), 'id', Usuario::representingColumn()),
                ),
        'FECHA_ACTUALIZACION',
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>