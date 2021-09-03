<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$this->breadcrumbs = array(
    'Autenticado',
);
if (Yii::app()->user->id > 0) {
    $this->redirect(array('indexAutenticado'));
	//$this->redirect(Yii::app()->user->returnUrl);
} 
else  
{
     $this->redirect(array('login'));
//	 $this->redirect(array('servicios'));
}
?>


<!--<h2>Bienvenido al sistema de administración: <br> <i><?php //echo CHtml::encode(Yii::app()->name);        ?></i></h2>-->
<center> 
    <br><h2 class="badge-inverse text-info">  SISTEMA DE AGUA POTABLE 
            <BR>COMUNIDAD: "SAN VICENTE DE LACAS"</h2>
    <h4>    
        <font class="text-warning"> 
            <marquee> 
            Bienvenid@ 
            <?php echo Yii::app()->getSession()->get('nombre_usuario_sismedic'); ?> 
            , es su responsabilidad el uso de este sistema,
            y la privacidad de su usuario y contraseña </marquee> </font></h4>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Panel title</h3>
        </div>
        <div class="panel-body"> Panel content </div>
    </div>
    <div class="container theme-showcase" role="main">
<div class="jumbotron">
<h1>Theme example</h1>
<p>This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point to create something more unique by building on or modifying it.</p>
</div>
    

    

    <!--Se visualiza-->
    <!--<audio controls autoplay>--> 
   

    
    
</center>

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
                    'image' => '/images/pagina/carousel/1.JPG',
                    'label' => 'JURECH',
                    'caption' => 'Las autoridades a cargo de la administración de la JURECH'
                ),
                array(
                    'image' => '/images/pagina/carousel/2.jpg',
                    'label' => 'JURECH',
                    'caption' => 'Transparencia para todos'
                ),
                array(
                    'image' => '/images/pagina/carousel/3.jpg',
                    'label' => 'JURECH',
                    'caption' => 'Nuestro compromiso como representantes '
                ),
                array(
                    'image' => '/images/pagina/carousel/4.jpg',
                    'label' => 'JURECH',
                    'caption' => 'Los mejores productos'
                ),
                array(
                    'image' => '/images/pagina/carousel/5.jpg',
                    'label' => 'JURECH',
                    'caption' => 'Saludables y nutritivos'
                ),
            ),
                )
        );
        ?>

    </div>