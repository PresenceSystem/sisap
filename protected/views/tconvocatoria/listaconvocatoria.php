<head>
        <meta charset="utf-8" /> 
        <title></title>
    </head>
<?php
$this->menu = array(
    //array('label' => Yii::t('AweCrud.app', 'Padrón en Excel') . ' ' . bJUNTA::label(2), 'icon' => 'list', 'url' => array('imprimirExcel')),
    array('label' => Yii::t('AweCrud.app', 'Editar convocatoria'), 'icon' => 'pencil', 'url' => array('tconvocatoria/update', 'id' => $model->COD_CONVOCATORIA)),
    array('label' => Yii::t('AweCrud.app', 'Exportar padrón a Word'), 'icon' => 'pencil', 'url' => array('imprimirConvocatorias', 'id' => $model->COD_CONVOCATORIA)),
);
?>
<fieldset>
    <div class="form fondoBDanterior">

        <?php 
		$connection = Yii::app()->db;
      
        $sql = "
      SELECT
    `SOCIO`.`APELLIDO` AS APELLIDO
    , `SOCIO`.`CI` AS CI
    , `SOCIO`.`GENERO` AS GENERO 
	, `g`.`GRUPO` AS COD_GRUPO 
    , `tconvocatoria`.`ENCABEZADO`
    , `tconvocatoria`.`TITULO`
    , `tconvocatoria`.`TIPO`
    , `tconvocatoria`.`FECHA`
    , `tconvocatoria`.`HORA`
    , `tconvocatoria`.`CUERPO`
    , `tconvocatoria`.`NOTA`
    , `tconvocatoria`.`FIRMA`
FROM
   `socio` AS SOCIO         
        INNER JOIN `tconvocado` AS c
        ON `SOCIO`.`CODIGO` = c.`COD_SOCIO`
        INNER JOIN `grupo` AS g
        ON g.`COD_GRUPO` = SOCIO.COD_GRUPO	
        INNER JOIN `tconvocatoria` AS tconvocatoria
        ON tconvocatoria.`COD_CONVOCATORIA` = c.`COD_CONVOCATORIA` 
        WHERE  `tconvocatoria`.`COD_CONVOCATORIA` = ".$model->COD_CONVOCATORIA
         ."           GROUP BY `SOCIO`.`CI` 
                 ORDER BY SOCIO.COD_GRUPO, `SOCIO`.`APELLIDO` ";
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
						$contador_x_grupo = 0;
						$bandera_cambio_de_grupo = 0;
                        foreach ($rows as $row) {
                           $contador++;
						   if ($bandera_cambio_de_grupo != $row['COD_GRUPO'])
						   {
							   $contador_x_grupo = 0;
							   $bandera_cambio_de_grupo = $row['COD_GRUPO'];
						   }						   
						   $contador_x_grupo++;
                        
                            echo '<center><b>'. $row['ENCABEZADO']. '</b></center>';
                           echo '<center><b>' . $row['TITULO'] . " N°  ".$contador.'   G.'. $row['COD_GRUPO'].'-'.$contador_x_grupo.'</b></center>';
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
//                           echo 'Se cita con carácter obligatorio a la <b>' . $row['TIPO'] . '</b>';
//                           echo ', que se realizará el día: ';
//                             
//                             $Fecha= $row['FECHA'];
//                           setlocale(LC_TIME,"spanish"); 
//                    //$hoy=strftime("%A, %d de %B de %Y"); 
//                    $hoy=strftime("%A %d de %B de %Y",strtotime($Fecha));
//                echo '<b>'.$hoy.'</b>'; 
//    
//                            echo ' a las <b>' . date("G:i", strtotime($row['HORA'])) . '</b>'; 
                            echo '' . $row['CUERPO'] . '</div>';
                            echo '<div style="text-align:justify;"><b>NOTA:</b> ' . $row['NOTA'] . '</div>';
                            echo '<br><br><center><b>ATENTAMENTE</b></center>';
                            echo '<center>' . $row['FIRMA'] .'</center>';
                            ?>
                         <div style="text-align: center;">
                             <font face="Bar-Code 39">
                           <?= $row['CI'] ?>
                             </font>
                        </div>                        
                        <?php    
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
