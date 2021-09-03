<?php
/*
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
$this->menu = array(
    array('label' => Yii::t('AweCrud.app', 'Convertir a pdf'), 'icon' => 'pencil', 'url' => array('lista_por_grupo_pdf')),
    array('label' => Yii::t('AweCrud.app', 'Convertir a excel'), 'icon' => 'pencil', 'url' => array('lista_por_grupo_excel')),
    array('label' => Yii::t('AweCrud.app', 'Convertir a word'), 'icon' => 'download', 'url' => array('lista_por_grupo_word')),
);
?>

<?php
$suma_totalizado = 0;
$suma_totalizado_agua = 0;
$suma_totalizado_alcantarillado = 0;
foreach ($model_grupo as $grupo) {
    echo '<h3 class="btn-primary text-center">';
    echo '<b>GRUPO: ' . $grupo->GRUPO . '</b>';
    if ($grupo->DESCRIPCION != '')
        echo ' "' . $grupo->DESCRIPCION . '"';
    echo "</h3>";
    ?>


    <table class="table-bordered table-responsive table-striped" width="100%">

        <tr>        
            <td colspan="2">
                <!--LISTA DE SOCIOS QUE ASISTIERON-->

                <table class="table-hover table table-condensed table-bordered">
                    <thead class="badge-info">
                    <th>N°</th>                        
                    <th>SOCIO</th>
                    <th>CI</th>
                    <th>CELULAR</th>
                    <th>TELÉFONO</th>
                    <th>AGUA POTABLE</th>
                    <th>ALCANTARILLADO</th>
                    <th></th>
                    </thead>
    <?php
    $contador = 1;
    $valor_total = 0;
    $contador_agua = 0;
    $contador_alcantarillado = 0;
    $contador_alcantarillado_grupo = 0;
    $contAA = 0;
    foreach ($model_socios as $modelo_socio) {
        if ($modelo_socio->COD_GRUPO == $grupo->COD_GRUPO) {
            echo "<tr>";
            echo '<td style="text-align:right;">' . $contador++ . '</td>';

            echo '<td>' . $modelo_socio->APELLIDO . '</td>';
            echo '<td>' . $modelo_socio->CI . '</td>';
            echo '<td>' . $modelo_socio->CELULAR . '</td>';
            echo '<td>' . $modelo_socio->TELEFONO . '</td>';
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
// Lista de medidores de agua activos
            $medidores = Medidor::model()->findAllBySql('SELECT
                  m.`ID`,
  m.`NUMERO`,
  m.`CONSUMO_INICIAL`,
  m.`ORDEN_RECORIDO`,
  m.`ID_GRUPO`,
  m.`COD_USUARIO`,
  sm.ID as `FECHA_ACTUALIZACION`
FROM medidor AS m
INNER JOIN `socio_medidor` AS sm
ON sm.`ID_MEDIDOR` = m.`ID` 
INNER JOIN socio AS s
ON s.`CODIGO` = sm.`CODIGO_SOCIO`
WHERE sm.`INACTIVO` = 0 AND s.`CODIGO` = ' . $modelo_socio->CODIGO);
            echo "<td>";
            $contME = 1;
            foreach ($medidores as $med) {
                echo "<br><b>" . $contME++ ."[".$med->FECHA_ACTUALIZACION. "].</b> " . $med->NUMERO;
            }
            echo "</td>";
            // Lista de acometidas de alcantarillado
            $acometidas_alcantarillado = AcometidaAlcantarillado::model()->findAllBySql('SELECT aa.*
FROM acometida_alcantarillado as aa
INNER JOIN socio_medidor as sm
on aa.ID_SOCIO_MEDIDOR = sm.ID
INNER JOIN socio as s
on s.CODIGO = sm.CODIGO_SOCIO
WHERE aa.INACTIVO = 0 AND s.`CODIGO` = ' . $modelo_socio->CODIGO);
            echo "<td>";
            $contAA = 0;
            foreach ($acometidas_alcantarillado as $aa) {
                $contAA++;
                echo "<br><b>" . $contAA ."[".$aa->ID_SOCIO_MEDIDOR. "]. ".$aa->iDGRUPO->DESCRIPCION. "</b> " . $aa->DESCRIPCION." (".$aa->DESCRIPCION.")";
            }
            
            $contador_alcantarillado_grupo = $contador_alcantarillado_grupo + $contAA;
//            ECHO "<H3>";
//            ECHO $contador_alcantarillado_grupo;
//            ECHO "<H3>";
            echo "</td>";
        } // Fin si pertenece al grupo    





        echo "</tr>";
    } //Fin de cada socio
    echo '<tr>';
    echo "<td colspan='5'> <h4>TOTAL</h4></td>";
    echo '<td><h4>' . $contador_agua . "</h4></td>";
    echo "<td><h4>" . $contador_alcantarillado . "</h4></td>";
echo "<td></td>";
echo "<td>". $contador_alcantarillado_grupo ."</td>";

    echo "</tr>";
    $suma_totalizado = $suma_totalizado + $contador -1;
    $suma_totalizado_agua = $suma_totalizado_agua + $contador_agua;
    $suma_totalizado_alcantarillado = $suma_totalizado_alcantarillado + $contador_alcantarillado;
    ?>  
                </table>
                <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
            </td>
        </tr>
    </table>

                    <?php
                } //Termina foreach de cada grupo
                echo "<div class='badge badge-success'> <h3>" . $suma_totalizado . "</h3> SOCIOS DE LA ORGANIZACIÓN</div>";
                echo "<div class='badge badge-info'> <h3> " . $suma_totalizado_agua . "</h3> SOCIOS DE AGUA POTABLE</div>";
                echo "<div class='badge badge-warning'> <h3>" . $suma_totalizado_alcantarillado . "</h3> SOCIOS DE ALCANTARILLADO</div>";
                ?>