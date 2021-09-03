<?php
/*
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
$this->menu = array(
    array('label' => Yii::t('AweCrud.app', 'Convertir a excel'), 'icon' => 'pencil', 'url' => array('lista_excel')),
        // array('label' => Yii::t('AweCrud.app', 'Convertir a word'), 'icon' => 'download', 'url' => array('lista_socios_word')),
        //  array('label' => Yii::t('AweCrud.app', 'Convertir a pdf'), 'icon' => 'pencil', 'url' => array('lista_socios_pdf')),
);
?>

<div class="span12">

    <h3 class="btn-primary text-center ">
        PADRON ELECTORAL
    </h3>


    <table class="table-hover table table-condensed table-bordered">
        <thead class="badge-info">
        <th>N°</th>
        <th>SOCIO</th>
        <th>GRUPO</th>
        <th>CI</th>
        <th>CELULAR</th>
        <th>TELÉFONO</th>
      <!--  <th>ESTADO DEL SOCIO</th> -->
        <th>AGUA POTABLE</th>
        <th>ALCANTARILLADO</th>
        <th>MEDIDOR</th>
        </thead>
        <?php
        $contador = 1;
        $valor_total = 0;
        $contador_agua = 0;
        $contador_alcantarillado = 0;
        foreach ($model_socios as $modelo_socio) {
            echo "<tr>";
            echo '<td style="text-align:right;">' . $contador++ . '</td>';
            //   echo '<td>'.$modelo_socio->OBS.'</td>'; // Numero de medidor
            //   echo '<td>';  
            // echo $modelo_socio->COD_BARRA.'<br>';
            /*       $model_factura_consumo = Factura::model()->findBySql('call consultar_consumo_actual('.$modelo_socio->COD_BARRA.')'); //ID de socio medidor
              if (isset($model_factura_consumo)) {
              echo $model_factura_consumo->CONSUMO_ACTUAL;
              }
              else
              {
              echo "0";
              } */

            //  echo '</td>';
            echo '<td>' . $modelo_socio->APELLIDO . '</td>';
            echo '<td>' . $modelo_socio->CI . '</td>';
            echo '<td>' . $modelo_socio->CELULAR . '</td>';
            echo '<td>' . $modelo_socio->TELEFONO . '</td>';
            // echo '<td>'.$modelo_socio->ESTADO.'</td>';   
            $model_socio_medidor = SocioMedidor::model()->findAllBySql('select * from socio_medidor 
									where CODIGO_SOCIO = ' . $modelo_socio->CODIGO . ' AND INACTIVO = 0');
            //Pertenece al agua o alcantarillado
            IF ($modelo_socio->USU_AGUA_POTABLE == 1) {
                $AGUA = '✔';
                $contador_agua++;
            } else
                $AGUA = '';
            echo '<td>' . $AGUA . '</td>';
            IF ($modelo_socio->USU_ALCANTARILLADO == 1) {
                $ALCANTARILLADO = '✔';
                $contador_alcantarillado++;
            } else
                $ALCANTARILLADO = '';
            echo '<td>' . $ALCANTARILLADO . '</td>';
            //Fin pertenece al agua o alcantarillado
            echo '<td>';
            $bandera_medidores = 0;
            foreach ($model_socio_medidor as $socio_medidor) {
                if ($bandera_medidores == 1)
                    echo "; ";
                echo '<b>' . $socio_medidor->iDMEDIDOR->iDGRUPO->DESCRIPCION . ': </b>' . $socio_medidor->iDMEDIDOR->NUMERO;
                $bandera_medidores = 1;
            }
            echo '</td>';
        } // Fin si tiene asistencia

        echo "</tr>";
        echo '<tr>';
        echo "<td colspan='5'> <h4>TOTAL</h4></td>";
        echo '<td><h4>' . $contador_agua . "</h4></td>";
        echo "<td><h4>" . $contador_alcantarillado . "</h4></td>";
        echo "</tr>";
        ?>  
    </table>

</div>