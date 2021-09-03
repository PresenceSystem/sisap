<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" /> 
        <title></title>
    </head>
    <body> 
        <!--<h2>LISTA DE <?php // echo $model->SECTOR_NOMBRE; ?> </h2>-->
            <!--<table class="table table-bordered">-->
            
                  <?php
       // echo '<h4><b> Junta: </b>' . $model->SECTOR_NOMBRE . '</h4>';

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
            
            <table style="padding: 15px; border: black 2px solid;">
                <tr>
                    <td style="border: black 2px solid;">
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
                            echo '<br><center><b>ATENTAMENTE</b></center>';
                            echo '<center>' . $row['FIRMA'] .'</center>';
                            
                            if($bandera==1)
                            {
                                echo "</td></tr>"
                                //.' </table>'
                               // .'<table  style="padding: 15px;   border: black 2px solid;" >' 
                                . '<tr><td style="border: black 2px solid;">';
                            }
                            else
                            {
                                echo '</td><td style="border: black 2px solid;">';
                                $bandera=0;
                            }
                             $bandera = $bandera + 1;
                        }
                        ?>     
                        </td>                        
                </tr>
            </table>
             
    </body>
    <html>   



    </div>

</body>
</html> 
