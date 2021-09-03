<?php
/** @var AsistenciaController $this */
/** @var Asistencia $model */
$this->breadcrumbs=array(
	'Asistencias'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Asistencia::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Asistencia::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('asistencia-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo Asistencia::label(2) ?>    </legend>

<?php echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'asistencia-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'CODIGO_ASISTENCIA',
        array(
                    'name' => 'CODIGO_SOCIO',
                    'value' => 'isset($data->cODIGOSOCIO) ? $data->cODIGOSOCIO : null',
                    'filter' => CHtml::listData(Socio::model()->findAll(), 'CODIGO', Socio::representingColumn()),
                ),
        array(
                    'name' => 'CODIGO_REUNION',
                    'value' => 'isset($data->cODIGOREUNION) ? $data->cODIGOREUNION : null',
                    'filter' => CHtml::listData(Reunion::model()->findAll(), 'CODIGO_REUNION', Reunion::representingColumn()),
                ),
        'FECHA',
        'HORA',
        array(
					'name' => 'REGISTRA_INGRESO_PUNTUAL',
					'value' => '($data->REGISTRA_INGRESO_PUNTUAL === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
					'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
					),
        /*
        array(
					'name' => 'REGISTRA_ATRASO',
					'value' => '($data->REGISTRA_ATRASO === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
					'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
					),
        array(
					'name' => 'REGISTRA_FUGA',
					'value' => '($data->REGISTRA_FUGA === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
					'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
					),
        array(
					'name' => 'REGISTRA_SALIDA_PUNTUAL',
					'value' => '($data->REGISTRA_SALIDA_PUNTUAL === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
					'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
					),
        'OBSERVACIONES',
        'COD_USUARIO',
        'FECHA_ACTUALIZACION',
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>