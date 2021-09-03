<!--Pie chart example-->
<div class="form-actions">
<?php 
$asistentes_puntuales=100;
$total_asistentes=200;
date_default_timezone_set("America/Lima");
//$fecha_actual = date("Y-n-j");
$hora_actual = date("H:i:s");
//SOCIOS
//$model_socios = Socio::model()->findAllBySql('select * from socio where (FECHA_INGRESO <= "'.$fecha_actual.'" and ESTADO != 0)');
$model_socios = Socio::model()->findAllBySql('select * from socio where (FECHA_INGRESO <= "'.$model_reunion->FECHA.'" AND ESTADO != 0) group by CI order by APELLIDO');
$cuenta_socios_activos=0;
foreach ($model_socios as $modelo) {
    $cuenta_socios_activos++;
}
//TOAL DE SOCIOS REGISTRADOS INICIALMENTE ESTAN ATRASADOS
$asistentes_atrasados=$cuenta_socios_activos;
//ASISTENTES A LA REUNION
$codigo_de_reunion=$model_reunion->CODIGO_REUNION;
$model_asistentes = Asistencia::model()->findAllBySql('select * from asistencia where CODIGO_REUNION = '.$codigo_de_reunion.' group by CODIGO_SOCIO');
$cuenta_socios_asistentes_puntuales=0; 
$cuenta_socios_asistentes_atrasados=0;
foreach ($model_asistentes as $modelo_asistencia) {
    if($modelo_asistencia->REGISTRA_ATRASO==1) //ATRASADOS
    {
        $cuenta_socios_asistentes_atrasados++;
    }   
 else { //ESTA PUNTUAL
        $cuenta_socios_asistentes_puntuales++;
    }    
}
//Tiempo maximo de ingreso
 
                $connection = Yii::app()->db;
                $sql = "SELECT ADDTIME(HORA_INGRESO, TIEMPO_ESPERA) AS HORA_INGRESO  FROM reunion WHERE `CODIGO_REUNION` = ".$codigo_de_reunion."";
                $command = $connection->createCommand($sql);
                $rows = $command->execute();
                $rows = $command->queryAll();

                foreach ($rows as $row) {
                    $tiempo_maximo=$row['HORA_INGRESO'];
                    }
                    $faltantes=$cuenta_socios_activos-($cuenta_socios_asistentes_puntuales+$cuenta_socios_asistentes_atrasados);
                    echo "<br><span class='h2 text-info'>".$cuenta_socios_activos.' SOCIOS DE LA JUNTA</span>';
echo "<br><span class='text-info'>TIEMPO MAXIMO DE ENTRADA PUNTUAL:</span><span class='text-warning'> ".$tiempo_maximo.'</span>';

echo "<br><span class='text-warning'>+ ".$cuenta_socios_asistentes_puntuales.' PUNTUALES <b>( '.round($cuenta_socios_asistentes_puntuales*100/$cuenta_socios_activos).' % )</b></span>';
echo "<br><span class='text-error'>+ ".$cuenta_socios_asistentes_atrasados.' ATRASADOS <b>( '.round($cuenta_socios_asistentes_atrasados*100/$cuenta_socios_activos).' % )</b></span>';
echo "<br>______________________________";
$presentes=$cuenta_socios_asistentes_puntuales+$cuenta_socios_asistentes_atrasados;                        
echo "<br><span class='text-success'><h3> ".$presentes.' PRESENTES ( '.round($presentes*100/$cuenta_socios_activos).' % )</h3> </span>';

                       ?>
<?php  
$format_func = <<<EOD
js:function(label, series){
    return '<div style="font-size:25pt;text-align:center;padding:0px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';}
EOD;
$this->widget('application.extensions.EFlot.EFlotGraphWidget', 
    array(
        'data'=>array(             
            array('label'=>'PUNTUALES', 'data'=>$cuenta_socios_asistentes_puntuales),           
            array('label'=>'FALTANTES', 'data'=>$cuenta_socios_activos-($cuenta_socios_asistentes_puntuales+$cuenta_socios_asistentes_atrasados)),
            array('label'=>'ATRASADOS', 'data'=>($cuenta_socios_asistentes_atrasados)),
            
                        
        ),
        'options'=>array(
            'series'=> array('pie'=>array(
                'show'=>true,
                'radius'=> 1/2, //3/4, // 3/4,
                'formatter'=> $format_func,
                ),
            ),
            'legend'=> array('show'=>false),
        ),
        'htmlOptions'=>array('style'=>'width:250px;height:250px;')
    )
);
echo "<br><span class='text-info'> ".$faltantes.' FALTANTES <b>( '.round($faltantes*100/$cuenta_socios_activos).' %)</b></span>';
?>
</div>