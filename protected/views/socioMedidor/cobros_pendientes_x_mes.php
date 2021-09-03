<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ 
$this->menu=array(   
  /*  array('label' => Yii::t('AweCrud.app', 'Convertir a excel'), 'icon' => 'pencil', 'url' => array('lista_socios_excel')),
    array('label' => Yii::t('AweCrud.app', 'Convertir a word'), 'icon' => 'download', 'url' => array('lista_socios_word')),
    array('label' => Yii::t('AweCrud.app', 'Convertir a pdf'), 'icon' => 'pencil', 'url' => array('lista_socios_pdf')),
    */
);

 
                                        $imagen_off = CHtml::image(Yii::app()->baseUrl."/images/iconos/off.png");
                                 
                                        $imagen_on = CHtml::image(Yii::app()->baseUrl."/images/iconos/on.png");
                                    ?>

<table class="table-bordered table-responsive table-striped" width="100%">
        <tr>
            <td colspan="2">
               <h3 class="btn-primary text-center ">
                       Cobros pendientes hasta el mes de <?php echo gmdate('M Y'); ?>
                   </h3>
            </td>
        </tr>
        <tr>        
            <td colspan="2">
                <!--LISTA DE SOCIOS QUE ASISTIERON-->
                
                <table class="table-hover table table-condensed">
                    <thead class="badge-info">
                        <th style="text-align:center;">N°</th>
                        <th style="text-align:center;">MEDIDOR</th>
                        <th style="text-align:center;">SOCIO</th>
                        <th style="text-align:center;">CI</th>
                        <th style="text-align:center;">VALOR RECAUDADO</th>
                        <th></th>
                    </thead>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             foreach ($model_socios as $modelo_socio) {
                                
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
                                    echo '<td>'.$modelo_socio->OBS.'</td>';
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td>'.$modelo_socio->CI.'</td>';           
                                    echo '<td style="text-align:right;">'.$modelo_socio->COD_USUARIO.'</td>';   // Valor recaudado
                                 echo "</tr>";
                                  $valor_total = $valor_total + $modelo_socio->COD_USUARIO;
                             };
                             ?>  
                               <tr class="text-info">
                                 <td colspan="4"  style="text-align:right;">
                                   <b>  TOTAL </b>
                                  </td>
                                 <td  style="text-align:right;">
                                    <b> <?php echo $valor_total; ?> </b>
                                 </td>
                             </tr>
                </table>
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
            </td>
        </tr>
    </table>
