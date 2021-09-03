<?php
/* @var $this TconvocadoController */
/* @var $data Tconvocado */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_CONVOCADO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COD_CONVOCADO), array('view', 'id'=>$data->COD_CONVOCADO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_CONVOCATORIA')); ?>:</b>
	<?php echo CHtml::encode($data->COD_CONVOCATORIA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COD_SOCIO')); ?>:</b>
	<?php echo CHtml::encode($data->COD_SOCIO); ?>
	<br />


</div>