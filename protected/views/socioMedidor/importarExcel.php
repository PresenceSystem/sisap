<?php /*
 * ANALIZAMOS, DISE�AMOS Y PROGRAMAMOS TUS IDEAS  
 *    EN SISTEMAS INFORM�TICOS PARA LA WEB
 *            Ing. Juan Tierra
 *            PRESENCE SYSTEM

 */ ?>

<?php

//1. Seguridad 1,2
    $connection_sisap = Yii::app()->db;
    //echo Yii::app()->db;
    ?>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>:: Importar de Excel a la Base de Datos ::</title>

    </head>

    <body>
        <div class="text-center">

            <!--<!– FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL –>-->
            <div class="row"> <img src="<?php echo Yii::app()->baseUrl; ?>/images/pagina/excel_bd.png" width="30%"></div>
            <div class="alert alert-success"> Selecciona el archivo a importar:
            </div>
            <div class="alert alert-info">
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="spreadsheet"/>
                    <input class="btn-info" type="submit" name="submit" value="Importar datos" />
                </form>
            </div>

            <!--<!– CARGA LA MISMA PAGINA MANDANDO LA VARIABLE upload –>-->

            <?php
            //Check valid spreadsheet has been uploaded
            date_default_timezone_set('UTC');
            if (isset($_FILES['spreadsheet'])) {
                if ($_FILES['spreadsheet']['tmp_name']) {
                    if (!$_FILES['spreadsheet']['error']) {
                        $inputFile = $_FILES['spreadsheet']['tmp_name'];
                        $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
                        // if ($extension == 'xls' or $extension == 'XLSX' or $extension == 'ods') {
                        require_once 'PHPExcel.php';
                        //Read spreadsheeet workbook
                        try {
                            $inputFileType = PHPExcel_IOFactory::identify($inputFile);
                            $objReader = PHPExcel_IOFactory::createReader($inputFileType);

                            $objPHPExcel = $objReader->load($inputFile);
                        } catch (Exception $e) {
                            die($e->getMessage());
                        }

                        //Get worksheet dimensions
                        $objHoja = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                        //Loop through each row of the worksheet in turn
                        $contador_lineas = 0;
                        echo "<marquee><h2>INFORME DE PROCESAMIENTO:</h2></marquee><br>";
                        foreach ($objHoja as $iIndice => $objCelda) {

                            if ($objCelda['B'] != NULL and $objCelda['B'] > 0) {// Si fue realizado el levantamientos realizar el procesamiento de la fila
                                $contador_lineas++;
                                echo '<div class="text-left"><b>' . $contador_lineas . '.-</b> Consumo ingresado de: <b>' . $objCelda['D'] . '</b><br>';
                                //                    print $objCelda['A'] . " " . $objCelda['B'] . $objCelda['C'] . "<br>";
                                /*                                 * * OBTENER DATOS DEL EXCEL ** */

                                $ID = $objCelda['B'];
                                $Recorrido = $objCelda['C'];
                                $Apellido_Nombre = $objCelda['D'];
                                $CI = $objCelda['E'];
                                $Num_medidor = $objCelda['F'];
                                $Consumo_anterior = $objCelda['G'];
                                $Consumo_Actual = $objCelda['H'];
                                //Si el consumo anterior es mayor al actual entonces se guardara el mismo consumo
                                //Por lo tanto no tendra consumo negativo tendra de consumo = 0
                                if ($Consumo_anterior > $Consumo_Actual)
                                {
                                    $Consumo_Actual = $Consumo_anterior;
                                }
                                //INGRESAR EL CONSUMO PARA ESTE MES
                                //BUSCAR FACTURA
                                $factura = Factura::model()->findAllBySql('call buscar_factura_mes(' . $ID . ')');
                                foreach ($factura as $factura) {

                                    if (isset($factura->ID)) {

                                        //                   -- 1.- Rangos de valores por consumo
                                        $sql = "CALL listar_rangos_de_consumo();";
                                        $command = $connection_sisap->createCommand($sql);
                                        $rangos_consumo = $command->queryAll();
                                        // 2.- calcular valor consumido en m3
                                        $Consumo_Calculado = $Consumo_Actual - $Consumo_anterior; //Ejm: 100 m3

                                        // 3.- calcula el valor a cancelar
                                        $consumo_total = $Consumo_Calculado; //Ejm: 100 m3                                   
                                        $consumo_contador = 0; //Ejm: 0
                                        $valor_calculado = 0;
                                        $bandera = 0;
                                        echo "<br><h3> FACTURA POR " . $consumo_total . ' m3</h3>';
                                        $contador_rangos = 1;
                                        foreach ($rangos_consumo as $rango) {
                                            if ($rango['TIPO_CALCULO'] == 2) {    //2.- Es un valor fijo                                             
                                                // $valor_calculado = $rango['VALOR'];
                                                // $consumo_total = $consumo_total - $rango['VALOR_MAX'];
                                                // echo "<br> - BASICO HASTA " . $rango['VALOR_MAX'] . ' m3 = ' . $valor_calculado;
                                            } else { // 1.- Es un valor calculado
                                                $consumo_contador = ($rango['VALOR_MAX'] - $rango['VALOR_MIN']) + 1; // mas 1 para tomar en cuenta el valor minimo
                                                if (($consumo_total >= $consumo_contador) && ( $rango['VALOR_MAX'] > 0)) {
                                                    $valor_calculado = $valor_calculado + ($consumo_contador * $rango['VALOR']);
                                                    echo "<br> - POR " . $consumo_contador . ' m3 X ' . $rango['VALOR'] . ' = ' . ($consumo_contador * $rango['VALOR']);
                                                    $consumo_total = $consumo_total - $consumo_contador;
                                                } else {
                                                    if ($consumo_total != 0) {
                                                        if ($consumo_total < 0)
                                                            $consumo_total = 0;
                                                        $valor_calculado = $valor_calculado + ($consumo_total * $rango['VALOR']);
                                                        echo "<br> - POR " . $consumo_total . ' m3 X ' . $rango['VALOR'] . ' = ' . ($consumo_total * $rango['VALOR']);
                                                        $consumo_total = 0;
                                                    }
                                                }
                                            }
                                        }
                                        ECHO "<h4>TOTAL: " . $valor_calculado . '</h4>';
                                        // 4.- actualiza el registro
                                        $factura->CONSUMO_ANTERIOR = $Consumo_anterior;
                                        $factura->CONSUMO_ACTUAL = $Consumo_Actual;
                                        $factura->CONSUMO_CALCULADO = $Consumo_Calculado;
                                        $detalle_factura = Detalle::model()->findBySql('call buscar_detalle_factura_consumo_mes(' . $factura->ID . ')');
                                        if ($detalle_factura->ESTADO != 1) // Si ahun no paga modificará el valor
                                        {
                                        if ($factura->save()) {                                            
                                            if ($detalle_factura->ID > 0) {
                                                $detalle_factura->CANTIDAD = $Consumo_Calculado;
                                                $detalle_factura->V_UNITARIO = 0;
                                                $detalle_factura->V_TOTAL = $valor_calculado;
                                                if ($detalle_factura->save()) {
                                                    echo "<br> Guardado satisfactoriamente<br>";
                                                } else
                                                    echo "<br><b>*</b> Error al ingresar los datos del usuario de agua potable: " . $Apellido_Nombre;
                                            }
                                                }
                                            } else
                                                echo "<br><b>-></b> No esta generado la factura del usuario: " . $Apellido_Nombre;
                                        } else
                                                echo "<br><b>-</b> No se puede cambiar el consumo para el socio " . $Apellido_Nombre.' posiblemente ya esta cancelado';
                                
                                    //echo "</div>"
                                                }  // Fin de cada factura
                            } // Fin, Si fue realizado el levantamientos realizar el procesamiento de la fila
                        }// sierra el foreach de los registros del excel               
                        ?>
                        <div class = "progress progress-striped ">
                        <?php
                        for ($i = 1; $i <= $contador_lineas; $i++) {
                            $estilo = "width: " . (100 / $contador_lineas) . "%;";
                            ?>
                                <div class = "bar" style = "<?php echo $estilo ?>" ></div>			
                            <?php } ?>

                        </div>
                <?php
                echo "Se procesaron " . $contador_lineas . " filas del excel";
//                        } else {
//                            ECHO "<br>:".$extension.';<br>';
//                            echo "<div class='badge-error'>Por favor seleccione un archivo tipo:<br> <b>.XLS</b> o <b>.XLSX</b> o <b>.ODS</b> </div>";
//                        }
            } else {
                echo $_FILES['spreadsheet']['error'];
            } // Fin de la condicion para capturar el error
        }
    } //fin de la condicion para q se haya subido el archivo 
    ?>
        </div>
    </body>

    </html>
    <?php

?>

