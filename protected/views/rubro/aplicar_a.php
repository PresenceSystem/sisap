<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
$this->menu=array(
//	array('label' => Yii::t('AweCrud.app', 'List') . ' ' . NuevoDetalle::label(2), 'icon' => 'list', 'url' => array('index')),
	//array('label' =>  'APLICAR A TODOS ' , 'icon' => 'icon-ok', 'url' => array('nuevoRubro/aplicar_a_todos_local', 'id' => $model->ID)),
        array('label' =>  'QUITAR A TODOS ' , 'icon' => 'icon-ok', 'url' => array('nuevoRubro/quitar_a_todos_local', 'id' => $model->ID)),
       // array('label' =>  'APLICAR A LOS SIGUIENTES ', 'icon' => 'plus', 'url' => array('nuevoRubro/aplicar_a_lista_local', 'id' => $model->ID)),
       // array('label' =>  'NO APLICAR A LOS SIGUIENTES ', 'icon' => 'plus', 'url' => array('nuevoRubro/no_aplicar_a_lista_local', 'id' => $model->ID)),
);
?>

   <?php echo '<h2><center class="text-warning">'.$model->DESCRIPCION.'</center></h2>'; ?>    
<h3 class="text-warning"> El rubro se aplica a los siguientes de la lista </h3>
            <!--MENSAJE FLASH--> 
            <div class="panel-title alert-error">
                    <?php if (Yii::app()->user->hasFlash('error')): ?>
                        <div class="info">
                            <?php echo Yii::app()->user->getFlash('error'); ?>
                        </div>
                    <?php endif; ?>
            </div>
            
            <?php echo CHtml::link('Aplicar a...', '', array('onclick' => '$("#mymodal").dialog("open");return false;')); ?>
            <!--FIN DE MENSAJE FLASH--> 
    <table class="table table-condensed table-hover table-responsive table-bordered">
        <thead>
        <th>N°</th>
        <th>ID DETALLE</th>
        <th>APELLIDOS Y NOMBRES</th>
        <!--<th>CANTIDAD DE TERRENOS</th>-->
        <!--<th>CANTIDAD TOTAL</th>-->
        <th>VALOR A PAGAR</th>
		<th>ESTADO</th>
        
        </thead>
        <tbody>
            <?php 
            $contador=1;
            $suma_terrenos=0;
            $suma_area=0;
            $suma_valor=0;
            
            foreach ($model_detalles as $detalle)
            { 
			if ($detalle->ESTADO == 1)
			 { echo '<tr>'; $estado='PAGADO'; }
			else
			{ echo '<tr bgcolor="#f9e9b0">'; $estado='EN DEUDA';  }
                echo "<td> ".$contador.' </td>  ';
//                echo "<td> ".$detalle->ID.' </td>  ';
			if ($detalle->ESTADO == 0)
			{  echo "<td> ".CHtml::link($detalle->ID, array('detalle/update/',
			'id' => $detalle->ID))."</td>"; }
				else
				{ echo "<td> ".CHtml::encode($detalle->ID, array('detalle/update/',
                    'id' => $detalle->ID))."</td>";
				}
					
                echo "<td> ".$detalle->iDFACTURA->iDMEDIDORSOCIO->cODIGOSOCIO->APELLIDO.' </td>  ';
                
//                echo "<td> ".$detalle->ID.' </td>  '; //Cantidad de terrenos
//                echo "<td> ".$detalle->CANTIDAD.' </td>  '; //AREA
                echo "<td> ".$detalle->V_TOTAL.' </td>  ';
				echo "<td> ".$estado.' </td>  '; ; 
               
                $suma_terrenos = $suma_terrenos + $detalle->ID;
                $suma_area = $suma_area + $detalle->CANTIDAD;
                $suma_valor=$suma_valor + $detalle->V_TOTAL;
                $contador = $contador+1;
              echo '</tr>';
            }
            ?>
            <tr>
                <td colspan="3">TOTAL</td>
                <!--<td><?php // echo $suma_terrenos.'' ?></td>-->
                <!--<td><?php // echo $suma_area.'' ?></td>-->
                <td><?php echo $suma_valor.'' ?></td>
            </tr>
        </tbody>
    </table>


<!--Aumentado para ingresar lista -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mymodal',
    'options' => array(
        'title' => 'Registrar ',
        'width' => 500,
        'height' => 400,
        'autoOpen' => true,
        'resizable' => 'true',
        'modal' => 'true',
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.3'
        ),
    ),
));

echo $this->renderPartial('/detalle/_form_flotante', array(
    'model' => $model_asignar_detalle
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php echo CHtml::link('Aplicar a...', '', array('onclick' => '$("#mymodal").dialog("open");return false;')); ?>
<!-- Fin de aumentado para ingreso flotante-->

<br><br><br>
<a href="<?php echo Yii:: app()->baseUrl . '/index.php/rubro/'.$model->ID; ?>" class="btn btn-success span" >                   
    TERMINAR
 </a>