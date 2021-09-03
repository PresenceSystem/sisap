<?php
/** @var ParametroController $this */
/** @var Parametro $model */
$this->breadcrumbs = array(
    'Parametros' => array('index'),
    Yii::t('AweCrud.app', 'Manage'),
);

//$this->menu = array(
//    array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Parametro::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Parametro::label(), 'icon' => 'plus', 'url' => array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('parametro-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<fieldset>
    <legend>
        <?php echo Yii::t('AweCrud.app', 'Manage') ?> <?php echo Parametro::label(2) ?>    </legend>

    <?php //echo CHtml::link('<i class="icon-search"></i> ' . Yii::t('AweCrud.app', 'Advanced Search'), '#', array('class' => 'search-button btn')) ?>
    <div class="search-form" style="display:none">
        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>
    </div><!-- search-form -->

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'parametro-grid',
        'type' => 'striped condensed',
        'dataProvider' => $model->searchTarifa(),
        'filter' => $model,
        'columns' => array(
            'ID',
            'DESCRIPCION',
            'VALOR',
            'VALOR_MIN',
            'VALOR_MAX',
            array(
                'name' => 'ESTADO',
                'value' => '($data->ESTADO === 0) ? Yii::t(\'AweCrud.app\', \'No\') : Yii::t(\'AweCrud.app\', \'Yes\')',
                'filter' => array('0' => Yii::t('AweCrud.app', 'No'), '1' => Yii::t('AweCrud.app', 'Yes')),
            ),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ),
        ),
    ));
    ?>
</fieldset>