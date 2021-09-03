<?php
/** @var AcometidaAlcantarilladoController $this */
/** @var AcometidaAlcantarillado $model */
$this->breadcrumbs=array(
	'Acometida Alcantarillados'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . AcometidaAlcantarillado::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . AcometidaAlcantarillado::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('acometida-alcantarillado-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo AcometidaAlcantarillado::label(2) ?>    </legend>

<?php echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'acometida-alcantarillado-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'ID',
//        array(
//                    'name' => 'ID_SOCIO_MEDIDOR',
//                    'value' => 'isset($data->iDSOCIOMEDIDOR) ? $data->iDSOCIOMEDIDOR : null',
//                    'filter' => CHtml::listData(SocioMedidor::model()->findAll(), 'ID', SocioMedidor::representingColumn()),
//                ),
        'ID_GRUPO',
       // 'TIPO',
        array(
					'name' => 'INACTIVO',
					'value' => '($data->INACTIVO === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
					'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
					),
        'INACTIVO_DESCRIPCION',
        /*
        'FECHA_INGRESO',
        'FECHA_SALIDA',
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>