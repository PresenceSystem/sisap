

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
     
     
  