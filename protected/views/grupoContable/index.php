<?php
/** @var GrupoContableController $this */
/** @var GrupoContable $model */
$this->breadcrumbs = array(
	'Grupo Contables',
);

$this->menu = array(
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . GrupoContable::label(), 'icon' => 'plus', 'url' => array('create')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend>
        <?php echo Yii::t('AweCrud.app', 'List') ?> <?php echo GrupoContable::label(2) ?>    </legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
)); ?>
</fieldset>