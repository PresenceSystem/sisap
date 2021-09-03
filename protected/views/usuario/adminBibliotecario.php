<?php
/** @var UsuarioController $this */
/** @var Usuario $model */
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Usuario::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Usuario::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('usuario-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo Usuario::label(2) ?>    </legend>

<?php echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'usuario-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'username',
        'password',
        'nombres',
        'email',
        'telefono',
        /*
        'direccion',
        'foto',
        'id_referencia',
        array(
                    'name' => 'Rol',
                    'value' => 'isset($data->rol) ? $data->rol : null',
                    'filter' => CHtml::listData(Rol::model()->findAll(), 'id_rol', Rol::representingColumn()),
                ),
        'codigo_barra',
        'descripcion',
        */
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
        
	),
)); ?>
</fieldset>