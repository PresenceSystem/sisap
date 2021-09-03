<div class="form row text-info">
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
    <?php //echo $form->textFieldRow($model, 'foto', array('class' => 'span9', 'maxlength' => 200)) ?>
    <!-- Código para subir foto -->
    <div class=" form-actions ">
        <?php if ($model->isNewRecord != '1') { ?>

            <?php
            if ($model->foto == NULL or $model->foto == "") {
                $model->foto = "usuario.png";
            }
            echo CHtml::image(Yii::app()->request->baseUrl . '/images/fotos/' . $model->foto, "...", array("width" => 100));
            echo "<div class='row'><b>USUARIO: </b>" . $model->username . "</div>";
            ?>  

        <?php } ?>
        <div class="column">
            <?php echo $form->labelEx($model, 'foto'); ?>
            <?php echo CHtml::activeFileField($model, 'foto'); //con esto levantamos la imagen  ?>  
            <?php echo $form->error($model, 'foto'); ?>
        </div>
    </div>

    <!-- Termina código para subir foto -->
    <div class="form-actions">
        <?php echo $form->textFieldRow($model, 'username', array('class' => 'span2', 'maxlength' => 50)) ?>
        <?php //echo $form->passwordFieldRow($model, 'password', array('disabled' => 'true', 'class' => 'span9', 'maxlength' => 100)) ?>
        <?php echo $form->textFieldRow($model, 'nombres', array('class' => 'span5', 'maxlength' => 100)) ?>
        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 250)) ?>
        <?php echo $form->textFieldRow($model, 'telefono', array('class' => 'span3')) ?>
        <?php echo $form->textFieldRow($model, 'direccion', array('class' => 'span9', 'maxlength' => 250)) ?>

        <?php //echo $form->textFieldRow($model, 'id_referencia', array('disabled' => 'true', 'class' => 'span9')) ?>
        <?php //echo $form->dropDownListRow($model, 'Rol', CHtml::listData(Rol::model()->findAll(), 'id_rol', Rol::representingColumn()), array()) ?>
        <?php //echo $form->dropDownListRow($model, 'Rol', array('3' => 'Socio')); ?>
        <?php //echo $form->textFieldRow($model, 'codigo_barra', array('disabled' => 'true', 'class' => 'span9', 'maxlength' => 100)) ?>
        <?php // echo $form->textAreaRow($model, 'descripcion', array('class' => 'span9', 'maxlength' => 500)) ?>

        <div class="row">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Habilitar') : Yii::t('AweCrud.app', 'Save'),
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
    </div>

    <?php $this->endWidget(); ?>
</div>