<?php
/** @var UsuarioController $this */
/** @var Usuario $model */
$this->breadcrumbs = array(
	'Lista de usuarios',
);

$this->menu = array(
//    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Usuario::label(), 'icon' => 'plus', 'url' => array('create')),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
     array('label' => Yii::t('AweCrud.app', 'Exportar a pdf'), 'icon' => 'list-alt', 'url' => array('pdf')),
);
?>

<fieldset>
    <legend>
        <?php echo Yii::t('AweCrud.app', 'List') ?> <?php echo Usuario::label(2) ?>    </legend>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
)); ?>
</fieldset>