  

<div class="form-actions">
    <?php
    /** @var SocioController $this */
    /** @var Socio $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
        'id' => 'socio-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'), //NO TE OLVIDES DE ASIGNAR ESTO PARA LA FOTO
    ));
    ?>
    <div class="panel-group">
        <p class="note">
            <?php echo Yii::t('AweCrud.app', 'Fields with') ?> <span class="required">*</span>
            <?php echo Yii::t('AweCrud.app', 'are required') ?>.    </p>

        <?php echo $form->errorSummary($model) ?>

        <?php // echo $form->textFieldRow($model, 'CODIGO', array('class' => 'span10')) ?>
        <?php // echo $form->textFieldRow($model, 'CI', array('class' => 'span10', 'maxlength' => 13)) ?>


        <table class="table-responsive" width="100%" >
            <tr>
                <td width="50%">


                    <?php echo $form->dropDownListRow($model, 'TIPO', array('Natural' => 'Natural', 'Jurídica' => 'Jurídica'), array('class' => 'span10 span')) ?>
                    <?php echo $form->textFieldRow($model, 'CI', array('class' => 'span10', 'placeholder' => "CI:0603744123 o RUC:0603744123001, SIN GUIÓN", 'maxlength' => 13)) ?>
                    <!-- <div class="span10"> 
                    <?php
                    //    echo '  CI.    <br>';
                    //    $this->widget('CMaskedTextField', array(
                    //        'model' => $model,
                    //        'attribute' => 'CI',
                    //        'name' => 'CI',
                    //        'mask' => '9999999999',
                    //        'htmlOptions' => array('style' => 'width:80px;'),));
                    ?>
                   </div> -->
                    <?php echo $form->textFieldRow($model, 'APELLIDO', array('class' => 'span10', 'placeholder' => "Apellidos y Nombres Ejm. TIERRA PAGUAY ARACELLY ESTEFANYA", 'maxlength' => 50)) ?>


                    <?php echo $form->dropDownListRow($model, 'ESTADO_CIVIL', array('Casado/a' => 'Casado/a', 'Soltero/a' => 'Soltero/a', 'Viudo/a' => 'Viudo/a', 'Divorciado/a' => 'Divorciado/a', 'Union Libre' => 'Union Libre'), array('class' => 'span10', 'maxlength' => 10)) ?>
                    <?php echo $form->textFieldRow($model, 'NOMBRE_CONYUGE', array('placeholder' => " Apellidos y Nombres Ejm. TIERRA PAGUAY ALAN EMILIANO", 'class' => 'span10', 'maxlength' => 50)) ?>
                    <?php //MAYUSCULAS echo $form->textFieldRow($model, 'NOMBRE_CONYUGE', array('class' => 'span10', 'maxlength' => 50,'style'=>'text-transform:uppercase;')) ?>
                    <br>
                    <?php // echo $form->textFieldRow($model, 'FOTO', array('class' => 'span10', 'maxlength' => 100)) ?>
                    <!-- Código para subir foto -->
                    <?php if ($model->isNewRecord != '1') { ?>

                        <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/fotosSocios/' . $model->FOTO, "...", array("width" => 100)); ?>  

                    <?php } ?>
                    <div class="column">
                        <?php echo $form->labelEx($model, 'FOTO'); ?>
                        <?php echo CHtml::activeFileField($model, 'FOTO'); //con esto levantamos la imagen  ?>  
                        <?php echo $form->error($model, 'FOTO'); ?>
                    </div>

                    <!-- Termina código para subir foto -->
                </td>    
                <td  width="50%">
                    <?php
                    echo $form->labelEx($model, 'FECHA_NACIMIENTO');
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'FECHA_NACIMIENTO',
                        'model' => $model,
                        'attribute' => 'FECHA_NACIMIENTO',
                        'language' => 'es',
                        'htmlOptions' => array('class' => 'span5'), //'htmlOptions' => array('readonly' => "readonly", 'class' => 'span10'),
                        'options' => array(
                            'autoSize' => true,
                            'dateFormat' => 'yy-mm-dd',
                            'buttonImage' => Yii::app()->baseUrl . '/images/pagina/calendar1.png',
                            'buttonImageOnly' => true,
                            'buttonText' => 'SELECCIONAR FECHA DE NACIMIENTO',
                            'selectOtherMonths' => true,
                            'showAnim' => 'slide',
                            'showButtonPanel' => true,
                            'showOn' => 'button',
                            'showOtherMonths' => true,
                            'changeMonth' => 'true',
                            'changeYear' => 'true',
                        ),
                            )
                    );
                    ?>    
                    <?php echo $form->dropDownListRow($model, 'GENERO', array('M' => 'Masculino', 'F' => 'Femenino'), array('class' => 'span10', 'maxlength' => 1)) ?>
                    <?php echo $form->textFieldRow($model, 'DIRECCION', array('class' => 'span10', 'maxlength' => 100)) ?>
                    <?php echo $form->textFieldRow($model, 'TELEFONO', array('class' => 'span10', 'maxlength' => 20)) ?>
                    <?php echo $form->textFieldRow($model, 'CELULAR', array('class' => 'span10', 'maxlength' => 15)) ?>    
                    <?php echo $form->textFieldRow($model, 'EMAIL', array('class' => 'span10', 'maxlength' => 50)) ?>   

                    <?php // echo $form->textFieldRow($model, 'COD_USUARIO', array('class' => 'span10')) ?>
                    <?php // echo $form->textFieldRow($model, 'FECHA_ACTUALIZACION', array('class' => 'span10'))   ?>
                </td>
            </tr>
        </table>
        <?php echo $form->textAreaRow($model, 'OBS', array('class' => 'span10', 'maxlength' => 1000)) ?>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading span5 span row">
            <div class="text-info text-center">
                SOCIO DE LA COMUNIDAD
            </div>
            <div class="text-justify badge-warning text-black fondoLogin">
                <p>Al estar como socio activo se tomara en cuenta en reuniones,
                    trabajos y otras actividades desarrolladas en beneficio de la comunidad,
                    caso contrario solo aportan un valor fijo por ser beneficiario de un servicio q ofrece la comunidad
                    <b>Ejm.</b> Aporta un valor básico por ser usuario del agua potable.
                </p>
            </div>    
            <?php echo $form->checkBoxRow($model, 'PARTICIPA_COMUNIDAD', array('class' => '', 'maxlength' => 10)) ?>
                        <div class="badge-info badge">
                            Usuario de:
                        </div>
            <?php echo $form->checkBoxRow($model, 'USU_AGUA_RIEGO', array('class' => '', 'maxlength' => 10)) ?>
            <?php echo $form->checkBoxRow($model, 'USU_AGUA_POTABLE', array('class' => '', 'maxlength' => 10)) ?>
            <?php echo $form->checkBoxRow($model, 'USU_ALCANTARILLADO', array('class' => '', 'maxlength' => 10)) ?>
        </div>
        <div class="badge badge-info fondoLogin">
            <?php echo $form->dropDownListRow($model, 'COD_GRUPO', CHtml::listData(Grupo::model()->findAll(), 'COD_GRUPO', Grupo::representingColumn())) ?>
            <?php
            echo $form->labelEx($model, 'FECHA_INGRESO');
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'FECHA_INGRESO',
                'model' => $model,
                'attribute' => 'FECHA_INGRESO',
                'language' => 'es',
                'htmlOptions' => array('class' => 'span6'), //'htmlOptions' => array('readonly' => "readonly", 'class' => 'span10'),
                'options' => array(
                    'autoSize' => true,
                    'dateFormat' => 'yy-mm-dd',
                    'buttonImage' => Yii::app()->baseUrl . '/images/pagina/calendar1.png',
                    'buttonImageOnly' => true,
                    'buttonText' => 'CAMBIAR FECHA DE INGRESO',
                    'selectOtherMonths' => true,
                    'showAnim' => 'slide',
                    'showButtonPanel' => true,
                    'showOn' => 'button',
                    'showOtherMonths' => true,
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                ),
                    )
            );
            ?>  
            <?php
         /*   echo $form->labelEx($model, 'FECHA_SALIDA');
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'FECHA_SALIDA',
                'model' => $model,
                'attribute' => 'FECHA_SALIDA',
                'language' => 'es',
                'htmlOptions' => array('class' => 'span6'), //'htmlOptions' => array('readonly' => "readonly", 'class' => 'span10'),
                'options' => array(
                    'autoSize' => true,
                    'dateFormat' => 'yy-mm-dd',
                    'buttonImage' => Yii::app()->baseUrl . '/images/pagina/calendar1.png',
                    'buttonImageOnly' => true,
                    'buttonText' => 'CAMBIAR FECHA DE POSIBLE SALIDA',
                    'selectOtherMonths' => true,
                    'showAnim' => 'slide',
                    'showButtonPanel' => true,
                    'showOn' => 'button',
                    'showOtherMonths' => true,
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                ),
                    )
            ); */
            ?>  
            <?php echo $form->textFieldRow($model, 'COD_BARRA', array('class' => 'span12', 'placeholder' => 'Carnet del agua de riego (nuevo)', 'maxlength' => 10)) ?>
            <?php echo $form->textFieldRow($model, 'COD_BARRA_RIEGO_OLD', array('class' => 'span12', 'placeholder' => 'Carnet del agua de riego (anterior)', 'maxlength' => 10)) ?>
            <?php echo $form->textFieldRow($model, 'COD_BARRA_POTABLE', array('class' => 'span12', 'placeholder' => 'Carnet del agua potable', 'maxlength' => 10)) ?>
        </div>
    </div>

    <div class="form-actions span12 row">
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