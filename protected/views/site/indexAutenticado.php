<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$this->breadcrumbs = array(
    'Autenticado',
);
if (ISSET(Yii::app()->user->id) AND Yii::app()->user->id > 0 AND Yii::app()->getSession()->get('id_referencia') > 0) {
    $this->redirect(Yii::app()->user->returnUrl . '/socio/deudas');
}
?>

<div class="btn-success">
    <marquee>
        <h4>  Bienvenido <strong> <i><?php echo Yii::app()->getSession()->get('nombre_usuario'); ?> </i> </strong> al sistema web de administración desarrollado en el año 2016 para la comunidad "San Vicente de Lacas" </h4>
    </marquee>

</div>


<div class=" col-md-12" role="main">
    <h3 class="text-center">Sistema de Agua Potable <br> "COMUNIDAD SAN VICENTE DE LACAS"</h3>
    <div class="jumbotron col-md-5">
        <img src="<?php echo Yii:: app()->baseUrl . '/images/fuente.gif' ?>" width="100%">

    </div>

    <div class="jumbotron col-md-7">
        <p align="justify">
            <strong>"Una gota de agua vale mucho más que el oro"</strong>
            <BR/>Tratemos de no malgastar el agua, ya que este es un recurso limitado y sino lo cuidamos como corresponde, corremos el riesgo que en el futuro no haya suficiente agua para beber.  
        </p>

        <p align="justify">
            La Asamblea General de las Naciones Unidas declaró al <b>22 de marzo como Día Mundial del Agua</b> para concientizar a las poblaciones sobre el cuidado de este importante recurso.
            Los desafíos relacionados con el agua aumentarán significativamente en los próximos años. El continuo crecimiento de la población y el incremento de los ingresos conllevarán un enorme aumento del consumo de agua y de la generación de residuos. La población de las ciudades de los países en desarrollo crecerá de forma alarmante, lo que generará un aumento de la demanda muy por encima de las capacidades de los servicios y de la infraestructura de abastecimiento y saneamiento de agua, ya hoy en día insuficientes. 
            <br>Según el Informe de las Naciones Unidas sobre el desarrollo de los recursos hídricos en el mundo, en el 2050, al menos una de cada cuatro personas vivirá en un país con escasez crónica o recurrente de agua. 
        </p>
    </div>
</div>


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