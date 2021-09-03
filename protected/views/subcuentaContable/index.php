<?php
/** @var SubcuentaContableController $this */
/** @var SubcuentaContable $model */
$this->breadcrumbs = array(
	'Subcuenta Contables',
);

$this->menu = array(
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . SubcuentaContable::label(), 'icon' => 'plus', 'url' => array('create')),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend>
        <?php echo Yii::t('AweCrud.app', 'List') ?> <?php echo SubcuentaContable::label(2) ?>    </legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
)); ?>
</fieldset>