<?php
/** @var TconvocatoriaController $this */
/** @var Tconvocatoria $model */
$this->breadcrumbs=array(
	'Tconvocatorias'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
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
        <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo Tconvocatoria::label(2) ?>    </legend>

<?php // echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'tconvocatoria-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->searchLocal(),
    'filter' => $model,
    'columns' => array(
        'COD_CONVOCATORIA',
        //'COD_JUNTA',
//         array(
//                    'name' => 'COD_JUNTA',
//                    'value' => 'isset($data->cODJUNTA) ? $data->cODJUNTA : null',
//                    'filter' => CHtml::listData(Junta::model()->findAll(), 'COD_JUNTA', Junta::representingColumn()),
//                ),
        'ENCABEZADO',
        'TITULO',
        'TIPO',
        'FECHA',
        /*
        'HORA',
        'CUERPO',
        'NOTA',
        'FIRMA',
        'ESTADO',
        */
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>