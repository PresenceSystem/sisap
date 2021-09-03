<div class="form">
    <?php
    /** @var UsuarioController $this */
    /** @var Usuario $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'usuario-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'), //NO TE OLVIDES DE ASIGNAR ESTO PARA LA foto
    ));
    ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
    <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

<?php echo $form->errorSummary($model) ?>

   
    <?php //echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 50)) ?>
    <?php // echo $form->passwordFieldRow($model, 'password', array('class' => 'span5', 'maxlength' => 100)) ?>
    <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span5', 'placeholder' => "Ingresar solo si necesita cambiar la clave.", 'value' => '', 'maxlength' => 100)) ?>
    <?php echo $form->passwordFieldRow($model, 'validador_pass', array('class' => 'span5', 'placeholder' => "Ingrese nuevamente para verificar.", 'value' => '', 'maxlength' => 100)) ?>





    <!-- Termina código para subir foto -->
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
        ));
        ?>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            //'buttonType'=>'submit',
            'label' => Yii::t('AweCrud.app', 'Cancel'),
            'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
        ));
        ?>
    </div>

<?php $this->endWidget(); ?>
</div>