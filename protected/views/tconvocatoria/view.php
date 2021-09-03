<?php
/** @var TconvocatoriaController $this */
/** @var Tconvocatoria $model */
$this->breadcrumbs=array(
	'Tconvocatorias'=>array('index'),
	$model->COD_CONVOCATORIA,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Tconvocatoria::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Tconvocatoria::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->COD_CONVOCATORIA)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->COD_CONVOCATORIA), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
      array('label' => Yii::t('AweCrud.app', 'Ver lista completa'), 'icon' => 'list-alt', 'url' => array('listaconvocatoria', 'id' => $model->COD_CONVOCATORIA)),
      array('label' => Yii::t('AweCrud.app', '__________________ Seleccionar convocatoria para llenar lsita de socios'), 'icon' => 'list', 'url' => array('listaConvocados', 'id' => $model->COD_CONVOCATORIA)),
    array('label' => Yii::t('AweCrud.app', 'Socio a convocar'), 'icon' => 'list-alt', 'url' => array('tconvocado/create')),
     array('label' => Yii::t('AweCrud.app', 'Exportar Convocados a Word'), 'icon' => 'pencil', 'url' => array('imprimirConvocados', 'id' => $model->COD_CONVOCATORIA)),
);
?>

<fieldset>
    <legend class="text-center btn-primary"><?php echo Yii::t('AweCrud.app', 'View') . ' ' . Tconvocatoria::label(); ?> <?php echo CHtml::encode($model) ?></legend>

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
                            
                         
                                echo "</td>";
                          ?>
                                              
                </tr>
            </table>
</fieldset>
<?php
// LISTA DE CONVOCADOS
$convocatoria=Yii::app()->getSession()->get('ConvocatoriaSeleccionada');
if($convocatoria>0 and $convocatoria==$model->COD_CONVOCATORIA)
{
    echo "<h2 class='btn-info text-center'>LISTA DE SOCIOS CONVOCADOS</h2>";
    
      $connection = Yii::app()->db;
                $sql = "SELECT * FROM tconvocado WHERE COD_CONVOCATORIA=".$convocatoria;
                $command = $connection->createCommand($sql);
                $rows = $command->execute();
                $rows = $command->queryAll();
$contador=1;
               
                    ?>
<table class="table table-bordered table-condensed table-hover table-responsive table-striped">
    <thead>
        <th>
        <center>N°</center>
        </th>
        <th>
        <center>APELLIDOS</center>
        </th>
        <th>
        <center>NOMBRES</center>
        </th>
        <th>
        <center>N° DE CÉDULA</center>
        </th>
</thead>
<tbody>
     <?php
                     foreach ($rows as $row) {
                    $socio=$row['COD_SOCIO'];
                    $modelo=  Socio::model()->findByPk($socio);
                    //echo $contador++ .".- ". $modelo->APELLIDO.'<br>';
                    
                    $array_nombres = explode(" ", $modelo->APELLIDO);
                    $cantidad_nombres = count($array_nombres);
                    $apellidos="";
                    $nombres="";
                    
                    if ($cantidad_nombres > 2) // Tiene 2 o mas nombres y 2 apellidos
                    {  // CREANDO APELLIDOS
                        for ($i = 0; $i<2; $i++)
                        {
                            if ($i==1){
                                $apellidos = $apellidos." ";
                            }
                        $apellidos = $apellidos.$array_nombres[$i];
                        }
                       // CREANDO NOMBRES 
                        for ($i = 2; $i<$cantidad_nombres; $i++)
                        {
                            if ($i>2){
                                $nombres = $nombres." ";
                            }
                        $nombres = $nombres.$array_nombres[$i];
                        }
                    } else 
                    {
                        $apellidos = $array_nombres[0]; 
                        $nombres = $array_nombres[1]; 
                    }
//                    $apellidos=$modelo->APELLIDO;
//                    $nombres=$modelo->APELLIDO;
                    $cedula = substr($modelo->CI,0,9).'-'.substr($modelo->CI,9,10);
                    echo "<tr>";
                    echo "<td>";
                    echo $contador++;
                    echo "</td>";
                    echo "<td>";
                    echo $apellidos;
                    echo "</td>";
                    echo "<td>";
                    echo $nombres;
                    echo "</td>";
                    echo "<td>";
                    echo $cedula;
                    echo "</td>";
//                     echo "<td>";
//                    echo $modelo->APELLIDO;
//                    echo "</td>";
//                     echo "<td>";
//                    echo $modelo->CI;
//                    echo "</td>";
                    echo "</tr>";
                    }
                    ?>
</tbody>
</table>
                   
<a href="<?= Yii::app()->homeUrl; ?>/tconvocado/create">
                    <button type="button" class="btn btn-primary"> 
                        <!--<img src="<?PHP // Yii::app()->homeUrl ?>/../images/iconos/deuda_1.png" alt="Buscar deuda" height="10px"/>--> 
                        <center>CONVOCAR A </center>
                    </button>
                </a>
<?php
}

?>