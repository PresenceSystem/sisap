

<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Autenticar',
);
if (ISSET(Yii::app()->user->id) AND Yii::app()->user->id > 0) {
    $this->redirect(Yii::app()->user->returnUrl);
} 
else  
{
    // $this->redirect(array('login'));
	
}
?>

<div class="col-md-12">
    <div class="btn-success">
         <center>
           <h3>JUNTA ADMINISTRADORA DE AGUA POTABLE Y SANEAMIENTO <br>  "SAN VICENTE DE LACAS"</h3>
        </center>
    </div>   
 </div>
 <div class="col-md-12 col-md-offset-3"> 
<div class="panel panel-info fondoLogin col-md-3">
    <!-- Default panel contents -->
    <div class="panel-heading"><center>Ingrese sus datos para acceder al sistema</center></div>
    <div class="panel-body">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            'focus' => array($model, 'username'),
            'focus' => 'input:text[value=""]:first',
            ),
        ));
        ?>
        <div class="">
            <div class="row-fluid  text-right">
                <?php
                echo '<b> </b>' . $form->textField($model, 'username', array('class' => 'span12', 'placeholder' => "Usuario.", 'value' => '', 'maxlength' => 100)
                );
                ?>
                <br>
<?php // echo $form->error($model, 'username');  ?>
            </div>
        </div>
        <div class="">
            <div class="row-fluid text-right">
                <?php //echo $form->labelEx($model, 'Clave'); ?>
<?php echo '<b>    </b>' . $form->passwordField($model, 'password', array('class' => 'span12', 'placeholder' => "Clave de seguridad", 'value' => '', 'maxlength' => 100)); ?>
                <br>

                <p class="hint">
                    <!-- Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.-->
                </p>
            </div>
        </div>
        <div class="text-center">
             <div class="alert-danger">  <?php echo $form->error($model, 'password'); ?> </div>
        </div>
        <!--        <div class="col-md-2 col-md-offset-5">
                    <div class="row row-fluid span12">
        <?php // echo $form->checkBox($model, 'rememberMe').$form->label($model, 'rememberMe'); ?>
<?php // echo $form->error($model, 'rememberMe');  ?>
                    </div>
                </div>-->
        <div class="col-md-5 col-md-offset-4">
            <div class="row buttons">
<?php echo CHtml::submitButton('Autenticar', array("class" => "btn btn-lg btn-primary btn-block")); ?>
            </div>
        </div>
<?php $this->endWidget(); ?>
    </div>
</div>





 <div class="col-md-2">
    <!--     <marquee direction="down" width="100%" height="25%" behavior="alternate" style="background: #ababab">
            <marquee behavior="alternate">
            </marquee>
        </marquee> -->
       <img src="<?php echo Yii:: app()->baseUrl . '/images/pagina/login.png' ?>" width="100%">
</div>



</div>















<!--<h1>Autenticar</h1>-->

<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading text-center" style="font-size:50px; color: black">             
            <b><i>Servicios en linea JAAPS</i></b> <img src="<?= Yii::app()->homeUrl; ?>/../images/iconos/ingresar.png" alt="Ingresar" height="8%" width="8%"> 
        </div>
        <div class="panel-body">                
            <div class="jumbotron col-md-3">
                <a href="<?= Yii::app()->homeUrl; ?>/site/buscar_deuda">
                    <button type="button" class="btn btn-primary"> 
                        <img src="<?= Yii::app()->homeUrl ?>/../images/iconos/deuda_1.png" alt="Buscar deuda" height="10px"/> 
                        <center><b>Buscar valores en deuda <br>por CI</b> </center>
                    </button>
                </a>
            </div>
            <div class="jumbotron col-md-3">
                <a href="<?= Yii::app()->homeUrl; ?>/site/simulador_tanques">
                    <button type="button" class="btn btn-primary"> 
                        <img src="<?= Yii::app()->homeUrl ?>/../images/iconos/tanques_1.png" alt="Simulador tanques" height="10px"/> 
                        <center><b>Simulador de tanques de <br>reserva</b> </center>
                    </button>
                </a>
            </div>
            <div class="jumbotron col-md-3">
                 <a href="<?= Yii::app()->homeUrl; ?>/site/simulador_calculos">
                    <button type="button" class="btn btn-primary"> 
                        <img src="<?= Yii::app()->homeUrl ?>/../images/iconos/simulador_1.png" alt="Simulador tanques" height="10px"/> 
                        <center><b>Simulador de consumo <br>(m³)</b> </center>
                    </button>
                </a>
            </div>
            <div class="jumbotron col-md-3">
                 <a href="<?= Yii::app()->homeUrl; ?>/site/buscar_historial_facturas">
                    <button type="button" class="btn btn-primary"> 
                        <img src="<?= Yii::app()->homeUrl ?>/../images/iconos/historial_1.png" alt="Simulador tanques" height="10px"/> 
                        <center><b>Historial de facturas por <br> socio</b> </center>
                    </button>
                </a>
            </div>
        </div>        
    </div>
</div>
     

















