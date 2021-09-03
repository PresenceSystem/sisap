<?php
/* @var $this TconvocadoController */
/* @var $model Tconvocado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tconvocado-form',
	'enableAjaxValidation'=>false,
     'focus' => array($model, 'CODIGO_SOCIO'),
        'focus' => 'input:text[value=""]:first',
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'COD_CONVOCATORIA'); ?>
		<?php //echo $form->textField($model,'COD_CONVOCATORIA',array('size'=>11,'maxlength'=>11)); ?>
		<?php //echo $form->error($model,'COD_CONVOCATORIA'); 
                echo "<h2>CONVOCATORIA N°: ".$model->COD_CONVOCATORIA."</h2>"; ?>
	</div>

	<div class="row">
            <div class="row">        
        <?php //echo $form->labelEx($model, 'CODIGO'); ?>
        Buscar: por CI, apellidos o nombres.
        <br> 
        <!--<a href="../../vertice/create">Ingresar nuevo vertice</a>-->        
        <?php
        if ($model->COD_SOCIO) {
            $value = $model->cODSOCIO->APELLIDO;
        } else {
            // $value = '';
            $value = '';
        }
        echo $form->hiddenField($model, 'COD_SOCIO', array());
        // echo '<input type="hidden" id="autocomplete" name="autocomplete" value="0" />';
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'COD_SOCIO',
            'model' => $model,
            'value' => $value,
            // 'attribute' => 'COD_SOCIO',
            'sourceUrl' => $this->createUrl('socio/ListarSocios'),
            'options' => array(
                'minLength' => '1',
                'showAnim' => 'fold',
                'select' => 'js:function(event, ui)
                                                                       { jQuery("#Tconvocado_COD_SOCIO").val(ui.item.id); }',
            //                'search' => 'js:function(event, ui)
            // { jQuery("#COD_VERTICE").val(1); }'
            ),
            'htmlOptions' => array(
                'style' => "font-size: 13px; font-family: Arial,Helvetica,sans-serif; line-height: 28px; height: 20px; width: 65%;"
            ),
        ));
        ?>
        <br>
        <?php
        //Nuevo
//                                                             $this->widget(
//                                                                           'bootstrap.widgets.TbButton',
//                                                                           array(
//                                                                           'label' => 'Ingresar nuevo socio',                                    
//                                                                                'url'=> '/sisbiblio/index.php/socio/create',
//                                                                               'icon'=>'user',
//                                                                           )
//                                                                           );
        ?>
    </div> 
		<?php //echo $form->labelEx($model,'COD_SOCIO'); ?>
		<?php //echo $form->textField($model,'COD_SOCIO'); ?>
		<?php echo $form->error($model,'COD_SOCIO'); ?>
	</div>

	<div class="row buttons ">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->