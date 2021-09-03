<?php
/** @var TconvocatoriaController $this */
/** @var Tconvocatoria $model */
$this->breadcrumbs=array(
	'Tconvocatorias'=>array('index'),
	$model->COD_CONVOCATORIA,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Tconvocatoria::label(2), 'icon' => 'list', 'url' => array('index')),
//    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Tconvocatoria::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Editar generador'), 'icon' => 'pencil', 'url' => array('actualizarTicket', 'id' => $model->COD_CONVOCATORIA)),
//    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->COD_CONVOCATORIA), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
//    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
//      array('label' => Yii::t('AweCrud.app', 'Buscar Ticket'), 'icon' => 'list-alt', 'url' => array('buscarTicket', 'id' => $model->COD_CONVOCATORIA)),
    array('label' => Yii::t('AweCrud.app', 'Generar lista de tickets'), 'icon' => 'list-alt', 'url' => array('listaTicket', 'id' => $model->COD_CONVOCATORIA)),
//      array('label' => Yii::t('AweCrud.app', '__________________ Seleccionar convocatoria para llenar lsita de socios'), 'icon' => 'list', 'url' => array('listaConvocados', 'id' => $model->COD_CONVOCATORIA)),
//    array('label' => Yii::t('AweCrud.app', 'Socio a convocar'), 'icon' => 'list-alt', 'url' => array('tconvocado/create')),
//     array('label' => Yii::t('AweCrud.app', 'Exportar Convocados a Word'), 'icon' => 'pencil', 'url' => array('imprimirConvocados', 'id' => $model->COD_CONVOCATORIA)),
);
?>

<fieldset>
    <legend> CONFIGURANDO TICKET</legend>

    <table class="table table-bordered">
                <tr>
                    <td>
                        <?php
                        $bandera = 0;
                        $contador = 0;
                      
                           $contador++;
                            echo '<center><b>JUNTA: '. $model->cODJUNTA->SECTOR_NOMBRE. '</b></center>';
                            setlocale(LC_TIME,"spanish");  
                            //$hoy=strftime("%A, %d de %B de %Y"); 
                            $Fecha=$model->FECHA_INICIA;
                            $Fecha=strftime("%A, %d de %B de %Y",strtotime($Fecha));  
                             $Imprimir_Fecha = ucfirst(iconv("ISO-8859-1", "UTF-8", $Fecha));
                            echo '<b>FECHA QUE INICIA LA VERIFICACIÓN DE DATOS:</b> ' . $Imprimir_Fecha ;
                           ?>
                        <h4 class="alert-info">DÍAS DE VERIFICACIÓN</h4>
                        <?php 
                        $dias="";
                        if($model->LUNES==1)
                        {$dias=$dias."LUNES<br>";}
                        if($model->MARTES==1)
                        {$dias=$dias."MARTES<br>";}
                        if($model->MIERCOLES==1)
                        {$dias=$dias."MIÉRCOLES<br>";}
                        if($model->JUEVES==1)
                        {$dias=$dias."JUEVES<br>";}
                        if($model->VIERNES==1)
                        {$dias=$dias."VIERNES<br>";}
                        if($model->SABADO==1)
                        {$dias=$dias."SÁBADO<br>";}
                        if($model->DOMINGO==1)
                        {$dias=$dias."DOMINGO<br>";}
                        if($dias=="")
                        {
                            echo "Debe ingresar al menos un día para la verificación de datos";
                        }
                        ?>
                        <h4 class="text-success"><?php echo $dias; ?></h4>
                        <h4 class="alert-info">HORARIOS DE ATENCIÓN</h4>
                        <?php
                                
                               echo "<b>De: </b>".$model->HORA_INICIA."<b> A </b>".$model->HORA_INICIA_RECESO; 
                            echo "<b> y de: </b>".$model->HORA_TERMINA_RECESO."<b> A </b>".$model->HORA_SALE; 
                            echo "<br><b>TIEMPO ESTIMADO DE ATENCIÓN </b>".$model->TIEMPO_ATENCION;
                            echo "<br><b>NUMERO DE SECRETARIAS A VERIFICAR: </b>".$model->NUMERO_CAJAS;
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
$convocatoria=Yii::app()->getSession()->get('ConvocatoriaSeleccionada');
if($convocatoria>0 and $convocatoria==$model->COD_CONVOCATORIA)
{
    echo "<h2 class=badget-info>LISTA DE SOCIOS CONVOCADOS</h2>";
    
      $connection = Yii::app()->db;
                $sql = "SELECT * FROM tconvocado WHERE COD_CONVOCATORIA=".$convocatoria;
                $command = $connection->createCommand($sql);
                $rows = $command->execute();
                $rows = $command->queryAll();
$contador=1;
                foreach ($rows as $row) {
                    $socio=$row['COD_SOCIO'];
                    $modelo=  Socio::model()->findByPk($socio);
                    echo $contador++ .".- ". $modelo->APELLIDO.'<br>';
                    }
}

//FECHAS QUE SE OMITIRAN
IF(ISSET($model_fechas_omitir))
{
    echo "<h3 class='text-info'> FECHAS A OMITIR  </h3>";
};
             foreach ($model_fechas_omitir as $omitir) {
                            $Fech_omitir = $omitir->FECHA;
                             $Fech_omitir=strftime("%A, %d de %B de %Y",strtotime($Fech_omitir));  
                             $Imprimir_Fecha = ucfirst(iconv("ISO-8859-1", "UTF-8", $Fech_omitir));
//                             echo '<b> - </b>'.$Imprimir_Fecha.'<br>';
                             echo CHtml::link(' - '.$Imprimir_Fecha.'<br>', array('tOmitirTicket/update/',
                        'id' => $omitir->COD_OMITIR));
                        }

?>





<!--Aumentado para ingresar Dias a omitir -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mymodal',
    'options' => array(
        'title' => 'OMITIR FECHA',
        'width' => 400,
        'height' => 250,
        'autoOpen' => false,
        'resizable' => 'true',
        'modal' => 'true',
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.3'
        ),
    ),
));

echo $this->renderPartial('/tOmitirTicket/_form_flotante', array(
    'model' => $model_omitir
));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>


<br> </br> 

<?php echo CHtml::link('Omitir la siguiente fecha', '', array('onclick' => '$("#mymodal").dialog("open");return false;')); ?>
<!-- Fin de aumentado para ingreso flotante-->