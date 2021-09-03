<?php
/** @var CuotaController $this */
/** @var Cuota $model */
$this->breadcrumbs=array(
	$model->label(2) => array('index'),
	Yii::t('AweCrud.app', 'Create'),
);

//$this->menu=array(
//    //array('label' => Yii::t('AweCrud.app', 'List').' '.Cuota::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//);
?>

<fieldset>
    <legend>
        <h4 class="btn-primary text-center">
            PAGO PARCIAL
        </h4>
    </legend>
     <div>
      <b> RUBRO:</b> <?php echo $model_detalle->iDRUBRO->DESCRIPCION; ?>
    </div>
    <div id="saldo">
       <b> SALDO:</b> <?php echo $model_detalle->V_TOTAL; ?>
    </div>
    <div>
       <b> ESTADO:</b> <?php
       if ($model_detalle->ESTADO == 0)
           echo "POR PAGAR";
       if ($model_detalle->ESTADO == 1)
           echo "PAGADO";
       if ($model_detalle->ESTADO == 2)
           echo "ANULADO";
        ?>
    </div>
    <?php 
    if ($model_detalle->V_TOTAL > 0 and $model_detalle->ESTADO != 1)
    {
        echo $this->renderPartial('_form_pago_parcial', array('model' => $model, 'model_detalle' => $model_detalle)); 
    }
    else
    {
        echo "<p class='badge-warning'> NO PUEDE REALIZAR PAGOS PARCIALES DE ESTE RUBRO</p>";
        $this->widget('bootstrap.widgets.TbButton', array(
			//'buttonType'=>'submit',
                        'type' => 'success',
                        'icon' => 'arrow-left',
			'label'=> Yii::t('AweCrud.app', 'VOLVER'),
			'htmlOptions' => array('onclick' => 'javascript:history.go(-1)')
		));
    }
    ?>
</fieldset>
