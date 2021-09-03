<?php
/*
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */
$this->menu = array(
    array('label' => Yii::t('AweCrud.app', 'Listado en excel'), 'icon' => 'pencil', 'url' => array('corte_excel')),
    array('label' => Yii::t('AweCrud.app', 'Generar oficios'), 'icon' => 'pencil', 'url' => array('corte_oficios_word')),
);


$imagen_off = CHtml::image(Yii::app()->baseUrl . "/images/iconos/off.png");

$imagen_on = CHtml::image(Yii::app()->baseUrl . "/images/iconos/on.png");
?>
<p>
<div class="span1"><?php echo $imagen_on; ?></div>
- El usuario esta activo, puede continuar con el cobro respectivo
</p>
<p>
<div class="span1"><?php echo $imagen_off; ?></div>
- El usuario no esta activo, no se generará mas facturas; por ende deja de ser miembro de la organización
</p>
<table class="table-bordered table-responsive table-striped" width="100%">
    <tr>
        <td colspan="2">
            <h3 class="btn-primary text-center ">
                CORTE DEL SERVICIO DE AGUA POTABLE
            </h3>
        </td>
    </tr>
    <tr>        
        <td colspan="2">
            <!--LISTA DE SOCIOS QUE ASISTIERON-->

            <table class="table-hover table table-condensed">
                <thead class="badge-info">
                <th>N°</th>
                <th>GRUPO</th>
                <th>MEDIDOR</th>
                <th>SOCIO</th>
                <th>CI</th>
                <th>MESES EN MORA</th>
                <th>DEUDA</th>
                <th></th>
                </thead>
                <?php
                $contador = 1;
                $valor_total = 0;
                $cuenta_meses = 0;

                foreach ($model_socios as $modelo_socio) {
                    // $cadena_de_texto = $modelo_socio->OBS;
                    // $cadena_buscada = 'Sin agua potable';
                    // $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
                    // if ($modelo_socio->COD_USUARIO >= 3 and $posicion_coincidencia === false) {
                    if (
                    //$modelo_socio->COD_USUARIO == 3 // Deudas iguales a 3 meses
                            //$modelo_socio->COD_USUARIO >= 4  //Todos los deudores hasta Abril del 2021
                            $modelo_socio->COD_USUARIO >= 3  //Todos los deudores hasta Abril del 2021
                            AND $modelo_socio->ESTADO == 0
                    ) {  // El estado es el campo inactivo de socio medidor
                        /*   $query = 'UPDATE `socio_medidor`
                          SET
                          `INACTIVO` = 1
                          WHERE `ID` =  '.$modelo_socio->FECHA_ACTUALIZACION;
                          $command = Yii::app()->db->createCommand($query);
                          $rowCount=$command->execute(); */
                        echo "<tr>";
                        echo '<td style="text-align:right;">' . $contador++ . '</td>';
                        echo '<td>' . $modelo_socio->COD_GRUPO . '</td>';
                        echo '<td>' . $modelo_socio->OBS . '</td>';
                        echo '<td>' . $modelo_socio->APELLIDO . '</td>';
                        echo '<td>' . $modelo_socio->CI . '</td>';
                        // &&&&&&&&&&&&& BUSCAR SI TIENE MEDIDORES INACTIVOS CON DEUDA &&&&&&&&&&
                        $meses_en_deuda = $modelo_socio->COD_USUARIO; // Meses en mora 
                        $valor_en_deuda = $modelo_socio->FOTO; // Deuda
                        foreach ($model_socios as $socio_inactivo) {
                            if ($socio_inactivo->ESTADO == 1
                                    AND $modelo_socio->APELLIDO == $socio_inactivo->APELLIDO
                                    AND $modelo_socio->CI == $socio_inactivo->CI) {
                                $meses_en_deuda = $meses_en_deuda + $socio_inactivo->COD_USUARIO;
                                $valor_en_deuda = $valor_en_deuda + $socio_inactivo->FOTO;
                            }
                        }
                        // &&&&&&&&& FIN DE BUSCAR SI TIENE MEDIDORES INACTIVOS CON DEUDA &&&&&&&
                        echo '<td>' . $meses_en_deuda . '</td>';   // Meses en mora 
                        echo '<td>' . $valor_en_deuda . '</td>';   // Deuda
                        $valor_total = $valor_total + $valor_en_deuda;
                        echo "<td width='50px'>";
                        if ($modelo_socio->FECHA_INGRESO == 1) { //INACTIVO
                            $imagen = $imagen_off;
                        } else {
                            $imagen = $imagen_on;
                        };
                        echo $imagen; //$modelo_socio->FECHA_INGRESO;
//                                    echo CHtml::link($imagen, 
//                                               array('socioMedidor/cambiar_estado/'.$modelo_socio->FECHA_ACTUALIZACION)
//                                               );
                        // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                        // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                        /*echo "<br><b>Socio N°:</b>" . $modelo_socio->CODIGO;
                        $modelo_primera_factura_deuda = Socio::model()->findBySql('SELECT
				  CONCAT(f.`ANIO_COBRO`,"-",f.`MES_COBRO`,"-01") AS FECHA_NACIMIENTO,
				  sm.ID, sm.`INACTIVO`
				FROM `factura` AS f 
				INNER JOIN `socio_medidor` AS sm
				ON sm.`ID` = f.`ID_MEDIDOR_SOCIO`
				INNER JOIN socio AS s
				ON s.`CODIGO` = sm.`CODIGO_SOCIO`
				INNER JOIN detalle AS d
				ON f.`ID` = d.`ID_FACTURA`
				WHERE 
				sm.`ID` = ' . $modelo_socio->CODIGO . '
				AND f.tipo = 1
				AND f.`ESTADO` = 0
				AND f.`TIPO` = 1
				AND sm.`INACTIVO` = 0
				GROUP BY d.`ID_FACTURA`
				ORDER BY f.ID ASC 
				 LIMIT 1');
                        echo "<br><b>Fecha mas antigua:</b>" . $modelo_primera_factura_deuda->FECHA_NACIMIENTO;

                        // **************************************
                        // ***** Encontrar factura en deuda *****
                        $modelo_ultima_factura_deuda = Factura::model()->findBySql('SELECT  buscar_ultima_factura_en_deuda(' . $modelo_socio->COD_BARRA . ') as ID');
                        echo "<br><b>Factura N°:</b>" . $modelo_ultima_factura_deuda->ID;
                        // *****************************************************
                        // ***** Encontrar descripción para el nuevo rubro *****
                        $modelo_descripcion = Rubro::model()->findBySql('SELECT  descripcion_rango_trimestral("' . $modelo_primera_factura_deuda->FECHA_NACIMIENTO . '") as DESCRIPCION');
                        echo "<br><b>Descripción del rubro:</b>" . $modelo_descripcion->DESCRIPCION;
                        // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                        // &&&&&&&&&&& AGREGAR DEUDA TRIMESTRAL &&&&&&&&&&&&&&
                        // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                         $query = 'CALL aplicar_sancion_trimestral("' . $modelo_primera_factura_deuda->FECHA_NACIMIENTO .'", '.$modelo_ultima_factura_deuda->ID. ')';
                        //$modelo_de_ayuda = Rubro::model()->findAllBySql($query);
                         $command = Yii::app()->db->createCommand($query);
                        //  $rows = $command->execute();
                        // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                        // &&&&&&&& FIN DE AGREGAR DEUDA TRIMESTRAL &&&&&&&&&&
                        // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& */
                          // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                          // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                        echo "</td>";
                        $cuenta_meses = $cuenta_meses + $meses_en_deuda;
                    } // Fin si tiene deuda                               
                    echo "</tr>";
                };
                ?>  
                <tr>
                    <td colspan="5" class="text-right text-warning h2">
                        TOTAL
                    </td>
                    <td class="text-warning h2">
                        <?= $cuenta_meses ?>
                    </td>
                    <td class="text-warning h2">
                        <?= $valor_total ?>
                    </td>
                </tr>
            </table>
            <!--FIN LISTA DE SOCIOS QUE ASISTIERON-->
        </td>
    </tr>
</table>
