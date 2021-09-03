<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Ingresar '.Yii::app()->name . ' - V1';
//$this->breadcrumbs = array(
//    'Autenticar',
//);
?>
<!--<h2 class='title'>Contador de Visitas</h2>
<div class='widget-content'>
<object allowscriptaccess="always" type="application/x-shockwave-flash" 
        data="http://img.firefoxplugin.info/flashbanner.swf?id=339884&ln=es" 
        width="120" height="160" wmode="transparent"><param name="allowscriptaccess" value="always" 
        /><param name="movie" value="http://img.firefoxplugin.info/flashbanner.swf?id=339884&ln=es" /><param name="wmode" value="transparent" /><embed 
        src="http://img.firefoxplugin.info/flashbanner.swf?id=339884&ln=es" 
        type="application/x-shockwave-flash" allowscriptaccess="always" 
        wmode="transparent" width="120" height="160" />
    <video width="120" height="160">
        <a href="http://www.123-counters.com/" style="font-style:italic;font-weight:normal;font-size:140%" title="Visitor Counter">
            Visitor Counter</a></video></embed></object>
</div>-->

<div class="fondoAdmin">
    <center>
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/pagina/login.png" width="10%"> <p class="text-warning text-left">Bienvenido(a)</p>    
       </center> 
   
    <div class="text-center" >Sitio seguro y exclusivo para Administradores o personal autorizado por la:<br><b> "COMUNIDAD SAN VICENTE DE LACAS"</b> 
     <h3 class="alert-info"><marquee>Ingresa tu nombre de usuario y contraseña</marquee></h3> 
<!--    <table class="table-condensed center">
        <tr>
            <td><img src="<?php // echo Yii::app()->baseUrl; ?>/images/pagina/estetoscopio.png" width="20%"></td>
            <td>-->
   <!--<div class=""> <br><img src="<?php //echo Yii::app()->baseUrl;   ?>/images/pagina/login.gif" width="250px"> <br><br></div>-->
                <!--Complete el siguiente formulario con sus datos de acceso:-->

                <!--<br>-->
                <?php
                $form = $this->beginWidget('CActiveForm', array( 
                    'id' => 'login-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                ));
                ?>

    <!--<p class="note">Los campos que lleven <span class="required">*</span> se requieren.</p>-->

                <div class="row-fluid text-center">
                    <?php //echo $form->labelEx($model, 'Usuario'); ?>
                    <?php //echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 50)) ?>
                    <?php echo '<b> </b>' . $form->textField($model, 'username', array('class' => 'span3    z', 'placeholder' => "Usuario.", 'value' => '', 'maxlength' => 100)); ?>
                    <br>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
                <br>
                <div class="row-fluid text-center">
                    <?php //echo $form->labelEx($model, 'Clave'); ?>
                    <?php echo '<b>    </b>' . $form->passwordField($model, 'password', array('class' => 'span3 ', 'placeholder' => "Clave de seguridad", 'value' => '', 'maxlength' => 100)); ?>
                    <br>
                    <?php echo $form->error($model, 'password'); ?> 
                    <p class="hint">
                        <!-- Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.-->
                    </p>
                </div>

                <div class="row-fluid text-center">
                    <?php echo $form->checkBox($model, 'rememberMe'); ?>
                    <?php echo $form->label($model, 'rememberMe'); ?>
                    <?php echo $form->error($model, 'rememberMe'); ?>
                </div>

                <div class="row buttons">
                    <?php echo CHtml::submitButton('INGRESAR', array("class" => "btn btn-primary")); ?>
                </div>

                <?php $this->endWidget(); ?>
<!--            </td>
        </tr>
    </table>-->

<div class="column span-10">

        <?php
        $this->widget(
                'bootstrap.widgets.TbCarousel', array(
            'items' => array(
                array(
                    'image' => '../images/pagina/carousel/1.png',
                    'label' => 'JURECH',
                    'caption' => 'La Junta General de Usuarios de Riego Chambo - Guano les da una cordial bienvenida a su sistema web de administración'
                ),
                array(
                    'image' => '../../images/pagina/carousel/1.JPG',
                    'label' => 'JURECH',
                    'caption' => 'Las autoridades a cargo de la administración de la JURECH'
                ),
                array(
                    'image' => '../../images/pagina/carousel/2.jpg',
                    'label' => 'JURECH',
                    'caption' => 'Transparencia para todos'
                ),
                array(
                    'image' => '../../images/pagina/carousel/3.jpg',
                    'label' => 'JURECH',
                    'caption' => 'Nuestro compromiso como representantes '
                ),
                array(
                    'image' => '../../images/pagina/carousel/4.jpg',
                    'label' => 'JURECH',
                    'caption' => 'Los mejores productos'
                ),
                array(
                    'image' => '../../images/pagina/carousel/5.jpg',
                    'label' => 'JURECH',
                    'caption' => 'Saludables y nutritivos'
                ),
            ),
                )
        );
        ?>

    </div>
    </div>
</div>


