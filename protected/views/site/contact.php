<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contáctenos',
);
?>

<h1>Contáctenos</h1>

<?php if (Yii::app()->user->hasFlash('contact')): 
    
    
    ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

<?php else: ?>

    <p>
        Si tiene consultas comerciales u otras preguntas, por favor, rellene el siguiente formulario para contactar con nosotros. Gracias.
    </p>

    <div class="form">

        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'contact-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>

        <p class="note">Los campos que lleven <span class="required">*</span> se requieren.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'Nombre:'); ?>
            <?php echo $form->textField($model, 'name'); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'Email:'); ?>
            <?php echo $form->textField($model, 'email'); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'Asunto:'); ?>
            <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>
            <?php echo $form->error($model, 'subject'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'Cuerpo'); ?>
            <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'body'); ?>
        </div>

        <?php if (CCaptcha::checkRequirements()): ?>
            <div class="row">
                <?php echo $form->labelEx($model, 'verifyCode'); ?>
                <div>
                    <?php $this->widget('CCaptcha'); ?>
                    <?php echo $form->textField($model, 'verifyCode'); ?>
                </div>
                <div class="hint">Por favor, introduzca las letras que se muestran en la imagen de arriba.<br>
                    Las letras no distinguen entre mayúsculas y minúsculas.</div>
                <?php echo $form->error($model, 'verifyCode'); ?>
            </div>
        <?php endif; ?>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Enviar', array("class" => "btn btn-primary btn-large")); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

<?php endif; ?>