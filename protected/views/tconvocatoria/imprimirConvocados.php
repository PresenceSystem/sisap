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
$convocatoria=Yii::app()->getSession()->get('ConvocatoriaSeleccionada');
if($convocatoria>0 and $convocatoria==$model->COD_CONVOCATORIA)
{
     echo "<h2 class=badget-info>LISTA DE SOCIOS CONVOCADOS</h2>";
    
      $connection = Yii::app()->db;
                $sql = "SELECT * FROM tconvocado WHERE COD_CONVOCATORIA=".$convocatoria;
                $command = $connection->createCommand($sql);
                $rows = $command->execute();
                $rows = $command->queryAll();
$contador=1;
$lista_convocados="`SOCIO`.`CODIGO`= 0 ";
                foreach ($rows as $row) {
                    $socio=$row['COD_SOCIO'];
                    $lista_convocados=$lista_convocados." or `SOCIO`.`CODIGO`=".$socio;
                    };
}
        $connection = Yii::app()->db;
        //$sql = "SELECT `Usuario` FROM `sisbiblio_stanford`.`Prestamo` WHERE Estado='Prestado' AND Usuario=".$model->id;;
//  , `JUNTA`.`SECTOR_NOMBRE` AS SECTOR
//    , `ZONA`.`DESC_ZONA` AS ZONA
//    , `TOMA`.`DESC_TOMA` AS TOMA
//    , `RESERVORIO`.`DESC_RESERVORIO` AS RESERVORIO
//    , `MODULO`.`DESC_MODULO` AS MODULO
        
         $Codigo_Juntas=$model->COD_JUNTA;
        if (isset($model->cODJUNTA1))
        {
            $Codigo_Juntas=$Codigo_Juntas." or `JUNTA`.`COD_JUNTA` = ".$model->COD_JUNTA_1;
        }
         if (isset($model->cODJUNTA2))
        {
            $Codigo_Juntas=$Codigo_Juntas." or `JUNTA`.`COD_JUNTA` = ".$model->COD_JUNTA_2;
        }
        $sql = "
       SELECT
`SOCIO`.`APELLIDO` AS APELLIDO
, `SOCIO`.`CI` AS CI
, `SOCIO`.`GENERO` AS GENERO 
-- , `TERRENO`.`NUM_TERRENO` AS NUM_TERRENO
-- , `TERRENO`.`AREA` AS AREA
-- , `VALVULA`.`DESC_VALVULA` AS VALVULA
, `tconvocatoria`.`ENCABEZADO`
, `tconvocatoria`.`TITULO`
, `tconvocatoria`.`TIPO`
, `tconvocatoria`.`FECHA`
, `tconvocatoria`.`HORA`
, `tconvocatoria`.`CUERPO`
, `tconvocatoria`.`NOTA`
, `tconvocatoria`.`FIRMA`


FROM
-- `jurechgis`.`terreno` as TERRENO
-- INNER JOIN `jurechgis`.`junta` as JUNTA 
-- ON (`TERRENO`.`COD_JUNTA` = `JUNTA`.`COD_JUNTA`)
-- INNER JOIN `jurechgis`.`zona` as ZONA 
-- ON (`JUNTA`.`COD_ZONA` = `ZONA`.`COD_ZONA`)
-- INNER JOIN `jurechgis`.`modulo` as MODULO
-- ON (`TERRENO`.`COD_MODULO` = `MODULO`.`COD_MODULO`) 
-- INNER JOIN `jurechgis`.`toma` as TOMA 
-- ON (`MODULO`.`COD_TOMA` = `TOMA`.`COD_TOMA`)
-- INNER JOIN `jurechgis`.`socio` as SOCIO 
-- ON (`TERRENO`.`CODIGO` = `SOCIO`.`CODIGO`) 
-- INNER JOIN `jurechgis`.`valvula` as VALVULA 
-- ON (`TERRENO`.`COD_VALVULA` = `VALVULA`.`COD_VALVULA`)
-- INNER JOIN `jurechgis`.`reservorio` as RESERVORIO 
-- ON (`VALVULA`.`COD_RESERVORIO` = `RESERVORIO`.`COD_RESERVORIO`) 
-- inner join `jurechgis`.`tconvocatoria` 
-- ON(`JUNTA`.`COD_JUNTA` = `tconvocatoria`.`COD_JUNTA`)
tconvocatoria INNER JOIN `jurechgis`.`tconvocado` AS convocado 
 ON (`tconvocatoria`.`COD_CONVOCATORIA` = `convocado`.`COD_CONVOCATORIA`)
INNER JOIN `jurechgis`.`socio` AS SOCIO 
ON (`convocado`.`COD_SOCIO` = `SOCIO`.`CODIGO`) 
        WHERE " 
    //    ."`JUNTA`.`COD_JUNTA` = ".$Codigo_Juntas 
      //  ."  `tconvocatoria`.`COD_CONVOCATORIA` = ".$model->COD_CONVOCATORIA." and"
                ." (".$lista_convocados
                ." )"
               // .' or `tconvocatoria`.`COD_CONVOCATORIA` = 2'
                . ' group by `SOCIO`.`APELLIDO` order by `SOCIO`.`APELLIDO`';

      // echo $sql;
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
    
                            echo ' a las <b>' . $row['HORA'] . '</b>';
                            echo '' . $row['CUERPO'] . '</div>';
                            echo '<br><b>NOTA:</b> ' . $row['NOTA'] . '';
                            echo '<br><br><center><b>ATENTAMENTE:</b></center>';
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
