<div class="form">
    <?php
    /** @var RecuentoController $this */
    /** @var Recuento $model */
    /** @var AweActiveForm $form */
    $form = $this->beginWidget('ext.AweCrud.components.AweActiveForm', array(
    'id' => 'recuento-form',
    'enableAjaxValidation' => false,
    'enableClientValidation'=> true,
    )); ?>

    

    <?php echo $form->errorSummary($model) ?>

                <?php //echo $form->dropDownListRow($model, 'ID_CAJA', CHtml::listData(Caja::model()->findAll(), 'ID', Caja::representingColumn())) ?>
    <div>
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="col-md-12">
                    
            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/1.png' ?>" width="10%" >
            <?php echo $form->textField($model, 'UNO', array('class' => 'span5','style'=>'width:200px;height:25px')) ?>
            <span id="lbuncentavo" class="badge label label-success">0</span><br>

            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/5.png' ?>" width="15%" >
            <?php echo $form->textField($model, 'CINCO', array('class' => 'span5','style'=>'width:200px;height:25px')) ?>
            <span id="lbcincocentavos" class="badge label label-success">0</span><br>

            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/10.png' ?>" width="10%" >
            <?php echo $form->textField($model, 'DIEZ', array('class' => 'span5', 'style'=>'width:200px;height:25px')) ?>
            <span id="lbdiezcentavos" class="badge label label-success">0</span><br>
            
            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/25.png' ?>" width="17%" >
            <?php echo $form->textField($model, 'VIENTICINCO', array('class' => 'span5', 'style'=>'width:200px;height:25px')) ?>
            <span id="lbventicincocentavos" class="badge label label-success">0</span><br>
            
            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/50.png' ?>" width="20%" >
            <?php echo $form->textField($model, 'CINCUENTA', array('class' => 'span5', 'style'=>'width:200px;height:25px')) ?>
            <span id="lbcincuentacentavos" class="badge label label-success">0</span><br>

            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/1_d.png' ?>" width="25%" >
            <?php echo $form->textField($model, 'UNO_D', array('class' => 'span5', 'style'=>'width:200px;height:25px')) ?>
            <span id="lbundolar" class="badge label label-success">0</span><br>
            
            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/5_d.png' ?>" width="25%" >
            <?php echo $form->textField($model, 'CINCO_D', array('class' => 'span5', 'style'=>'width:200px;height:25px')) ?>
            <span id="lbcincodolares" class="badge label label-success">0</span><br>

            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/10_d.png' ?>" width="25%" >
            <?php echo $form->textField($model, 'DIEZ_D', array('class' => 'span5', 'style'=>'width:200px;height:25px')) ?>
            <span id="lbdiezdolares" class="badge label label-success">0</span><br>
            
            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/20_d.png' ?>" width="25%" >
            <?php echo $form->textField($model, 'VIENTE_D', array('class' => 'span5', 'style'=>'width:200px;height:25px')) ?>
            <span id="lbveintedolares" class="badge label label-success">0</span><br>
            
            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/50_d.png' ?>" width="25%" >
            <?php echo $form->textField($model, 'CINCUENTA_D', array('class' => 'span5', 'style'=>'width:200px;height:25px')) ?>
            <span id="lbcincuentadolares" class="badge label label-success">0</span><br>
            
            <img src="<?php echo Yii:: app()->baseUrl . '/images/moneda/100_d.png' ?>" width="25%" >
            <?php echo $form->textField($model, 'CIEN_D', array('class' => 'span5', 'style'=>'width:200px;height:25px')) ?>
            <span id="lbciendolares" class="badge label label-success">0</span><br>
            <br>
            <div>
                <span class="badge label label-celeste-claro">Total $.</span>
                <?php echo $form->hiddenField($model, 'TOTAL', array('class' => 'span5', 'style'=>'width:200px;height:25px')) ?>
            <span id="lbtotal" class="badge label label-success">Total</span>    
            </div>
            

                </div>
                    
            </div>
        
        </div>
    
    </div> 
    
    <script type="text/javascript">
    
    $(document).ready(function(){
    
    $('#Recuento_UNO').on('keyup',function(){
        var sum=0;
        //alert( parseFloat($('#Recuento_UNO').val()/100));
        var uncentavos=parseFloat($('#Recuento_UNO').val()/100);
        $('#lbuncentavo').html(uncentavos);
        sum=parseFloat($('#lbcincocentavos').html())+parseFloat($('#lbdiezcentavos').html())+parseFloat($('#lbventicincocentavos').html())+parseFloat($('#lbcincuentacentavos').html())+parseFloat($('#lbundolar').html())+parseFloat($('#lbcincodolares').html())+parseFloat($('#lbdiezdolares').html())+parseFloat($('#lbveintedolares').html())+parseFloat($('#lbcincuentadolares').html())+parseFloat($('#lbciendolares').html())+parseFloat(uncentavos);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        //$('#lbuncentavo').val('que pasa');
        });
    $('#Recuento_CINCO').on('keyup',function(){
        var sum=0;
        //alert( parseFloat($('#Recuento_UNO').val()/100));
        var cincocentavos=parseFloat($('#Recuento_CINCO').val()/20);
        $('#lbcincocentavos').html(cincocentavos);
        sum=parseFloat($('#lbuncentavo').html())+parseFloat($('#lbdiezcentavos').html())+parseFloat($('#lbventicincocentavos').html())+parseFloat($('#lbcincuentacentavos').html())+parseFloat($('#lbundolar').html())+parseFloat($('#lbcincodolares').html())+parseFloat($('#lbdiezdolares').html())+parseFloat($('#lbveintedolares').html())+parseFloat($('#lbcincuentadolares').html())+parseFloat($('#lbciendolares').html())+parseFloat(cincocentavos);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        });
    $('#Recuento_DIEZ').on('keyup',function(){
        var sum=0;
        var diezcentavos=parseFloat($('#Recuento_DIEZ').val()/10);
        $('#lbdiezcentavos').html(diezcentavos);
        sum=parseFloat($('#lbuncentavo').html())+parseFloat($('#lbcincocentavos').html()) +parseFloat($('#lbventicincocentavos').html())+ parseFloat($('#lbcincuentacentavos').html())+parseFloat($('#lbundolar').html())+parseFloat($('#lbcincodolares').html())+parseFloat($('#lbdiezdolares').html())+parseFloat($('#lbveintedolares').html())+parseFloat($('#lbcincuentadolares').html())+parseFloat(diezcentavos);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        });
    $('#Recuento_VIENTICINCO').on('keyup',function(){
        var sum=0;
        var venticincocentavos=parseFloat($('#Recuento_VIENTICINCO').val()/4);
        $('#lbventicincocentavos').html(venticincocentavos);
        sum=parseFloat($('#lbuncentavo').html())+parseFloat($('#lbcincocentavos').html()) +parseFloat($('#lbdiezcentavos').html())+ parseFloat($('#lbcincuentacentavos').html())+parseFloat($('#lbundolar').html())+parseFloat($('#lbcincodolares').html())+parseFloat($('#lbdiezdolares').html())+parseFloat($('#lbveintedolares').html())+parseFloat($('#lbcincuentadolares').html())+parseFloat($('#lbciendolares').html())+parseFloat(venticincocentavos);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        });
    $('#Recuento_CINCUENTA').on('keyup',function(){
        var sum=0;
        var cincuentacentavos=parseFloat($('#Recuento_CINCUENTA').val()/2);
        $('#lbcincuentacentavos').html(cincuentacentavos);
        sum=parseFloat($('#lbuncentavo').html())+parseFloat($('#lbcincocentavos').html()) +parseFloat($('#lbdiezcentavos').html())+ parseFloat($('#lbventicincocentavos').html())+parseFloat($('#lbundolar').html())+parseFloat($('#lbcincodolares').html())+parseFloat($('#lbdiezdolares').html())+parseFloat($('#lbveintedolares').html())+parseFloat($('#lbcincuentadolares').html())+parseFloat($('#lbciendolares').html())+parseFloat(cincuentacentavos);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        });
    $('#Recuento_UNO_D').on('keyup',function(){
        var sum=0;
        var undolar=parseFloat($('#Recuento_UNO_D').val()*1);
        $('#lbundolar').html(undolar);
        sum=parseFloat($('#lbuncentavo').html())+parseFloat($('#lbcincocentavos').html()) +parseFloat($('#lbdiezcentavos').html())+ parseFloat($('#lbventicincocentavos').html())+parseFloat($('#lbcincuentacentavos').html())+parseFloat($('#lbcincodolares').html())+parseFloat($('#lbdiezdolares').html())+parseFloat($('#lbveintedolares').html())+parseFloat($('#lbcincuentadolares').html())+parseFloat($('#lbciendolares').html())+parseFloat(undolar);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        });
    $('#Recuento_CINCO_D').on('keyup',function(){
        var sum=0;
        var cincodolares=parseFloat($('#Recuento_CINCO_D').val()*5);
        $('#lbcincodolares').html(cincodolares);
        sum=parseFloat($('#lbuncentavo').html())+parseFloat($('#lbcincocentavos').html()) +parseFloat($('#lbdiezcentavos').html())+ parseFloat($('#lbventicincocentavos').html())+parseFloat($('#lbcincuentacentavos').html())+parseFloat($('#lbundolar').html())+parseFloat($('#lbdiezdolares').html())+parseFloat($('#lbveintedolares').html())+parseFloat($('#lbcincuentadolares').html())+parseFloat($('#lbciendolares').html())+parseFloat(cincodolares);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        });
    $('#Recuento_DIEZ_D').on('keyup',function(){
        var sum=0;
        var diezdolares=parseFloat($('#Recuento_DIEZ_D').val()*10);
        $('#lbdiezdolares').html(diezdolares);
        sum=parseFloat($('#lbuncentavo').html())+parseFloat($('#lbcincocentavos').html()) +parseFloat($('#lbdiezcentavos').html())+ parseFloat($('#lbventicincocentavos').html())+parseFloat($('#lbcincuentacentavos').html())+parseFloat($('#lbundolar').html())+parseFloat($('#lbcincodolares').html())+parseFloat($('#lbveintedolares').html())+parseFloat($('#lbcincuentadolares').html())+parseFloat($('#lbciendolares').html())+parseFloat(diezdolares);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        });
    $('#Recuento_VIENTE_D').on('keyup',function(){
        var sum=0;
        var veintedolares=parseFloat($('#Recuento_VIENTE_D').val()*20);
        $('#lbveintedolares').html(veintedolares);
        sum=parseFloat($('#lbuncentavo').html())+parseFloat($('#lbcincocentavos').html()) +parseFloat($('#lbdiezcentavos').html())+ parseFloat($('#lbventicincocentavos').html())+parseFloat($('#lbcincuentacentavos').html())+parseFloat($('#lbundolar').html())+parseFloat($('#lbcincodolares').html())+parseFloat($('#lbdiezdolares').html())+parseFloat($('#lbcincuentadolares').html())+parseFloat($('#lbciendolares').html())+parseFloat(veintedolares);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        });
    $('#Recuento_CINCUENTA_D').on('keyup',function(){
        var sum=0;
        var cincuentadolares=parseFloat($('#Recuento_CINCUENTA_D').val()*50);
        $('#lbcincuentadolares').html(cincuentadolares);
        sum=parseFloat($('#lbuncentavo').html())+parseFloat($('#lbcincocentavos').html()) +parseFloat($('#lbdiezcentavos').html())+ parseFloat($('#lbventicincocentavos').html())+parseFloat($('#lbcincuentacentavos').html())+parseFloat($('#lbundolar').html())+parseFloat($('#lbcincodolares').html())+parseFloat($('#lbdiezdolares').html())+parseFloat($('#lbveintedolares').html())+parseFloat($('#lbciendolares').html())+parseFloat(cincuentadolares);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        });
    $('#Recuento_CIEN_D').on('keyup',function(){
        var sum=0;
        var ciendolares=parseFloat($('#Recuento_CIEN_D').val()*100);
        $('#lbciendolares').html(ciendolares);
        sum=parseFloat($('#lbuncentavo').html())+parseFloat($('#lbcincocentavos').html()) +parseFloat($('#lbdiezcentavos').html())+ parseFloat($('#lbventicincocentavos').html())+parseFloat($('#lbcincuentacentavos').html())+parseFloat($('#lbundolar').html())+parseFloat($('#lbcincodolares').html())+parseFloat($('#lbdiezdolares').html())+parseFloat($('#lbveintedolares').html())+parseFloat($('#lbcincuentadolares').html())+parseFloat(ciendolares);
        $('#lbtotal').html(0);
        $('#lbtotal').html(sum.toFixed(2));
        $('#Recuento_TOTAL').val(sum.toFixed(2));
        });
    });
    </script> 
                   
                <div class="form-actions">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? Yii::t('AweCrud.app', 'Save') : Yii::t('AweCrud.app', 'Save'),
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            //'buttonType'=>'submit',
            'label'=> Yii::t('AweCrud.app', 'Cancel'),
            'htmlOptions' => array('onclick' => 'javascript:history.go(0)')
        )); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>