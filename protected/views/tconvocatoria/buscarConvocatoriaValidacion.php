<?php
/** @var TconvocatoriaController $this */
/** @var Tconvocatoria $model */
$this->breadcrumbs=array(
	'Tconvocatorias'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
//	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Tconvocatoria::label(2), 'icon' => 'list', 'url' => array('index')),
//	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Tconvocatoria::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return true;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tconvocatoria-grid', {
		data: $(this).serialize()
	});
	return true;
});
");
?>

<fieldset>
    <legend>
        Buscar convocatoria para validación de datos JURECH    </legend>

<?php // echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'tconvocatoria-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->searchConvocatoriaValidacion(),
    'filter' => $model,
    'columns' => array(
    //    'COD_CONVOCATORIA',
        //'COD_JUNTA',
         array(
                    'name' => 'COD_JUNTA',
                    'value' => 'isset($data->cODJUNTA) ? $data->cODJUNTA : null',
                    'filter' => CHtml::listData(Junta::model()->findAll(), 'COD_JUNTA', Junta::representingColumn()),
                ),
        
//        'TITULO',
//        'TIPO',
//        'FECHA_INICIA',
//        'ENCABEZADO',
        /*
        'HORA',
        'CUERPO',
        'NOTA',
        'FIRMA',
        'ESTADO',
        */
         array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{ver} {actualizarConvocatoriaValidacion} {delete}',
                'buttons' => array
                    (
                    'ver' => array
                        (
                        'label' => 'VER EJEMPLO',
                        'icon' => 'list white',
                        'url' => 'Yii::app()->createUrl("tconvocatoria/verConvocatoriaValidacion", array("id"=>$data->COD_CONVOCATORIA))',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-success',
                        ),
                    ),
                   
                   
                    'actualizarConvocatoriaValidacion' => array
                        (
                        'label' => 'EDITAR',
                        'icon' => 'edit white',
                        'url' => 'Yii::app()->createUrl("tconvocatoria/actualizarConvocatoriaValidacion", array("id"=>$data->COD_CONVOCATORIA))',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-info',
                        ),
                    ),
                ),
            )
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
	),
)); ?>
</fieldset>