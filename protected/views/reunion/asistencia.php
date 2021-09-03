<?php
/** @var ReunionController $this */
/** @var Reunion $model */
$this->breadcrumbs=array(
	'Reunions'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Reunion::label(2), 'icon' => 'list', 'url' => array('index')),
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
    <legend class="text-center">
        <h3 class="text-info">REUNIONES CREADAS</h3> </legend>
        <span>
            Busque la reunión de la cual se registrará el ingreso de asistencia.
           <br> <B>Nota:</B> Muestra reuniones que fueron solo creadas, y ahun no registran salida o fue la reunión terminada
        </span>

<?php //echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'reunion-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->searchAsistencia(),
    'filter' => $model,
    'columns' => array(
      //  'CODIGO_REUNION',
        array(
                    'name' => 'CODIGO_TIPO',
                    'value' => 'isset($data->cODIGOTIPO) ? $data->cODIGOTIPO : null',
                    'filter' => CHtml::listData(TipoReunion::model()->findAll(), 'CODIGO_TIPO', TipoReunion::representingColumn()),
                ),
        'FECHA',
        
        'HORA_INGRESO',
        'TIEMPO_ESPERA',
        //'ESTADO',
        //'VALOR_ATRASO',
        /*
        'VALOR_FUGA',
        'VALOR_FALTA',
        
        'COD_USUARIO',
        'FECHA_ACTUALIZACION',
        */
          array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{registrar} ',
                'buttons' => array
                    (
                    'registrar' => array
                        (
                        'label' => 'REGISTRAR ASISTENCIA',
//                        'icon' => 'list white',
                        'url' => 'Yii::app()->createUrl("asistencia/registrar", array("id"=>$data->CODIGO_REUNION))',
                         'imageUrl' => Yii::app()->request->baseUrl . '/images/iconos/editar_15.png', array("width" => '4px'),
                            'options' => array('class' => 'registrar'),
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