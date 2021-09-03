<?php

function nombremes($mes)
{
    setlocale(LC_TIME, 'spanish');
    $nombre = strftime("%B", mktime(0, 0, 0, $mes, 0, 2000));
    return $nombre;
}


/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
$this->menu = array(
    //  array('label' => Yii::t('AweCrud.app', 'Convertir a excel'), 'icon' => 'pencil', 'url' => array('historial_total_consumos_excel')),

);
$lista_mes = '';
$datos = ''

?>


<table class="table-bordered table-responsive table-striped" width="100%">
    <tr>
        <td colspan="2">
            <h3 class="btn-primary text-center ">
                HISTORIAL TOTAL DE CONSUMO DE AGUA POTABLE
            </h3>
        </td>
    </tr>
    <tr>
        <td colspan="2">



            <table class="table-hover table table-condensed">
                <thead class="badge-info">
                    <th>N°</th>
                    <th>Año de cobro</th>
                    <th>Mes de consumo</th>
                    <th>Cantidad de Acometidas</th>
                    <th>Consumo (m³) </th>
                </thead>
                <?php
                $contador = 1;
                $datos = '{ "name": "Mes de cobro", "data": [' ;
                foreach ($consumos as $consumo) {

                    echo "<tr>";
                    echo '<td style="text-align:right;">' . $contador++ . '</td>';
                    echo '<td>' . $consumo->ANIO_COBRO . '</td>'; // Año de cobro                                   
                    echo '<td>' . nombremes($consumo->MES_COBRO) . '</td>'; // Mes de cobro
                    echo '<td>' . $consumo->CONSUMO_ANTERIOR . '</td>';  // Cantidad de acometidas                              
                    echo '<td>' . $consumo->CONSUMO_ACTUAL . '</td>'; // Consumo  
                    if ($lista_mes == '')
                        $lista_mes = $lista_mes . '"' .nombremes($consumo->MES_COBRO).'-'.$consumo->ANIO_COBRO. '"';
                    else
                        $lista_mes = $lista_mes . ', "' . nombremes($consumo->MES_COBRO).'-'.$consumo->ANIO_COBRO . '"';

                  if ($datos==1)
                       $datos = $datos. $consumo->CONSUMO_ACTUAL;
                       else
                       $datos = $datos.', '.$consumo->CONSUMO_ACTUAL;
                  

                    echo "</tr>";
                } // Fin de todos los consumos	
                $datos = $datos.'] }';
                ?>
            </table>
        </td>
    </tr>
</table>

<!-- <div class="collapse" id="Acordion"> 
    </div>
	 <a class="" data-toggle="collapse" href="#Acordion" aria-expanded="false" aria-controls="Acordion">
        VER MAS DETALLES
    </a>
	-->




<?php
/* echo "<br>".$lista_mes;
 echo "<br>"."________________";
 echo "<br>".$datos; */
$this->Widget('ext.highcharts.HighchartsWidget', array(
    'options' => '{
            "scripts" : {
            "highcharts-more",   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
            "modules/exporting", // adds Exporting button/menu to chart
            "themes/grid-light"        // applies global grid theme to all charts
            },
      "title": { "text": "Historial de consumos en m³" },
      "xAxis": {
         "categories": [' . $lista_mes . ']
      },
  
    
      "yAxis": {
         "title": { "text": "Consumo (m³)" }
      },

      


      "series": [   '
        . $datos
        . ' ]
   }'
));
?>