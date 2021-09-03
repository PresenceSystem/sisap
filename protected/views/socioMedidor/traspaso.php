<?php
/** @var SocioMedidorController $this */
/** @var SocioMedidor $model */
$this->breadcrumbs=array(
	'Socio Medidors'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

//$this->menu=array(
//	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . SocioMedidor::label(2), 'icon' => 'list', 'url' => array('index')),
//	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . SocioMedidor::label(), 'icon' => 'plus', 'url' => array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('socio-medidor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend class="btn-primary text-center">
     <h4>   TRASPASO DEL MEDIDOR(Servicio de agua potable) A OTRO DUEÑO</h4>     
    </legend>
    <p class="badge-warning">Si el usuario tiene el servicio de alcantarillado anexo al servicio de agua potable, 
         el traspaso del servicio de alcantarillado será de forma automática.</p>
 <?php // if (Yii::app()->user->getFlash('Ya_tiene_medidor') != null) //Existe mensaje
  //{ ?>
 
<?php // echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'socio-medidor-grid',    
    'dataProvider' => $model->search(),
    'filter' => $model,
    'type' => 'striped condensed bordered hover responsive',
    'columns' => array(
        array(
           'name'=>'socio_search',
           'value' => '$data->cODIGOSOCIO->APELLIDO',
        ),
          array(
           'name'=>'medidor_search',
           'value' => '$data->iDMEDIDOR->NUMERO',
        ),
//        'ID',
//        array('name'=>'CODIGO_SOCIO',
//                'value'=>'$data->cODIGOSOCIO->APELLIDO',
//                ),
//                array (
//                    'name' => 'CODIGO_SOCIO',
//                    'value'=>'$data->cODIGOSOCIO->APELLIDO',
//                    
//                    ),
//        array(
//                    'name' => 'ID_MEDIDOR',
//                    'value'=>'$data->iDMEDIDOR->NUMERO',
//                   // 'value' => 'isset($data->iDMEDIDOR) ? $data->iDMEDIDOR : null',
//                    //'filter' => CHtml::listData(Medidor::model()->findAll(), 'ID', Medidor::representingColumn()),
//                ),
   //     'COD_USUARIO',
   //     'FECHA_ACTUALIZACION',
          array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{ingresar} ',
                'buttons' => array
                    (
                    'ingresar' => array
                        (
                        'label' => 'CAMBIAR PROPIETARIO',
                        'icon' => 'adjust white',
                        'url' => 'Yii::app()->createUrl("socioMedidor/cambiarPropietario", array("id"=>$data->ID))',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-info',
                        ),
                    ),
                    )) 
        
        
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
	),
)); ?>
</fieldset>