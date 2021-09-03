<?php
/** @var RubroController $this */
/** @var Rubro $model */
$this->breadcrumbs=array(
	'Rubros'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Rubro::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Rubro::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('rubro-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <h4 class="badge badge-info">
            Buscar rubros (Facturas y Recibos)
        </h4>
    </legend>

<?php //echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'rubro-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'ID',
        'DESCRIPCION',
        'V_UNITARIO',
        'PORCEN',
        'FEC_CREACION',
        array(
                'name' => 'ID_SUBCUENTA',
                'value' => 'isset($data->iDSUBCUENTA->SUBCUENTA) ? $data->iDSUBCUENTA->SUBCUENTA : null',
                'filter' => CHtml::listData(SubcuentaContable::model()->findAll(), 'ID', 'SUBCUENTA'),
            ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>