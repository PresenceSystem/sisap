<!DOCTYPE html>

<html lang="es">
    <head>
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/bootstrap.min.css" />'; ?>
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/bootstrap-responsive.min.css" />'; ?>
        <?php echo'<link rel="stylesheet" type="text/css" href="' . Yii::app()->theme->baseUrl . '/css/abound.css" />'; ?>
    </head>
    <body>
        <!--mpdf
         <htmlpageheader name="myheader">
        <br><br>
         <table width="100%"><tr>
         <td width="2px" rowspan="2"><?php echo'<img src="' . Yii::app()->baseUrl . '/images/pagina/bannerStanford.jpg" alt="Stanford">'; ?></td>
        
         </tr></table>
         </htmlpageheader>
         
        <htmlpagefooter name="myfooter">
         <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
         PÃ¡gina {PAGENO} de {nb}
         </div>
         </htmlpagefooter>
         
        <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
         <sethtmlpagefooter name="myfooter" value="on" />
        
         mpdf-->
          <?php
        $bandera ='...';
        $connection = Yii::app()->db;   
        $sql = "SELECT `Usuario` FROM `sisbiblio_stanford`.`Prestamo` WHERE Estado='Prestado' AND Usuario=".$model->id;;
        $command = $connection->createCommand($sql);
        $rows=$command->execute();
        $rows=$command->queryAll(); 
       
        foreach($rows as $row){
              $bandera ='NoAdeuda';
        //echo $row['Estado'].'P<br>';
            if ($row['Usuario'] > 0)
             {$bandera = 'Adeuda'; };
            
        }
        //echo $bandera.'....';
    if ($bandera == 'Adeuda')
        {
            
         ?>
           <table width="100%"><tr>

                                    <th><h2> <br><br>El Instituto Tecnológico Superior<br>"ESTANFORD" </h2></th>


                            </tr>
                            <tr><th><h3>   <br><br><br><br> No puede emitir el certificado por adeudar a la biblioteca </h3></th></tr>
            </table>
     

    <?php
     } else
     {
              ?>
                            <table width="100%"><tr>

                                    <th><h2> <br><br>El Instituto Tecnológico Superior<br>"ESTANFORD" </h2></th>


                            </tr>
                            <tr><th><h3>   <br><br><br><br> CERTIFICA </h3></th></tr>

                            <tr><td align="right"> <br> <?php echo gmdate('d/m/Y'); ?></td></tr>

                            <tr><td align="justify"> <br><br><br>Que el Sr./Srta. <b> <?php echo $model->nombres; ?> </b> no presenta ningún tipo de adeudo a la fecha, a la biblioteca de la institución.
                                <br><br>                
                                Para llegar a esta afirmación se han revisado los registros de préstamo, y uso de material bibliotecario, por lo que no existe impedimento alguno para continuar con el proceso de certificación.
                                    <br><br>
                                Se extiende la presenta constancia a petición del interesado y para los fines que a este convengan en la Ciudad de Riobamba.
                                <br><br>




                    <br><br><br><br><br><br>
                                </td></tr>
                            <tr><td align="center">
                    ____________________________
                    <br><br>BIBLIOTECARIO <br>


                     </td></tr>

                        </table>
       <?php  
     }
    ?>
</body>
</html> 