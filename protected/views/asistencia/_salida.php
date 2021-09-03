<!--Pie chart example-->
<?php 
$asistentes_puntuales=100;
$total_asistentes=200;
date_default_timezone_set("America/Lima");
//$fecha_actual = date("Y-n-j");
$hora_actual = date("H:i:s");
//SOCIOS
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
$cuenta_socios_fugados=0;
$cuenta_socios_con_ingreso_y_salida=0;
foreach ($model_asistentes as $modelo_asistencia) {
    if($modelo_asistencia->REGISTRA_ATRASO==1) //ATRASADOS
    {
        $cuenta_socios_asistentes_atrasados++;
    }   
 else { //ESTA PUNTUAL
        $cuenta_socios_asistentes_puntuales++;
    } 
//    if($modelo_asistencia->REGISTRA_FUGA==1) //ATRASADOS
//    {
//        $cuenta_socios_fugados++;
//    }
     if(($modelo_asistencia->REGISTRA_INGRESO_PUNTUAL==1 or $modelo_asistencia->REGISTRA_ATRASO==1 ) and $modelo_asistencia->REGISTRA_SALIDA_PUNTUAL==1) //ATRASADOS
    {
        $cuenta_socios_con_ingreso_y_salida++;
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
//echo "<p class='text-info'>TIEMPO MAXIMO DE ENTRADA PUNTUAL: ".$tiempo_maximo.'</p><br>';
echo "<p class='text-info'>TOTAL DE SOCIOS REGISTRADOS EN LA JUNTA: ".$cuenta_socios_activos.'</p>';
$presentes=$cuenta_socios_asistentes_puntuales+$cuenta_socios_asistentes_atrasados;
//INICIALMENTE FUGADOS SON TODOS LOS QUE INGRESARON
$cuenta_socios_fugados=$presentes-$cuenta_socios_con_ingreso_y_salida;
echo "<br><span class='text-success'> ".$presentes.' PRESENTES <b>( '.round($presentes*100/$cuenta_socios_activos).' %)</b></span>';
$faltantes=$cuenta_socios_activos-($presentes);
echo "<br><span class='text-warning'> ".$faltantes.' FALTANTES <b>( '.round($faltantes*100/$cuenta_socios_activos).' %)</b></span>';
echo "<br><span class='text-error'> ".$cuenta_socios_fugados.' FUGADOS <b>( '.round($cuenta_socios_fugados*100/$cuenta_socios_activos).' %)</b></span>';
echo "<br><span class='text-info'> ".$cuenta_socios_con_ingreso_y_salida.' REGISTRAN INGRESO Y SALIDA <b>( '.round($cuenta_socios_con_ingreso_y_salida*100/$cuenta_socios_activos).' %)</b></span>';

?>
<?php  
$format_func = <<<EOD
js:function(label, series){
    return '<div style="font-size:25pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';}
EOD;
$this->widget('application.extensions.EFlot.EFlotGraphWidget', 
    array(
        'data'=>array(             
            array('label'=>'TOTAL', 'data'=>$cuenta_socios_activos-($cuenta_socios_fugados+$cuenta_socios_con_ingreso_y_salida)), 
            array('label'=>'INGRESO Y SALIDA', 'data'=>$cuenta_socios_con_ingreso_y_salida),  
            array('label'=>'FUGADOS', 'data'=>$cuenta_socios_fugados),             
        ),
        'options'=>array(
            'series'=> array('pie'=>array(
                'show'=>true,
                'radius'=> 2/3, //3/4, // 3/4,
                'formatter'=> $format_func,
                ),
            ),
            'legend'=> array('show'=>false),
        ),
        'htmlOptions'=>array('style'=>'width:300px;height:300px;')
    )
);
?>
