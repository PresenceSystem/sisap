<?php
/** @var UsuarioController $this */
/** @var Usuario $model */
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	Yii::t('AweCrud.app', 'Buscar'),
);

//$this->menu=array(
//	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Usuario::label(2), 'icon' => 'list', 'url' => array('index')),
//	array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Usuario::label(), 'icon' => 'plus', 'url' => array('create')),
//);

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
        <?php echo 'Buscar usuario y sacar su historial de prestamos' ?>    </legend>



<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'usuario-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'username',
        //'password',
        'nombres',
       // 'email',
        //'telefono',
        /*
        'direccion',
        'foto',
        'id_referencia',
        array(
                    'name' => 'Rol',
                    'value' => 'isset($data->rol) ? $data->rol : null',
                    'filter' => CHtml::listData(Rol::model()->findAll(), 'id_rol', Rol::representingColumn()),
                ), */
        'codigo_barra',
        //'descripcion',
        
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
        array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
               // 'template' => '{update}  {delete}  {prestar}',
                'template' => ' {prestamos}',
                'buttons' => array
                    ( 
                    'prestamos' => array
                        (
                        'label' => 'Emitir historial', 
                        'icon' => 'ok red',
                        'url' => 'Yii::app()->createUrl("usuario/pdfHistorialPrestamo", array("id"=>$data->id))',
                        'options' => array(
                            'class' => 'btn',                           
                        ),
                    ),
                    
                    ))
        
	),
)); ?>
</fieldset>