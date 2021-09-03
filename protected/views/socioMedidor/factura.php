<?php 
header('Cache-Control: no-store, no-cache, must-revalidate');     // HTTP/1.1

?>
<?php /*
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ 
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('app', $model->ID) => array('view', 'id'=>$model->ID),
	Yii::t('AweCrud.app', 'facturar'),
);
//echo date('H:i:s');
?>

<fieldset>
                <h3 class=""><center>FACTURACIÓN DE AGUA POTABLE</center></h3>
<?php echo $this->renderPartial('_form_factura', array('model' => $model)); ?>
<?php echo $this->renderPartial('_calculadora', array('model' => $model)); ?>
    <?php if (Yii::app()->user->hasFlash('success')): ?>
                        <div class="info panel-title alert-success info" id="flashmensaje">
                            <h3>¡Bien echo!</h3>
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div>
                    <?php endif; ?>
    <?php 
    Yii::app()->clientScript->registerScript(
            'flashmensaje',
            '$(".info").animate({opacity: 1.0}, 9000).fadeOut("slow");',
            CClientScript::POS_READY            
            )
    
    ?>

</fieldset>
<center>

        <div class="row">
				<a href="<?php echo Yii:: app()->baseUrl . '/index.php/factura/buscar_factura/'?>" class="" title="<h5> Facturas emitidas el <?php echo date('d M Y') ?></h5>" >  
                                <img src="<?php echo Yii:: app()->baseUrl . '/images/iconos/buscar.png' ?>" width="30px"></img>                                
								
                                </a>
		</div>

</center>		