<?php
/** @var AsistenciaController $this */
/** @var Asistencia $model */
$this->breadcrumbs=array(
	'Asistencias'=>array('index'),
	$model->CODIGO_ASISTENCIA,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Asistencia::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Asistencia::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->CODIGO_ASISTENCIA)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->CODIGO_ASISTENCIA), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'View') . ' ' . Asistencia::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data' => $model,
	'attributes' => array(
        'CODIGO_ASISTENCIA',
        array(
			'name'=>'CODIGO_SOCIO',
			'value'=>($model->cODIGOSOCIO !== null) ? CHtml::link($model->cODIGOSOCIO, array('/socio/view', 'CODIGO' => $model->cODIGOSOCIO->CODIGO)).' ' : null,
			'type'=>'html',
		),
        array(
			'name'=>'CODIGO_REUNION',
			'value'=>($model->cODIGOREUNION !== null) ? CHtml::link($model->cODIGOREUNION, array('/reunion/view', 'CODIGO_REUNION' => $model->cODIGOREUNION->CODIGO_REUNION)).' ' : null,
			'type'=>'html',
		),
        'FECHA',
        array(
                'name'=>'HORA',
                'type'=>'time'
            ),
        array(
                'name'=>'REGISTRA_INGRESO_PUNTUAL',
                'type'=>'boolean'
            ),
        array(
                'name'=>'REGISTRA_ATRASO',
                'type'=>'boolean'
            ),
        array(
                'name'=>'REGISTRA_FUGA',
                'type'=>'boolean'
            ),
        array(
                'name'=>'REGISTRA_SALIDA_PUNTUAL',
                'type'=>'boolean'
            ),
        'OBSERVACIONES',
        'COD_USUARIO',
        'FECHA_ACTUALIZACION',
	),
)); ?>
</fieldset>