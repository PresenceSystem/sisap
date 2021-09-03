<?php
/** @var MedidorController $this */
/** @var Medidor $model */
$this->breadcrumbs=array(
	'Medidors'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

?>

<fieldset>
    <legend class="btn-primary text-center">
       BUSCAR MEDIDOR   </legend>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'medidor-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'ID',
        'NUMERO',
//        'CONSUMO_INICIAL',
//        'ORDEN_RECORIDO',
         array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view} ',
                'buttons' => array
                    (
                    'view' => array
                        (
                        'label' => 'VER HISTORIAL DE PROPIETARIOS',
                        'icon' => 'list white',
                        'url' => 'Yii::app()->createUrl("medidor/historial_propietarios", array("id"=>$data->ID))',
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