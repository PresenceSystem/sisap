<div class="form">
    <?php
    /** @var UsuarioController $this */
    /** @var Usuario $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'usuario-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'), //NO TE OLVIDES DE ASIGNAR ESTO PARA LA foto
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

                           
                        <?php echo $form->textFieldRow($model, 'nombres', array('class' => 'span5', 'maxlength' => 100)) ?>
                    <?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 50)) ?>
                        <?php // echo $form->passwordFieldRow($model, 'password', array('class' => 'span5', 'maxlength' => 100)) ?>
                         <?php  echo $form->passwordFieldRow($model, 'password', array('class' => 'span5','placeholder'=>"Para ingresar o modificar digite su clave.", 'value' => '', 'maxlength' => 100)) ?>
                          <?php  echo $form->passwordFieldRow($model, 'validador_pass', array('class' => 'span5','placeholder'=>"Ingrese para verificar su clave.", 'value' => '', 'maxlength' => 100)) ?>
   
                        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 250)) ?>
                        <?php echo $form->textFieldRow($model, 'telefono', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'direccion', array('class' => 'span5', 'maxlength' => 250)) ?>
                       
                        <?php //echo $form->textFieldRow($model, 'id_referencia', array('class' => 'span5')) ?>
                        <?php // echo $form->dropDownListRow($model, 'Rol', CHtml::listData(Rol::model()->findAll(), 'id_rol', Rol::representingColumn())) ?>
                        <?php echo $form->textFieldRow($model, 'codigo_barra', array('class' => 'span5', 'maxlength' => 100)) ?>
                        <?php //echo $form->textAreaRow($model, 'descripcion', array('class' => 'span5', 'maxlength' => 500)) ?>
                         <?php //echo $form->textFieldRow($model, 'foto', array('class' => 'span5', 'maxlength' => 200)) ?>
                                    <!-- Código para subir foto -->
                                    <div class="span10">
                                <?php if ($model->isNewRecord != '1') { ?>

                                   <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/fotos/' . $model->foto, "...", array("width" => 100)); ?>  
   
                               <?php } ?>
                               <div class="column">
                               <?php echo $form->labelEx($model, 'foto'); ?>
                               <?php echo CHtml::activeFileField($model, 'foto'); //con esto levantamos la imagen  ?>  
                                   <?php echo $form->error($model, 'foto'); ?>
                               </div>
                             </div>
                                   
                               <!-- Termina código para subir foto -->
                <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Save') : Yii::t('AweCrud.app', 'Guardar cambios'),
		)); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Cancel'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		)); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>