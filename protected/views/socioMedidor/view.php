<?php
/** @var SocioMedidorController $this */
/** @var SocioMedidor $model */
$this->breadcrumbs=array(
	'Socio Medidors'=>array('index'),
	$model->ID,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . SocioMedidor::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->ID)),
    
);
?>

<fieldset>
    <legend class="btn-primary text-center ">ACOMETIDA DE AGUA POTABLE</legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
      //  'ID',
        array(
			'name'=>'CODIGO_SOCIO',
			'value'=>($model->cODIGOSOCIO !== null) ? CHtml::link($model->cODIGOSOCIO->APELLIDO, array('/socio/view/'. $model->cODIGOSOCIO->CODIGO)).' ' : null,
			'type'=>'html',
		),
        array(
			'name'=>'ID_MEDIDOR',
			'value'=>($model->iDMEDIDOR !== null) ? CHtml::link($model->iDMEDIDOR, array('/medidor/view/'. $model->iDMEDIDOR->ID)).' ' : null,
			'type'=>'html',
		),
       // 'COD_USUARIO',
        'FECHA_ACTUALIZACION',
        array(
                                    'name' => 'SOLO_ALCANTARILLADO',
                                    'value' => ($model->SOLO_ALCANTARILLADO == 1) ? '<h5 class="badge-warning badge h1">(Si) Acometida sin agua potable</h5>' : '<h5 class="badge-info badge">(No) Acometida con agua potable</h5>',
                                    'type' => 'html',
                                ),
	),
)); ?>
</fieldset>