<?php
/** @var TconvocatoriaController $this */
/** @var Tconvocatoria $model */
$this->breadcrumbs=array(
	'Tconvocatorias'=>array('index'),
	$model->COD_CONVOCATORIA,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Tconvocatoria::label(2), 'icon' => 'list', 'url' => array('index')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('actualizar_x_valvula', 'id' => $model->COD_CONVOCATORIA)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->COD_CONVOCATORIA), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
      array('label' => Yii::t('AweCrud.app', 'Ver lista completa'), 'icon' => 'list-alt', 'url' => array('listaconvocados_x_valvula', 'id' => $model->COD_CONVOCATORIA)),
     
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'View') . ' ' . Tconvocatoria::label(); ?> <?php echo CHtml::encode($model) ?></legend>

    <table class="table table-bordered">
                <tr>
                    <td>
                        <?php
                        $bandera = 0;
                        $contador = 0;
                      
                           $contador++;
                            echo '<center><b>'. $model->ENCABEZADO. '</b></center>';
                            echo '<center><b>' . $model->TITULO . " N°  ".$contador. '</b></center>';
                           
                                
                               echo "<b>Sr.----------------- </b>"; 
                            echo '<div style="text-align:justify;">';
                            echo 'Citase con carácter obligatorio <b>' . $model->TIPO . '</b>';
                           echo '<br>Que se realizará el día: ';
                             
                             $Fecha= $model->FECHA;
                           setlocale(LC_TIME,"spanish");  
                    //$hoy=strftime("%A, %d de %B de %Y"); 
                    $hoy=strftime("%A, %d de %B de %Y",strtotime($Fecha));  
                echo '<b>'.$hoy.'</b>'; 
    
                            echo ', a las <b>' . date("G:i", strtotime($model->HORA)) . '</b>';
                            echo '' . $model->CUERPO . '</div>';
                            echo '<br><div style="text-align:justify;"><b>NOTA:</b> ' . $model->NOTA . '</div>';
                            echo '<br><br><center><b>ATENTAMENTE</b></center>';
                            echo '<center>' . $model->FIRMA .'</center>';
                            
                         
                                echo "</td><td>";
                          ?>
                        </td>                        
                </tr>
            </table>
    
<?php 

//$this->widget('bootstrap.widgets.TbDetailView',array(
//	'data' => $model,
//	'attributes' => array(
//        'COD_CONVOCATORIA',
//       // 'COD_JUNTA',
//               array(
//                'name' => 'COD_JUNTA',
//                'value' => ($model->cODJUNTA !== null) ? CHtml::link($model->cODJUNTA, array('/junta/view', 'id' => $model->cODJUNTA->COD_JUNTA)) . ' ' : null,
//                'type' => 'html',
//            ),
//        'ENCABEZADO',
//        'TITULO',
//        'TIPO',
//        'FECHA',
//        array(
//                'name'=>'HORA',
//                'type'=>'time'
//            ),
//        'CUERPO',
//        'NOTA',
//        'FIRMA',
//        'ESTADO',
//	),
//)); 
?>
</fieldset>
<?php
// LISTA DE CONVOCADOS
/*$convocatoria=Yii::app()->getSession()->get('ConvocatoriaSeleccionada'); if($convocatoria>0 and $convocatoria==$model->COD_CONVOCATORIA) {echo "<h2 class=badget-info>LISTA DE SOCIOS CONVOCADOS</h2>"; $connection = Yii::app()->db; $sql = "SELECT * FROM tconvocado WHERE COD_CONVOCATORIA=".$convocatoria; $command = $connection->createCommand($sql); $rows = $command->execute(); $rows = $command->queryAll(); $contador=1; foreach ($rows as $row) {$socio=$row['COD_SOCIO']; $modelo=  Socio::model()->findByPk($socio); echo $contador++ .".- ". $modelo->APELLIDO.'<br>'; } } */
?>