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
         <table width="100%"><tr>
         <td width="2px" rowspan="2"><?php echo'<center><img src="' . Yii::app()->baseUrl . '/images/coyoctor/logo_coyoctor.jpg" alt="JURECH" width="50%"  align="center"/><center>'; ?></td>
        
         </tr></table>
         </htmlpageheader>
         
        <htmlpagefooter name="myfooter">
         <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
         Página {PAGENO} de {nb}
         </div>
         </htmlpagefooter>
         
        <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
         <sethtmlpagefooter name="myfooter" value="on" />
        
         mpdf-->



        <h3>SOCIO Nº <?php echo $model->CODIGO; ?></h3>
    
    <table width="100%" border="1">
           
            <tr>
                <td ><b>Apellidos y Nombres</b></td>
                <td><?php echo $model->APELLIDO; ?></td>
            </tr>
            <tr>
                <td><b>CI.</b></td>
                <td><?php echo $model->CI; ?></td>  
            
            </tr>
            
        </table> 
   <br>
   


</body>
</html> 