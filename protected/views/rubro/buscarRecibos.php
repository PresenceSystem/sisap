<?php
/** @var RubroController $this */
/** @var Rubro $model */
$this->breadcrumbs=array(
	'Rubros'=>array('index'),
	Yii::t('AweCrud.app', 'Manage'),
);

$this->menu=array(
	//array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Rubro::label(2), 'icon' => 'list', 'url' => array('index')),
	//array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Rubro::label(), 'icon' => 'plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('rubro-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h3 class="btn-info text-center">Buscar rubros de <strong>recibos</strong></h3>
<fieldset>
<table class='table table-hover'>
<tr><td>
<?php echo CHtml::image(Yii::app()->baseUrl."/images/pagina/0.jpg",'alt', array('width'=>40,'height'=>40)); ?> Rubro de recibo para la JAAPA
</td></tr>
<tr><td>
<?php echo CHtml::image(Yii::app()->baseUrl."/images/pagina/2.jpg", 'alt' , array('width'=>50,'height'=>50)); ?> Rubro de recibo para la comunidad
</td></tr>
</table>
<?php //echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id' => 'rubro-grid',
    'type' => 'striped condensed',
    'dataProvider' => $model->searchRecibos(),
    'filter' => $model,
    'columns' => array(
      //  'ID',
        'DESCRIPCION',
        'V_UNITARIO',
      //  'PORCEN',
        'FEC_CREACION',
		//'APLICA',
		     array(
                'name' => 'APLICA',
				
                //'filter' => array( 0 => 'JAAPA', 2 => 'COMUNIDAD'),
                'value' => 'CHtml::image(Yii::app()->request->baseUrl."/images/pagina/".$data->APLICA.".jpg", 
                            "",    array(\'width\'=>50, \'height\'=>50))',
                'type' => 'raw',
             'htmlOptions'=>array('width'=>'10%'),
            ),
			
		array(
                'name' => 'ID_SUBCUENTA',
                'value' => 'isset($data->iDSUBCUENTA->SUBCUENTA) ? $data->iDSUBCUENTA->SUBCUENTA : null',
                'filter' => CHtml::listData(SubcuentaContable::model()->findAll(), 'ID', 'SUBCUENTA'),
            ),	
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
</fieldset>