<div class="form">
    <?php
    /** @var SocioMedidorController $this */
    /** @var SocioMedidor $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'socio-medidor-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

                            <?php //echo $form->dropDownListRow($model, 'CODIGO_SOCIO', CHtml::listData(Socio::model()->findAll(), 'CODIGO', Socio::representingColumn())) ?>
                            <div class="row">        
        <?php // echo $form->labelEx($model, 'CODIGO_SOCIO'); ?>
                                <b>Buscar:</b> por CI, apellidos o nombres.
        <br> 
        <!--<a href="../../vertice/create">Ingresar nuevo vertice</a>-->        
        <?php
        if ($model->CODIGO_SOCIO) {
            $value = $model->cODIGOSOCIO->APELLIDO;
        } else {
            // $value = '';
            $value = '';
        }
        echo $form->hiddenField($model, 'CODIGO_SOCIO', array());
        // echo '<input type="hidden" id="autocomplete" name="autocomplete" value="0" />';
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'CODIGO_SOCIO',
            'model' => $model,
            'value' => $value,
            'sourceUrl' => $this->createUrl('socio/ListarSocios'),
            'options' => array(
                'minLength' => '1',
                'showAnim' => 'fold',
                'select' => 'js:function(event, ui)
                                                                       { jQuery("#SocioMedidor_CODIGO_SOCIO").val(ui.item.id); }',
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
//                                                                                'url'=> '/socio/index.php/socio/ingresarNuevo',
//                                                                               'icon'=>'user',
//                                                                           )
//                                                                           );
        ?>
    </div>
                        <?php //echo $form->dropDownListRow($model, 'ID_MEDIDOR', CHtml::listData(Medidor::model()->findAll(), 'ID', Medidor::representingColumn())) ?>
                        <?php //echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')) ?>
                <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
		)); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Cancel'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		)); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>