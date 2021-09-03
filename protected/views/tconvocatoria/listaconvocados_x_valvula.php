<?php
$this->menu = array(
    //array('label' => Yii::t('AweCrud.app', 'Padrón en Excel') . ' ' . bJUNTA::label(2), 'icon' => 'list', 'url' => array('imprimirExcel')),
    array('label' => Yii::t('AweCrud.app', 'Editar convocatoria'), 'icon' => 'pencil', 'url' => array('tconvocatoria/actualizar_x_valvula', 'id' => $model->COD_CONVOCATORIA)),
    array('label' => Yii::t('AweCrud.app', 'Exportar padrón a Word'), 'icon' => 'pencil', 'url' => array('imprimirConvocatorias_x_valvula', 'id' => $model->COD_CONVOCATORIA)),
);
?>
<fieldset>
    <div class="form fondoBDanterior">

        <?php
    //    echo ' Convocatoria realizado para la/s Juntas Locales: <h4>' . $model->cODJUNTA->SECTOR_NOMBRE ;
        
        if (isset($model->cODJUNTA1))
        {
            echo ", ".$model->cODJUNTA1->SECTOR_NOMBRE;
        }
         if (isset($model->cODJUNTA2))
        {
            echo ", ".$model->cODJUNTA2->SECTOR_NOMBRE;
        }
        echo '</h4>';

        $connection = Yii::app()->db;

        $Codigo_Valvulas=$model->COD_JUNTA;
      
   
        $sql = "
        SELECT
    `SOCIO`.`APELLIDO` AS APELLIDO
    , `SOCIO`.`CI` AS CI
    , `SOCIO`.`GENERO` AS GENERO 
    , `TERRENO`.`NUM_TERRENO` AS NUM_TERRENO
    , `TERRENO`.`AREA` AS AREA
    
    , `tconvocatoria`.`ENCABEZADO`
    , `tconvocatoria`.`TITULO`
    , `tconvocatoria`.`TIPO`
    , `tconvocatoria`.`FECHA`
    , `tconvocatoria`.`HORA`
    , `tconvocatoria`.`CUERPO`
    , `tconvocatoria`.`NOTA`
    , `tconvocatoria`.`FIRMA`
    
    
FROM
    `jurechgis`.`terreno` as TERRENO
    INNER JOIN `jurechgis`.`valvula` as VALVULA 
        ON (`TERRENO`.`COD_VALVULA` = `VALVULA`.`COD_VALVULA`)
    INNER JOIN `jurechgis`.`socio` as SOCIO 
        ON (`TERRENO`.`CODIGO` = `SOCIO`.`CODIGO`)    
   
        inner join `jurechgis`.`tconvocatoria`
        ON(`VALVULA`.`COD_VALVULA` = `tconvocatoria`.`COD_JUNTA`)
        WHERE "
        
        ."`VALVULA`.`COD_VALVULA` = ".$Codigo_Valvulas." and TERRENO.VALIDADO = 1" 
         ." and `tconvocatoria`.`COD_CONVOCATORIA` = ".$model->COD_CONVOCATORIA
            //    .' or `tconvocatoria`.`COD_CONVOCATORIA` = 2' //Agrupando con la citacion de cerro negro también
                
                . ' group by `SOCIO`.`CI` order by `SOCIO`.`APELLIDO`';
//        echo $sql;

        $command = $connection->createCommand($sql);
        $rows = $command->execute();
        $rows = $command->queryAll();
        ?>
        <div class="table-responsive">
<!--            <table class="table table-striped table-bordered">
                <tbody>-->
            
            <table class="table table-bordered table-hover">
                <tr>
                    <td>
                        <?php
                        $bandera = 0;
                        $contador = 0;
                        foreach ($rows as $row) {
                           $contador++;
                            echo '<center><b>'. $row['ENCABEZADO']. '</b></center>';
                            echo '<center><b>' . $row['TITULO'] . " N°  ".$contador. '</b></center>';
                            if($row['GENERO']=="F")
                            {
                                echo "<b>Sra. </b>";
                            }
                            else
                            {
                               echo "<b>Sr. </b>"; 
                            }
                            echo '  ' . $row['APELLIDO'] . '';
                            echo '<div style="text-align:justify;">';
                            echo 'Citase con carácter obligatorio <b>' . $row['TIPO'] . '</b>';
                           echo ', que se realizará el día: ';
                             
                             $Fecha= $row['FECHA'];
                           setlocale(LC_TIME,"spanish"); 
                    //$hoy=strftime("%A, %d de %B de %Y"); 
                    $hoy=strftime("%A %d de %B de %Y",strtotime($Fecha));
                echo '<b>'.$hoy.'</b>'; 
    
                            echo ' a las <b>' . date("G:i", strtotime($row['HORA'])) . '</b>';
                            echo '' . $row['CUERPO'] . '</div>';
                            echo '<br><div style="text-align:justify;"><b>NOTA:</b> ' . $row['NOTA'] . '</div>';
                            echo '<br><br><center><b>ATENTAMENTE</b></center>';
                            echo '<center>' . $row['FIRMA'] .'</center>';
                            
                            if($bandera==1)
                            {
                                echo "</td></tr>"
                                .'</td>                        
                                        </tr>
                                    </table>'
                                    .'<table class="table table-bordered table-hover">
                                    <tr>
                                        <td>'    
                                . "<tr><td>";
                            }
                            else
                            {
                                echo "</td><td>";
                                $bandera=0;
                            }
                             $bandera = $bandera + 1;
                        }
                        ?>     
                        </td>                        
                </tr>
            </table>
<!--                </tbody>
            </table>-->
        </div>

</fieldset>
