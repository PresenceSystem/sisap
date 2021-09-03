<div class="form">
    <?php
    /** @var DetalleController $this */
    /** @var Detalle $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'detalle-form',
    'enableAjaxValidation' => false,
    'enableClientValidation'=> false,
    )); ?>

    <p class="note">
        <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
        <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

    <?php echo $form->errorSummary($model) ?>

                            <?php //echo $form->dropDownListRow($model, 'ID_FACTURA', CHtml::listData(Factura::model()->findAll(), 'ID', Factura::representingColumn())) ?>
    <!--EL CODIGO DE RECIBO SE ASIGNARA EL CODIGO DEL USUARIO DE RIOGO TEMPORALMENTE HASTA EL CONTROLADOR-->
    <div class="row">        
        <?php echo $form->labelEx($model, 'ID_FACTURA'); ?>
        Buscar: por CI, apellidos o nombres.
        <br> 
        <!--<a href="../../vertice/create">Ingresar nuevo vertice</a>-->        
        <?php
        if ($model->ID_FACTURA) {
            $value = $model->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO;
        } else {
            // $value = '';
            $value = '';
        }
        echo $form->hiddenField($model, 'ID_FACTURA', array());
        // echo '<input type="hidden" id="autocomplete" name="autocomplete" value="0" />';
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'ID_FACTURA',
            'model' => $model,
            'value' => $value, 
            // 'attribute' => 'ID_FACTURA',
            'sourceUrl' => $this->createUrl('socio/ListarSocios'),
            'options' => array(
                'minLength' => '1',
                'showAnim' => 'fold',
                'select' => 'js:function(event, ui)
                                                                       { jQuery("#Detalle_ID_FACTURA").val(ui.item.id); }',
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
<!--fin EL CODIGO DE RECIBO SE ASIGNARA EL CODIGO DEL USUARIO DE RIOGO TEMPORALMENTE HASTA EL CONTROLADOR-->
                        <?php echo $form->textFieldRow($model, 'CANTIDAD', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'V_UNITARIO', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php /* echo $form->textFieldRow($model, 'V_TOTAL', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php /echo $form->textFieldRow($model, 'IVA', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php echo $form->textFieldRow($model, 'PORC_MORA', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'VALOR_MORA', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'FECHA_COBRO', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'ESTADO', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')) ?>
                        <?php echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')) */ ?>
                <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
		)); ?>
       
	   
    </div>

    <?php $this->endWidget(); ?>
</div>