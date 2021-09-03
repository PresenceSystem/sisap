<div class="form">
    <?php
    /** @var CuotaController $this */
    /** @var Cuota $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'cuota-form',
    'enableAjaxValidation' => true,
    'enableClientValidation'=> false,
         'focus' => array($model, 'ID_DETALLE'),
        'focus' => 'input:text[value=""]:first',
    )); ?>

    

    <?php echo $form->errorSummary($model) ?>

                            <?php //echo $form->dropDownListRow($model, 'ID_DETALLE', CHtml::listData(Detalle::model()->findAll(), 'ID', Detalle::representingColumn())) ?>
      <div class="col-md-12 btn-primary fondoLogin text-center">
        <div class="col-xs-10">
                            <div class="row span">        
                                <h5>Buscar: por CI, apellidos o nombres.</h5>

                                <!--<a href="../../vertice/create">Ingresar nuevo vertice</a>-->        
                                <?php
                                if ($model->ID_DETALLE) {
                                    $value = $model->iDDETALLE->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO;
                                } else {
                                    // $value = '';
                                    $value = '';
                                }
                                echo $form->hiddenField($model, 'ID_DETALLE', array());
                                // echo '<input type="hidden" id="autocomplete" name="autocomplete" value="0" />';
                                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                    'name' => 'ID_DETALLE',
                                    'model' => $model,
                                    'value' => $value,
                                    'sourceUrl' => $this->createUrl('socio/ListarSocios'),
                                    'options' => array(
                                        'minLength' => '1',
                                        'showAnim' => 'fold',
                                        'select' => 'js:function(event, ui)
                                                            { jQuery("#Cuota_ID_DETALLE").val(ui.item.id);                                     
                                                            }',
                                    ),
                                    'htmlOptions' => array(
                                        'style' => "font-size: 15px; font-family: Arial,Helvetica,sans-serif; line-height: 30px; height: 25px; width: 100%;"
                                    ),
                                ));
                                ?>
                            
                            </div>
                        <?php //echo $form->textFieldRow($model, 'FECHA', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'ABONO', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php //echo $form->textFieldRow($model, 'SALDO', array('class' => 'span5', 'maxlength' => 6)) ?>
                        <?php // echo $form->textFieldRow($model, 'OBSERVACION', array('class' => 'span5', 'maxlength' => 1000)) ?>
                        <?php // echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span5')) ?>
                        <?php //echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span5')) ?>
        </div>
          <div class="col-xs-2">
              <br><br>
                <?php 
                $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'success',
                'icon' => 'search',
                'htmlOptions' => array(
                    'id' => 'botonBuscar',
                ),
                'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Buscar') : Yii::t('AweCrud.app', 'Save'),
            ));
                ?>
        <?php /*$this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
			'label'=> Yii::t('AweCrud.app', 'Cancel'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		));*/ ?>
          </div>
    </div>

    <?php $this->endWidget(); ?>
</div>