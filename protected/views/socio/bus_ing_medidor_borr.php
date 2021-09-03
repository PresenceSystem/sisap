<?php
/** @var SocioController $this */
/** @var Socio $model */
$this->breadcrumbs=array(
	'Socios'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Socio::label(2), 'icon' => 'list', 'url' => array('index')),
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
        BUSCAR USUARIO DE AGUA POTABLE
    </legend>
    <p class="">
    <ul>
        <li>
            Busque el usuario para ingresar un medidor nuevo.
        </li>
        <li>
            El usuario solo puede tener un médidor a su nombre.
        </li>
    </ul>
    </p>

    <div class="flash-notice">
        <?php  echo Yii::app()->user->getFlash('Buscar'); ?>
    </div>

    
<?php // echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'socio-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
       // 'CODIGO',
        'CI',
        'APELLIDO',
       // 'GENERO',
       // 'COD_BARRA',
       // 'DIRECCION',
        /*
        'TELEFONO',
        'CELULAR',
        'EMAIL',
        'ESTADO_CIVIL',
        'NOMBRE_CONYUGE',
        'FOTO',
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
                'template' => '{ingresar} ',
                'buttons' => array
                    (
                    'ingresar' => array
                        (
                        'label' => 'INGRESAR MEDIDOR',
                        'icon' => 'list white',
                        'url' => 'Yii::app()->createUrl("socioMedidor/buscar_x_socio", array("id"=>$data->CODIGO))',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-info',
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
            
        
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
	), )
    )
); ?>
</fieldset>