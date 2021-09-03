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
    , `TERRENO`.`NUM_TERRENO` AS NUM_TERRENO
    , `TERRENO`.`AREA` AS AREA
    , `VALVULA`.`DESC_VALVULA` AS VALVULA
    , `tconvocatoria`.`ENCABEZADO`
    , `tconvocatoria`.`TITULO`
    , `tconvocatoria`.`TIPO`
    , `tconvocatoria`.`FECHA`
    , `tconvocatoria`.`HORA`
    , `tconvocatoria`.`CUERPO`
    , `tconvocatoria`.`NOTA`
    , `tconvocatoria`.`FIRMA`
	
    , `tconvocatoria`.`TIPO_PLANTILLA`
    , `tconvocatoria`.`HORA_INICIA`
    , `tconvocatoria`.`HORA_INICIA_RECESO`
    , `tconvocatoria`.`HORA_TERMINA_RECESO`
    , `tconvocatoria`.`HORA_SALE`
    , `tconvocatoria`.`FECHA_INICIA`
    , `tconvocatoria`.`NUMERO_CAJAS`
    , `tconvocatoria`.`TIEMPO_ATENCION`
    , `tconvocatoria`.`LUNES`
    , `tconvocatoria`.`MARTES`
    , `tconvocatoria`.`MIERCOLES`
    , `tconvocatoria`.`JUEVES`
    , `tconvocatoria`.`VIERNES`
    , `tconvocatoria`.`SABADO`
    , `tconvocatoria`.`DOMINGO`
    
FROM
  `jurechgis`.`terreno` as TERRENO
    INNER JOIN `jurechgis`.`junta` as JUNTA 
        ON (`TERRENO`.`COD_JUNTA` = `JUNTA`.`COD_JUNTA`)
     INNER JOIN `jurechgis`.`zona` as ZONA 
        ON (`JUNTA`.`COD_ZONA` = `ZONA`.`COD_ZONA`)
    INNER JOIN `jurechgis`.`modulo` as MODULO
        ON (`TERRENO`.`COD_MODULO` = `MODULO`.`COD_MODULO`)  
     INNER JOIN `jurechgis`.`toma` as TOMA 
        ON (`MODULO`.`COD_TOMA` = `TOMA`.`COD_TOMA`)
    INNER JOIN `jurechgis`.`socio` as SOCIO 
        ON (`TERRENO`.`CODIGO` = `SOCIO`.`CODIGO`)    
    INNER JOIN `jurechgis`.`valvula` as VALVULA 
        ON (`TERRENO`.`COD_VALVULA` = `VALVULA`.`COD_VALVULA`)
    INNER JOIN `jurechgis`.`reservorio` as RESERVORIO 
        ON (`VALVULA`.`COD_RESERVORIO` = `RESERVORIO`.`COD_RESERVORIO`)  
        inner join `jurechgis`.`tconvocatoria` 
        ON(`JUNTA`.`COD_JUNTA` = `tconvocatoria`.`COD_JUNTA`)
        WHERE " 
        ."`JUNTA`.`COD_JUNTA` = ".$Codigo_Juntas." and TERRENO.VALIDADO = 0" 
        ." and `tconvocatoria`.`COD_CONVOCATORIA` = ".$model->COD_CONVOCATORIA
     
               // .' or `tconvocatoria`.`COD_CONVOCATORIA` = 2'
                . ' group by `SOCIO`.`CI` order by `SOCIO`.`APELLIDO`';

        $command = $connection->createCommand($sql);
        $rows = $command->execute();
        $rows = $command->queryAll();
        ?>
        <div class="table-responsive">
<!--            <table class="table table-striped table-bordered">
                <tbody>-->
            
            <table border="3" border-style='double' cellpadding='15'  CELLSPACING='6' >
                
                        <?php
                          $Fecha=$model->FECHA_INICIA.' '.$model->HORA_INICIA;
                          //$hora=$model->HORA_INICIA;
                        $Numero_secretarias = $model->NUMERO_CAJAS;
                        $columnas_max = $model->NUMERO_CAJAS;
                        $cuenta_columnas = 0;
                        $cuenta_secretarias = 1;
                        $contador = 0;
                             $estimado = explode(":", $model->TIEMPO_ATENCION);
                                $estimado_hora= $estimado[0];
                                if($estimado_hora=='00' or $estimado_hora=='')
                                {$estimado_hora=0; }
                                $estimado_minuto= $estimado[1];
                                if($estimado_minuto=='00' or $estimado_minuto=='')
                                {$estimado_minuto=0; }
                                $tiempo_estimado='PT'.$estimado_hora.'H'.$estimado_minuto.'M';
//                                echo "<br>TIEMPO ESTIMADO=".$tiempo_estimado;
                                //$tiempo_estimado='PT0H';
                       
                        
                        $bandera_dia=0;
//                       $array_dias = array();
                                $lunes = $model->LUNES;
                                $martes = $model->MARTES;
                                $miercoles = $model->MIERCOLES;
                                $jueves = $model->JUEVES;
                                $viernes = $model->VIERNES;
                                $sabado = $model->SABADO;
                                $domingo = $model->DOMINGO;
                                
                      
                                $date = new DateTime($Fecha); 
                       
                        foreach ($rows as $row) {    
                          
                             if($row['GENERO']=="F")
                            {
                                $Est = "<b>Sra. </b>";
                            }
                            else
                            {
                               $Est = "<b>Sr. </b>"; 
                            }
                            
                            echo '<div style="text-align:justify;">';
                            
                            
                            //$hoy=strftime("%A, %d de %B de %Y"); 
                             $Fecha_aux=$Fecha;
                            //$Fecha=strftime("%A, %d de %B del %Y  a las %Hh%M",strtotime($Fecha));  
                              $date = new DateTime($Fecha);                              
                             $Fecha = $date->format('Y-m-d H:i:s');
                              setlocale(LC_TIME,"spanish");  
                             $Imprimir_Fecha=strftime("%A, %d de %B del %Y  a las  %Hh%M",strtotime($Fecha)); 
                           if(($cuenta_secretarias == $Numero_secretarias) or $contador==0)
                           {
                               $contador++;
                               $cuenta_secretarias=1;
                           }
                           else
                           {
                               $cuenta_secretarias++;
                           }
                           if($cuenta_columnas==0)
                            {
                               // echo "<tr>";
                            } 
							 echo "<tr>";
                            echo '<td>';
                               // echo '<b>TICKET N°: </b> ' . $contador.'' ;
                              //  echo '<br><b>'.$Est.'</b>' . $row['APELLIDO'].'';
                                  $Imprimir_Fecha = ucfirst(iconv("ISO-8859-1", "UTF-8", $Imprimir_Fecha));
                              //  echo '<br><b>FECHA: </b> ' . $Imprimir_Fecha.'' ;                              
                              //  echo '<br><b> Hora: </b>' . $hora;
				
				//*****************************//
				//IMPRIMIR CITACIÓN
				 echo '<center><b>'. $row['ENCABEZADO']. '</b></center>';
                            echo '<center><b>' . $row['TITULO'] .  '</b></center>';
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
                                       echo '' . $model->CUERPO .'</div>';                             
	                       
		        	       echo 'Se le solicita acercase el día: <b>'.$Imprimir_Fecha .'</b>'; 
	                           // echo ', a las <b>' . date("G:i", strtotime($hora)) . '</b>';
				if($model->NOTA != '')
{
                           echo '<br><div style="text-align:justify;"><b>NOTA:</b> ' . $model->NOTA . '</div>';
};
                            echo '<br><center><b>ATENTAMENTE</b></center><br><br>';
                            echo '<center>' . $row['FIRMA'] .'</center>';
                            echo '<center><b>DEPARTAMENTO JURÍDICO DE LA JURECH</b></center>';
                            
				//FIN IMPRIMIR CITACIÓN
				//*****************************//
                            echo '</td>';
                            $cuenta_columnas++;
                            if($cuenta_columnas==$columnas_max)
                            { //CAMBIA DE COLUMNA
                                echo "</tr>";
                                $cuenta_columnas=0;
                                $date = new DateTime($Fecha);
                                //Aumentado en fecha
                                $date->add(new DateInterval($tiempo_estimado)); //horas y minutos aumentado para el siguiente
                                $Fecha = $date->format('Y-m-d H:i:s');
                                $Hora = $date->format('H:i:s');
                                
                                
                                if ( ($Hora >= $model->HORA_INICIA_RECESO) and $Hora <= $model->HORA_TERMINA_RECESO  )
                                {
                                    //$date->add(new DateInterval($tiempo_diferencia)); //horas y minutos aumentado para el siguiente
                                    $Fecha = $date->format('Y-m-d '.$model->HORA_TERMINA_RECESO); 
                                }
                                 if ( $Hora >= $model->HORA_SALE ) //CAMBIA DIA
                                {
                                    //$date->add(new DateInterval($tiempo_diferencia)); //horas y minutos aumentado para el siguiente
                                     $date->add(new DateInterval('P1D')); //1 Dia
                                      $Fecha = $date->format('Y-m-d '.$model->HORA_INICIA); 
//                                    //  OMITIR LAS FECHAS PROGRAMADAS
                                     
                                     foreach ($model_fechas_omitir as $omitir) {
                                         $fecha_aqui = new DateTime($Fecha);
                                         $fec_aqui = $fecha_aqui->format('Y-m-d'); 
                                        $Fech_omitir = $omitir->FECHA;  
//                                        echo 'Contador='.$contador.' - '.$fec_aqui.'->==='.$Fech_omitir;
                                        if(strcmp($fec_aqui,$Fech_omitir)==0)
                                        {
//                                            echo "OMITIR"; 
                                         $date = new DateTime($Fecha); 
                                         $date->add(new DateInterval('P1D')); // Salta 1 día
                                         $Fecha = $date->format('Y-m-d H:i:s'); 
                                         $Fech_omitir='0001-00-00 00:00:00';
                                         $fec_aqui='0000-00-00 00:00:00';
                                        }
                                        else
                                        {
                                         $Fech_omitir='0001-00-00 00:00:00';
                                         $fec_aqui='0000-00-00 00:00:00';
                                        }
                                    }
                                    //****************************************
                                       $Hoy_es = $date->format('D');
                                       //VERIFICA QUE DIA ES Y SI ESTA ACTIVADO PARA VERIFICACION ESOS DIAS
                                      if ($Hoy_es=='Mon' and $lunes==0)
                                      {
                                        $date = new DateTime($Fecha); 
                                        $date->add(new DateInterval('P1D')); // Salta 1 día
                                        $Fecha = $date->format('Y-m-d H:i:s'); 
                                        $Hoy_es = $date->format('D');
                                      }
                                       if ($Hoy_es=='Tue' and $martes==0)
                                      {
                                        $date = new DateTime($Fecha); 
                                        $date->add(new DateInterval('P1D')); // Salta 1 día
                                        $Fecha = $date->format('Y-m-d H:i:s'); 
                                        $Hoy_es = $date->format('D');
                                      }
                                       if ($Hoy_es=='Wed' and $miercoles==0)
                                      {
                                        $date = new DateTime($Fecha); 
                                        $date->add(new DateInterval('P1D')); // Salta 1 día
                                        $Fecha = $date->format('Y-m-d H:i:s'); 
                                        $Hoy_es = $date->format('D');
                                      }
                                       if ($Hoy_es=='Thur' and $jueves==0)
                                      {
                                        $date = new DateTime($Fecha); 
                                        $date->add(new DateInterval('P1D')); // Salta 1 día
                                        $Fecha = $date->format('Y-m-d H:i:s');
                                        $Hoy_es = $date->format('D');
                                      }
                                       if ($Hoy_es=='Fri' and $viernes==0)
                                      {
                                        $date = new DateTime($Fecha); 
                                        $date->add(new DateInterval('P1D')); // Salta 1 día
                                        $Fecha = $date->format('Y-m-d H:i:s'); 
                                        $Hoy_es = $date->format('D');
                                      }
                                       if ($Hoy_es=='Sat' and $sabado==0)
                                      {
                                        $date = new DateTime($Fecha); 
                                        $date->add(new DateInterval('P1D')); // Salta 1 día
                                        $Fecha = $date->format('Y-m-d H:i:s');   
                                        $Hoy_es = $date->format('D');
                                      }
                                       if ($Hoy_es=='Sun' and $domingo==0)
                                      {
                                        $date = new DateTime($Fecha); 
                                        $date->add(new DateInterval('P1D')); // Salta 1 día
                                        $Fecha = $date->format('Y-m-d H:i:s'); 
                                        $Hoy_es = $date->format('D');
                                      }
//                                      $contador_dia_imprimiendo++;
                                      
                                } //FIN DE CAMBIA DIA
                            }
                          
                        }
                        
                        ?>     
                     
            </table>

         
             
    </body>
    <html>   



    </div>

</body>
</html> 
