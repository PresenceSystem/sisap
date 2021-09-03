<?php
/** @var GrupoController $this */
/** @var Grupo $model */
$this->breadcrumbs = array(
    'Grupos' => array('index'),
    Yii::t('AweCrud.app', 'Manage'),
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('grupo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend class="btn btn-primary text-center">
        <h4>BUSCAR GRUPO</h4>
    </legend>
    <p>Seleccione el grupo para consultar los usuarios de alcantarillado.</p>




    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'grupo-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            //  'COD_GRUPO',
            'GRUPO',
            'DESCRIPCION',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{ingresar} ',
                'buttons' => array
                    (
                    'ingresar' => array
                        (
                        'label' => 'LISTAR',
                        'icon' => 'list white',
                        'url' => 'Yii::app()->createUrl("socio/lista_alcantarillado_por_grupo", array("id"=>$data->COD_GRUPO))',
//                        'imageUrl' => Yii::app()->request->baseUrl . '/images/ver.jpeg',
                        'options' => array(
                            'class' => 'btn btn-small btn-info',
                        ),
                    ),
                ),
            ),
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
        ),
    ));
    ?>
</fieldset>