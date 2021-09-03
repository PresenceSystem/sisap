<?php
/** @var UsuarioController $this */
/** @var Usuario $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

//$this->menu=array(
//    //array('label' => Yii::t('AweCrud.app', 'List').' '.Usuario::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'Create') . ' ' . Usuario::label(); ?></legend>
    <?php echo $this->renderPartial('_form_bibliotecario', array('model' => $model)); ?>
</fieldset>