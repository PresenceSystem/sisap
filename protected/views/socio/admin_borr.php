<?php
/** @var SocioController $this */
/** @var Socio $model */
$this->breadcrumbs=array(
	'Socios'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	// array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Socio::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Socio::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('socio-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend class="btn-primary text-center">
        <?php echo Yii::t('AweCrud.app', 'Search') ?> <?php echo Socio::label(2) ?>    </legend>
 
<?php // echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'socio-grid',
    //'itemsCssClass'=>'table table-striped',
    'pager'=>array('htmlOptions'=>array('class'=>'pagination')),
    'type' => 'striped condensed bordered hover responsive',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
       // 'CODIGO',
        'CI',
        'APELLIDO',
        //'GENERO',
         array(
                'name'=>'GENERO',
                'header'=>'Género',
                'value' =>$model['GENERO'],
             'htmlOptions' =>array('class' => 'align-center'),
            ),
       // 'COD_BARRA',
        'DIRECCION',
        
        'TELEFONO',
       'CELULAR',
     //   'EMAIL',
       // 'ESTADO_CIVIL',
     //   'NOMBRE_CONYUGE',
      /*  'FOTO',
        'ESTADO',
        'TIPO',
        'FECHA_NACIMIENTO',
        'OBS',
        'COD_USUARIO',
        'FECHA_ACTUALIZACION',
        'FECHA_INGRESO',
        'FECHA_SALIDA',
        array(
					'name' => 'USU_AGUA_RIEGO',
					'value' => '($data->USU_AGUA_RIEGO === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
					'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
					),
        array(
					'name' => 'USU_AGUA_POTABLE',
					'value' => '($data->USU_AGUA_POTABLE === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
					'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
					),
        'COD_BARRA_RIEGO_OLD',
        'COD_BARRA_POTABLE',
        */
        
          array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => array
                    (
                    'view' => array
                        (
                        'label' => 'VER',
                        'icon' => 'list white',
                        'url' => 'Yii::app()->createUrl("socio/view", array("id"=>$data->CODIGO))',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-info',
                        ),
                    ),
                    'update' => array
                        (
                        'label' => 'EDITAR DATOS',
                        'icon' => 'edit white',
                        'url' => 'Yii::app()->createUrl("socio/update", array("id"=>$data->CODIGO))',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-warning',
                        ),
                    ),
                   
                   
//                    'pdf' => array(
//                        'label' => 'Generar PDF',
//                        'url' => "CHtml::normalizeUrl(array('pdf_socio', 'id'=>\$data->CODIGO
//                         ))",                        
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/imp_pdf.png',
//                        'options' => array('class' => 'pdf', 'target'=>'_BLANK'),
//                    ),
                ),
            )
        
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
	),
)); ?>
</fieldset>