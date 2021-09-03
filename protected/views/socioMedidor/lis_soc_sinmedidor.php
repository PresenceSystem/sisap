<?php

/* 
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ 
$this->menu=array(   
    array('label' => Yii::t('AweCrud.app', 'Convertir a excel'), 'icon' => 'pencil', 'url' => array('lista_socios_excel')),
    array('label' => Yii::t('AweCrud.app', 'Convertir a word'), 'icon' => 'download', 'url' => array('lista_socios_word')),
    array('label' => Yii::t('AweCrud.app', 'Convertir a pdf'), 'icon' => 'pencil', 'url' => array('lista_socios_pdf')),
);
?>


<table class="table-bordered table-responsive table-striped" width="100%">
        <tr>
            <td colspan="2">
                
                    <h3 class="btn-primary text-center ">
                       SOCIOS NUEVOS SIN MEDIDOR
                   </h3>
                
            </td>
        </tr>
        <tr>        
            <td colspan="2">
                <!--LISTA DE SOCIOS QUE ASISTIERON-->
                
                <table class="table-hover table table-condensed">
                    <thead class="badge-info">
                        <th>NUMERO</th>
                        <th>NOMBRE</th>
                        <th>CI</th>
                        <th>CELULAR</th>
                        <th>TELÉFONO</th>
                    </thead>
                             <?php 
                             $contador=1;
                             $valor_total=0;
                             foreach ($model_socios as $modelo_socio) {
                                 echo "<tr>";                               
                                    echo '<td style="text-align:right;">'.$contador++.'</td>';
                                    echo '<td>'.$modelo_socio->APELLIDO.'</td>';
                                    echo '<td>'.$modelo_socio->CI.'</td>';                                
                                    echo '<td>'.$modelo_socio->CELULAR.'</td>';     
                                    echo '<td>'.$modelo_socio->TELEFONO.'</td>';     
                                 } // Fin si tiene asistencia
                               
                                 echo "</tr>";
                             ?>  
                </table>
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
            </td>
        </tr>
    </table>
