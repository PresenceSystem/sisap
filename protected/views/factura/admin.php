<?php
/** @var FacturaController $this */
/** @var Factura $model */
$this->breadcrumbs=array(
	'Facturas'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
//	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Factura::label(2), 'icon' => 'list', 'url' => array('index')),
//	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Factura::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('factura-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend class='text-center center btn-primary'>
        BUSCAR FACTURA POR NÚMERO DE EMISIÓN  </legend>



<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'factura-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'ID',
        array(
                    'name' => 'ID_MEDIDOR_SOCIO',
                    'value' => 'isset($data->iDMEDIDORSOCIO) ? $data->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO : null',
                   // 'filter' => CHtml::listData(SocioMedidor::model()->findAll(), 'ID', SocioMedidor::representingColumn()),
                ),
        'CONSUMO_ANTERIOR',
        'CONSUMO_ACTUAL',
       // 'CONSUMO_CALCULADO',
        'MES_COBRO',
		'ANIO_COBRO',
        'NUMERO_FACTURA',
        /*
        
        'ESTADO',
        array(
					'name' => 'TIPO',
					'value' => '($data->TIPO === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
					'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
					),
        */
		   array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{ingresar} ',
                'buttons' => array
                    (
                    'ingresar' => array
                        (
                        'label' => 'VER DETALLE DE IMPRESIÓN DE FACTURA',
                        'icon' => 'trash white',
                        'url' => 'Yii::app()->createUrl("factura/".$data->ID)',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-info',
                        ),
                    ),
                   
                   

                ),          
        

	),
	),
)); ?>
</fieldset>