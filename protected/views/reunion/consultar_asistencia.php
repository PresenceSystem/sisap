<?php
/** @var ReunionController $this */
/** @var Reunion $model */
$this->breadcrumbs=array(
	'Reunions'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
//	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Reunion::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Reunion::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('reunion-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
      CONSULTAR ASISTENCIA    </legend>

<?php // echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'reunion-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
//        'CODIGO_REUNION',
        array(
                    'name' => 'CODIGO_TIPO',
                    'value' => 'isset($data->cODIGOTIPO) ? $data->cODIGOTIPO : null',
                    'filter' => CHtml::listData(TipoReunion::model()->findAll(), 'CODIGO_TIPO', TipoReunion::representingColumn()),
                ),
        'FECHA',
        'HORA_INGRESO',
        'TIEMPO_ESPERA',
        //'VALOR_ATRASO',
        /*
        'VALOR_FUGA',
        'VALOR_FALTA',
        'ESTADO',
        'COD_USUARIO',
        'FECHA_ACTUALIZACION',
        */
        array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{consultar} ',
                'buttons' => array
                    (
                    'consultar' => array
                        (
                        'label' => 'CONSULTAR ASISTENCIA',
//                        'icon' => 'list white',
                        'url' => 'Yii::app()->createUrl("reunion/lista_asistencia/", array("id"=>$data->CODIGO_REUNION))',
                         'imageUrl' => Yii::app()->request->baseUrl . '/images/iconos/buscar_15.png', array("width" => '4px'),
                            'options' => array('class' => 'consultar'),
//                        'options' => array(
//                            'class' => 'btn btn-small btn-success',
//                        ),
                    ),
                ),
            )
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
	),
)); ?>
</fieldset>