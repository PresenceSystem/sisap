<?php
/** @var SocioMedidorController $this */
/** @var SocioMedidor $model */
$this->breadcrumbs = array(
    'Socio Medidors' => array('index'),
    Yii::t('AweCrud.app', 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t('AweCrud.app', 'List') . ' ' . SocioMedidor::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . SocioMedidor::label(), 'icon' => 'plus', 'url' => array('create')),
);

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
    <legend>
        <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo SocioMedidor::label(2) ?>    </legend>

    <?php echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
    <div class="search-form" style="display:none">
        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>
    </div><!-- search-form -->

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'socio-medidor-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'ID',
            array(
                'name' => 'CODIGO_SOCIO',
                'value' => 'isset($data->cODIGOSOCIO) ? $data->cODIGOSOCIO : null',
                'filter' => CHtml::listData(Socio::model()->findAll(), 'CODIGO', Socio::representingColumn()),
            ),
            array(
                'name' => 'ID_MEDIDOR',
                'value' => 'isset($data->iDMEDIDOR) ? $data->iDMEDIDOR : null',
                'filter' => CHtml::listData(Medidor::model()->findAll(), 'ID', Medidor::representingColumn()),
            ),
            'COD_USUARIO',
            'FECHA_ACTUALIZACION',
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ),
        ),
    ));
    ?>
</fieldset>